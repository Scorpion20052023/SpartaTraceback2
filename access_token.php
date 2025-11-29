<?php
$consumerKey = "YOUR_KEY";
$consumerSecret = "YOUR_SECRET";

$credentials = base64_encode($consumerKey . ":" . $consumerSecret);

$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, 'https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials');
curl_setopt($curl, CURLOPT_HTTPHEADER, array('Authorization: Basic ' . $credentials));
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($curl);
curl_close($curl);

$result = json_decode($response);
$access_token = $result->access_token;
?>
