<?php
session_start();
include("access_token.php");
include("connect.php");
include("record_transaction.php");

$user = $_SESSION['user_id'];
$phone = $_POST['phone'];
$amount = $_POST['amount'];

$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, 'https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest');
curl_setopt($curl, CURLOPT_HTTPHEADER, [
    'Authorization: Bearer ' . $access_token,
    'Content-Type: application/json'
]);

$payment = [
    "BusinessShortCode" => "174379",
    "Password" => base64_encode("174379" . "YourPassKey" . date("YmdHis")),
    "Timestamp" => date("YmdHis"),
    "TransactionType" => "CustomerPayBillOnline",
    "Amount" => $amount,
    "PartyA" => $phone,
    "PartyB" => "174379",
    "PhoneNumber" => $phone,
    "CallBackURL" => "https://yourdomain.com/callback.php",
    "AccountReference" => "RoyalBridge",
    "TransactionDesc" => "Deposit"
];

curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($payment));
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($curl);
curl_close($curl);

recordTransaction($user, "deposit", $amount, "M-Pesa", "pending");

echo $response;
?>
