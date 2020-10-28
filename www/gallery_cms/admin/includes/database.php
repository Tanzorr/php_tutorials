<?php
require_once("new_config.php");


class Database{
    public $connect;

    public function __construct()
    {
        $this->open_db_connection();
    }

    public function open_db_connection(){
       // $this->connect = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_BASE);
        $this->connect = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_BASE);
        if ($this->connect->connect_errno){
            die("Databse connection failed badly".$this->connect->connect_errno);
        }
    }
    public function query($sql){
        var_dump($sql);
        $result = $this->connect->query($sql);
        $this->confirm_query($result);
        return $result;
    }
    public function confirm_query($result){
        if(!$result){
            die("Query Failed".$this->connect->error);
        }
    }
    public function escape_string($string){
       $escaped_string = $this->connect->real_escape_string($string);
       return $escaped_string;
    }

    public function the_insert_id(){
        return mysqli_insert_id($this->connect);
    }
}

$database = new Database();


