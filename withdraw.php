<?php
session_start();
include("connect.php");

$user = $_SESSION['user_id'];
$phone = trim($_POST['phone']);
$amount = trim($_POST['amount']);
$source = trim($_POST['source']);
$token  = trim($_POST['tokCode']);

mysqli_query($conn,
    "INSERT INTO withdrawals (user_id, phone, amount, source, token_code)
     VALUES ('$user', '$phone', '$amount', '$source', '$token')"
);

echo "Withdrawal request sent!";
?>
