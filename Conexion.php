<?php
$servername = "localhost";
$username = "root";
$password = "prepa123";
$dbname = "Panaderia";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
  die("Coneccion fallida: " . mysqli_connect_error());
}
?>