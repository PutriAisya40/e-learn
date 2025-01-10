<?php

$hostname = "localhost";
$username = "root";
$password = "";
$dbname = "elearning";

$connection = mysqli_connect($hostname, $username, $password, $dbname);
if(!$connection){
    die("Can't connect to database: ".mysqli_connect_error());
}
//echo "Connected Successfully";
?>  