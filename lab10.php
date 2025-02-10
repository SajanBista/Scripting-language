<!--create a page template using php  class and applly that class in different paragraph with different values-->
<?php
class lab10
{
public $para1;

public $para2;


public function __construct($para1,$para2)
{
    $this->para1 = $para1;
    $this->para2 = $para2;
}
 
public function display($para1,$para2)
{
    echo"<h1>$para1</h1>";
    echo"<p>$para2</p>";
}
}
$dis1  =new lab10("head","this is body");
$dis1 = new lab10("head 2","this is second body");
$dis3 = new lab10("head number 3","this is third body");

$dis1->display("head","this is body");
$dis2->display("head 2","this is second body");
$dis3->display("head number 3","this is third body");




