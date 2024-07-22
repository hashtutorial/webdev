<?php
// Starting the session
session_start();

$servername = "localhost";
$username = "root";
$password = "";

$con = mysqli_connect($servername,$username,$password,"db_project");

// Checking the connection
if (mysqli_connect_errno()) 
{
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  exit();
}

?>