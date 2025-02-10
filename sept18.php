<!-- access modifier in php-->
<?php
class car
{
    public $color="red";
    public $model="ZS";
    protected $price ="50000000";
    function speed($gear){
        echo "you are in $gear Gear";
        $msg="you are in $gear Gear";
        echo $this->price;
        echo $this->model;
        echo $this->color;
        echo $msg;
        return $msg;
    }
}
class Hyundai extends car{
    function stop(){
        echo $this->color;
        echo $this->model;
        echo $this->price;
    }
}
$obj = new Hyundai();
echo $obj->speed("4");
echo $obj->color;
echo $obj->stop();