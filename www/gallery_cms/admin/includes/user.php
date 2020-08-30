<?php


class User extends Db_object
{
    protected static $db_table = "users";
    protected static $db_table_fields = array('user_name', 'password','first_name','last_name');
    public $id;
    public $user_name;
    public $password;
    public $first_name;
    public $last_name;



    public static function verify_user($username, $password){
        global $database;
        $username=$database->escape_string($username);
        $password =$database->escape_string($password);
        $sql= "SELECT * FROM ".self::$db_table."  WHERE user_name ='{$username}' AND password = '{$password}'";
        $the_result_array = self::find_this_query($sql);
        return !empty($the_result_array)?array_shift($the_result_array):false;
    }




}