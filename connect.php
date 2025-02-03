<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "Rental";

$conn = new mysqli('localhost', 'root', '', 'Renatal');

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
