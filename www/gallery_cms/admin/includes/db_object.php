<?php


class Db_object
{
    protected static $db_table = "users";
    public $tmp_path;
    public $upload_directory = "images";
    public $errors = array();
    public $upload_errors_array = array(
        UPLOAD_ERR_OK => "There is no error",
        UPLOAD_ERR_INI_SIZE => "The uploaded file execeeds the upload_max_filesize directive",
        UPLOAD_ERR_FORM_SIZE => "The uploaded file execeeds the MAX_FILE_SIZE directive",
        UPLOAD_ERR_PARTIAL => "The uploaded file was only partially uploaded",
        UPLOAD_ERR_NO_FILE => "No file waw uploaded.",
        UPLOAD_ERR_NO_TMP_DIR => "Missing a temporary folder.",
        UPLOAD_ERR_CANT_WRITE => "Failed to write file to disk.",
        UPLOAD_ERR_EXTENSION => "A PHP extension stopped the file upload."
    );

    public function set_file($file)
    {
        if (empty($file) || !$file || !is_array($file)) {
            $this->errors[] = "There was no file uploaded here";
            return false;
        } elseif ($file['error'] != 0) {
            $this->errors[] = $this->upload_errors_array[$file['error']];
            return false;
        } else {
            $this->filename = basename($file['name']);
            $this->tmp_path = $file['tmp_name'];
            $this->type = $file['type'];
            $this->size = $file['size'];
        }
    }

    public function save_with_image()
    {
        if ($this->id) {
            $this->update();
        } else {
//            if (empty($this->errors)) {
//                return false;
//            }

            if (empty($this->filename) || empty($this->tmp_path)) {
                $this->errors[] = "the file was not availabel";
                return false;
            }
            $tmp_path = DS . 'var' . DS . SITE_ROOT . DS . 'admin' . DS . $this->upload_directory . DS . $this->filename;
            if (file_exists($tmp_path)) {
                $this->errors[] = "The file {$this->filename} already exists";
                return false;
            }
            if (move_uploaded_file($this->tmp_path, $tmp_path)) {
                if ($this->create()) {
                    unset($this->tmp_path);
                    return true;
                }
            } else {
                $this->errors[] = "the file directory probably does not have permission";
                return false;
            }

        }
    }


    public static function find_all(){
        return static::find_by_query("SELECT * FROM ".static::$db_table." ");
    }

    public static function find_by_id($id){
        $the_result_array = static::find_by_query("SELECT * FROM ".static::$db_table."  WHERE id= $id LIMIT 1");
        return !empty($the_result_array)? array_shift($the_result_array):false;
    }


    public static function find_by_query($sql){
        global $database;
        $result_set =$database->query($sql);
        $the_object_array = array();
        while ($row = mysqli_fetch_array($result_set)){
            $the_object_array[]=static::instantation($row);
        }
        return $the_object_array;
    }

    public static function instantation($the_record){
        $calling_class= get_called_class();
        $the_object = new $calling_class;
        foreach ($the_record as $the_attribute=>$value){
            if($the_object->has_the_attribute($the_attribute)){
                $the_object->$the_attribute = $value;
            }
        }

        return $the_object;
    }

    private function has_the_attribute($the_attribute){
        $object_properties = get_object_vars($this);
        return array_key_exists($the_attribute, $object_properties);

    }

    public function create(){
        global $database;
        $properties = $this->properties();
        array_shift($properties);
        $sql = "INSERT INTO ".static::$db_table." (".implode(",",array_keys($properties)) .")";
        $sql .=" VALUES('".implode("','",array_values($properties))."')";
        if ($database->query($sql)){
            $this->id = $database->the_insert_id();
            return true;
        }else{
            echo "Error";
            return false;
        }

    }//end cewate

    public function update(){
        global $database;
        $propertis = $this->properties();
        $properties_pairs = array();
        foreach ($propertis as $key=>$value) {
            $properties_pairs[] = "{$key}='{$value}'";
        }
        $sql = "UPDATE ".static::$db_table." SET ".
            implode(", ", $properties_pairs)
            ." WHERE id = ". $database->escape_string($this->id);
        $database->query($sql);
        return (mysqli_affected_rows($database->connect) == 1) ? true :false;
    }

    protected function properties()
    {
        $properties = array();
        foreach (static::$db_table_fields as $db_field) {
            if (property_exists($this, $db_field)){
                $properties[$db_field] = $this->$db_field;
            }
        }
        return $properties;
    }

    protected function clean_propertues() {
        global $database;
        $clean_properties = array();
        foreach ($this->properties() as $key=>$value) {
            $clean_properties[$key] = $database->escape_string($value);
        }
        return $clean_properties;
    }

    public function save()
    {
        return isset($this->id) ? $this->update() : $this->create();
    }

    public function delete()
    { global $database;
        $sql = "DELETE FROM ".static::$db_table."  WHERE id =".$database->escape_string($this->id);

        $database->query($sql);
        return (mysqli_affected_rows($database->connect) == 1) ? true :false;
    }



}