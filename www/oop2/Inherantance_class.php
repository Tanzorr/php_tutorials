<?php


class Inherantance_class
{
    public $wheels = 4;
    private $dors = 4;
    static $sets = 4;
     static function get_walues(){
        return self::$sets;
     }

    function set_walues(){
       $this->dors =10;
    }

}

$bmw = new Inherantance_class();
$bmw->set_walues();
 $bmw->get_walues();

class Truks extends  Inherantance_class {
        static function display(){
            echo parent::get_walues();
        }
}

$tachoem = new Truks();

Truks::display();

