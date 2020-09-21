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



}