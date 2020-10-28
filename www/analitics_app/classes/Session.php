<?php


class Session
{
    public $signed_in=false;
    public $user_id;
    public $user_role;
    public $user_name;





    function __construct()
    {
        session_start();
        $this->check_the_login();


    }



    public function is_signed_in(){
        return $this->signed_in;
    }

    public function login($user){
        if($user){

            $this->user_id = $_SESSION['user_id']=$user->id;
            $this->signed_in = true;
            $this->user_role = $_SESSION['user_role'] = $user->role;
            $this->user_name = $_SESSION['user_name'] = $user->name;

        }
    }

    private function check_the_login(){
        if (isset($_SESSION['user_id'])){
            $this->user_id = $_SESSION['user_id'];
            $this->signed_in =true;
        }else{
            unset($this->user_id);
            $this->signed_in = false;
        }
    }

    public function logout(){
        unset($_SESSION['user_id']);
        unset($_SESSION['user_role']);
        unset($this->user_id);
        $this->signed_in = false;

    }




}

$session = new Session();
