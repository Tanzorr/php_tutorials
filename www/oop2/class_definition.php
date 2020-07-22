<?php

class Cars {


    var $wheel_count=4;
    var $door_count=4;

    function car_detail(){
            return "This car has ".$this->wheel_count ."Wheels";
    }

}
$bmw = new Cars();
$lanos = new Cars();

$lanos->wheel_count=10;
echo  $lanos->wheel_count;
echo $bmw->car_detail();