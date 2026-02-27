<?php
 session_start();
// include('panel/assets/constant/config.php');
include('panel/includes/dbconnection.php');

    $keyId = "rzp_test_NztH8uGmFZkb5I";
    $keySecret = "Dqnjxwto91Zvp1NdudTG2ov1";

$amount = (int)($_POST['amount']*100);
$currency = 'LKR';
$receipt = $_POST['receipt'];
$payment_capture = 1;

$data = [
    'amount' => $amount,
    'currency' => $currency,
    'receipt' => $receipt,
    'payment_capture' => $payment_capture,
];

$ch = curl_init('https://api.razorpay.com/v1/orders');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_USERPWD, $keyId . ':' . $keySecret);
curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

$response = curl_exec($ch);
if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
}
curl_close($ch);

echo $response;
?>