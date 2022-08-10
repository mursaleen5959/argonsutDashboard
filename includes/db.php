<?php
// Setting for the Localhost Machine
$servername = "localhost";
$username = "root";
$password = "";
$db = "argonsut_db";

try
{
  $conn = new PDO("mysql:host=$servername;dbname=$db",$username,$password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  //echo "Connected successfully";
} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}