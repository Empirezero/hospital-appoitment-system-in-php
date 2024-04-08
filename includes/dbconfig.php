<?php
$db_host = "localhost";
$db_username = "root";
$password = "";
$db_name = "hospital_appoitment";

// Create connection
$conn = new mysqli($db_host,$db_username , $password,$db_name);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

?>