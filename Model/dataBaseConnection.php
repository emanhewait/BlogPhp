<?php
$servername = "localhost";
$username = "root";
$password = "password";

try {
  $conn = new PDO("mysql:host=$servername;dbname=blog", $username, $password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  return true ;
} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}
