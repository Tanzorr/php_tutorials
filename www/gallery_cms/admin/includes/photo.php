<?php


class Photo extends Db_object
{
    protected static $db_table = "photos";
    protected static $db_table_fields = array('id', 'title','caption', 'description', 'filename','altrnate_text','type', 'size');
    public $id;
    public $title;
    public $description;
    public $filename;
    public $type;
    public $size;

    public function picture_path() {
        return $this->upload_directory.DS.$this->filename;

    }

    public function delete_photo() {
        if ($this->delete()){
            $target_path = DS.'var'.SITE_ROOT.DS.'admin'.DS.$this->picture_path();
            return unlink($target_path) ? true : false;
        }else{
            return false;
        }
    }

    public function ajax_save_photo_image($photo_image, $photo_id) {
        global $database;
        echo "ajax rquest";
         $this->filename = $photo_image = $database->escape_string($photo_image);
         $this->id = $photo_id = $database->escape_string($photo_id);
         $sql = "UPDATE ".self::$db_table. " SET filename = '{$this->filename}' WHERE id = '{$this->id}'";
         var_dump($sql);
         $update_image = $database->query($sql);

         echo $this->picture_path();
    }



}