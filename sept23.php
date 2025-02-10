<!--accessing form the static

 /*

class Car
{
    public static function speed()
    {
        echo" your speed is 60km/hr";

    } 
}
car::speed();//static method we  can  access without making instance(new)-->
<?php
try{
    if(2>3){

    
        throw new Exception("this is test");
    }
    else{
        throw new Exception("this is exception one");
    }

}
catch(Exception $e){
}
{
    echo $e ->getMessage();
}
?>

