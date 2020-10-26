<?php



 class Model
{
    public $forinTable = "users_action";
    public $table;
    public $properties;
    public $db_table_fields;

    public function redirect($location) {
        header('Location:'.$location);
    }

    public  function find_all(){
       return $this->find_by_query("SELECT * FROM ".$this->table." ");
    }

    public  function find_by_id($id){
        $the_result_array = static::find_by_query("SELECT * FROM ".$this->table."  WHERE id= $id LIMIT 1");
        return !empty($the_result_array)? array_shift($the_result_array):false;
    }


    public function find_by_query($sql){
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
        $sql = "INSERT INTO ".$this->table." (".implode(",",array_keys($properties)) .")";
        $sql .=" VALUES('".implode("','",array_values($properties))."')";
        if ($database->query($sql)){

            $this->id = $database->the_insert_id();
            return true;
        }else{
            echo "Error";
            return false;
        }

    }//end cewate



    protected function properties()
    {
        $properties = array();
        foreach ($this->db_table_fields as $db_field) {
            if (property_exists($this, $db_field)){
                $properties[$db_field] = $this->$db_field;
            }
        }
        return $properties;
    }



    public function save()
    {
        return isset($this->id) ? $this->update() : $this->create();
    }

    public function delete()
    { global $database;
        $sql = "DELETE FROM ".$this->table."  WHERE id =".$database->escape_string($this->id);

        $database->query($sql);
        return (mysqli_affected_rows($database->connect) == 1) ? true :false;
    }

}