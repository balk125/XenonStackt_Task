<?php
$server="localhost";
$username="root";
$password="";  
$con=mysqli_connect($server,$username,$password,"mytaskweb");

if(mysqli_connect_error()){
    echo "<script>alert('Cannot to the database');</script>";
    exit();
}

?>