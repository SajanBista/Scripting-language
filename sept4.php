<?php 
$con = mysqli_connect("localhost","root","","student");
$sql= mysqli_query($con,"select * from student");
?>
<div style="border: 1px solid black; width:400px;margin-top:10px">
    <?php
    $sql2 = mysqi_query($con,"select rating from student");
    $det2= mysqli_fetch_row($sql2);
    echo "total feedback".$det2[0];
?><?php
    while($det= mysqli_fetch_array($sql)){
<?


    }