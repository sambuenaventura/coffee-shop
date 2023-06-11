<?php
$serverName = "localhost";
$dBUsername = "root";
$dBPassword = "";
$dBName = "Group_5_WD202";
 
/* Attempt to connect to MySQL database */
$conn = mysqli_connect($serverName, $dBUsername, $dBPassword, $dBName);
 
// Check connection
if(!$conn){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

