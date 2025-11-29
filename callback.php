<?php
include("connect.php");

// Receive callback data
$data = file_get_contents("php://input");
$json = json_decode($data, true);

// Extract details
$mpesa_ref = $json["Body"]["stkCallback"]["CallbackMetadata"]["Item"][1]["Value"];
$amount    = $json["Body"]["stkCallback"]["CallbackMetadata"]["Item"][0]["Value"];
$phone     = $json["Body"]["stkCallback"]["CallbackMetadata"]["Item"][3]["Value"];

// Update wallet
mysqli_query($conn,
    "UPDATE wallets
     SET balance = balance + $amount
     WHERE user_id = (SELECT id FROM users WHERE phone='$phone')"
);

// Save logs
mysqli_query($conn,
    "INSERT INTO mpesa_logs (phone, amount, mpesa_ref, raw_response)
     VALUES ('$phone', '$amount', '$mpesa_ref', '$data')"
);
?>
