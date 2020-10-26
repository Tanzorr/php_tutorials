<?php


class User extends Model
{

    public $table = 'users';
    public $db_table_fields = array('id','name','email','password','role');
    public $id;
    public $name;
    public $role;
    public $email;
    public $password;




}