<?php
class car 
{
    function __construct(){
        echo "this is test constructor";
    }
    function fun1(){
        echo "hello world";
    }
    function __destruct(){
        echo "this is test 3";
    }

}
$vehi = new car();
$vehi->fun1();// function call method.