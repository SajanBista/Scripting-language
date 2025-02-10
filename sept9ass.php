<?php
class Car 
{   public $color = "red";
    function __construct($user){
        echo $this->color."this is test constructor";
    }
    function fun1(){
        echo "hello world";
    }
    function __destruct(){
        echo "this is test 3";
    }

}
$vehi = new car("hhhhhh");
$vehi -> fun1();// function call method.