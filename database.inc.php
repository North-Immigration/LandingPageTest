<?php
$servername   = "localhost";
$database = "contactform";
$username = "NorthCanada";
$password = "NorthCanada@2023";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);
// Check connection
if ($conn->connect_error) {
   die("Connection failed: " . $conn->connect_error);
}
  echo "Connected successfully";
?>