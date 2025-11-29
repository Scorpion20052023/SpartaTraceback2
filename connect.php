<?php
$host = "localhost";      // or your DB host
$user = "root";           // your DB username
$pass = "";               // your DB password
$db   = "royalbridge_db"; // your database name

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>