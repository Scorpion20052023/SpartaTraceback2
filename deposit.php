<?php
session_start();
include("connect.php");
include("record_transaction.php");

// Ensure user is logged in
if (!isset($_SESSION['user_id'])) {
    echo json_encode(["status" => "error", "message" => "Not logged in"]);
    exit();
}

$user = $_SESSION['user_id'];
$phone = trim($_POST['phone']);
$amount = trim($_POST['amount']);

// Basic validation
if (empty($phone) || empty($amount)) {
    echo json_encode(["status" => "error", "message" => "Phone and amount required"]);
    exit();
}

if (!preg_match('/^(07|01)\d{8}$/', $phone)) {
    echo json_encode(["status" => "error", "message" => "Invalid Safaricom number"]);
    exit();
}

if ($amount < 1) {
    echo json_encode(["status" => "error", "message" => "Amount must be at least 1 KES"]);
    exit();
}

// Save pending transaction BEFORE STK push
recordTransaction($user, "deposit", $amount, "M-Pesa", "pending");

// Trigger actual STK push
$_POST['phone'] = $phone;
$_POST['amount'] = $amount;

ob_start();
include("stkpush.php"); // returns Safaricom STK push response
$response = ob_get_clean();

echo $response;
?>
