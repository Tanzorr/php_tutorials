<?php


class User extends Db_object
{
    protected static $db_table = "users";
    protected static $db_table_fields = array('id','user_name', 'user_image', 'password','first_name','last_name',);
    public $id;
    public $user_name;
    public $password;
    public $first_name;
    public $last_name;
    public $user_image;
    public $image_directory = "images";
    public $image_placeholder ="https://image.shutterstock.com/image-vector/default-avatar-profile-icon-grey-260nw-744595909.jpg";



    public function image_path_and_placeholder() {
        return empty($this->user_image) ? $this->image_placeholder : $this->image_directory.DS.$this->user_image;
    }



    public static function verify_user($username, $password){
        global $database;
        $username=$database->escape_string($username);
        $password =$database->escape_string($password);
        $sql= "SELECT * FROM ".self::$db_table."  WHERE user_name ='{$username}' AND password = '{$password}'";
        $the_result_array = self::find_by_query($sql);
        return !empty($the_result_array)?array_shift($the_result_array):false;
    }

    public function delete_user() {
        if ($this->delete()){
            $target_path = DS.'var'.SITE_ROOT.DS.'admin'.DS.$this->image_path_and_placeholder();
            return unlink($target_path) ? true : false;
        }else{
            return false;
        }
    }




}