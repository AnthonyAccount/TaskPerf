<?php

$host = "localhost";
$user = "root";
$pwd = "";
$dbname = "registration";

$conn = mysqli_connect($host,$user,$pwd,$dbname);
if(!$conn){
    die("Not connected");
}
?>