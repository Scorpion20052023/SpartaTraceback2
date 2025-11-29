<?php
session_start();
include("connect.php");

$user = $_SESSION['user_id'];

$query = mysqli_query($conn, "SELECT * FROM wallets WHERE user_id='$user'");
$data = mysqli_fetch_assoc($query);

echo json_encode($data);
?>
