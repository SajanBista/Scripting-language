<!--now creating class and also implementing constructor class-->
<?php
class Edu{
    function __construct($l,$b){
        $area=$l*$b;
        echo $area;
    }
    function fun1($l,$b,$h){
        $volume=$l*$b*$h;
        echo $volume;
}
}
$obj = new Edu(5,5);    
$obj->fun1(5,5,5);