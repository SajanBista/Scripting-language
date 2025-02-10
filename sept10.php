<?php

class Temp{
    function temp1($head,$details,$height)
    {
        echo "<div style='border:1px solid red;background-color:skyblue;height:$height;'>";
        echo"<h2>$head</h2>";
        echo "<p>$details</p>";
        echo"<div>";
    }
}

// $temp = new Temp();
// $temp->temp1("about me ","welcome to my page... this is my page","200px");
// $temp->temp1("services","this is services page","100px");
// $temp->temp1("Portfolio","this is portfolio page","300px");