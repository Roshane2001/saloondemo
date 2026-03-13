<?php
session_start();
include('../includes/dbconnection.php');

header('Content-Type: application/json');

if (strlen($_SESSION['bpmsaid'])==0) {
    echo json_encode(['status' => 'error', 'message' => 'Session expired']);
    exit;
}

$input = file_get_contents('php://input');
$data = json_decode($input, true);

if (!$data) {
    echo json_encode(['status' => 'error', 'message' => 'Invalid data received']);
    exit;
}

$items = $data['items'];
$grandTotal = $data['grandTotal'];
$paymentMethod = $data['paymentMethod'];
$taxRate = isset($data['taxRate']) ? $data['taxRate'] : 0;
$discount = isset($data['discount']) ? $data['discount'] : 0;
$amountReceived = isset($data['amountReceived']) ? $data['amountReceived'] : 0;
$customerPhone = isset($data['customerPhone']) ? mysqli_real_escape_string($con, $data['customerPhone']) : '';
$invoiceId = mt_rand(100000000, 999999999);
$cashierId = $_SESSION['bpmsaid'];

$branchId = 0;
if(isset($_SESSION['bpmsut']) && $_SESSION['bpmsut'] == 'cashier'){
    $query_branch = mysqli_query($con, "SELECT branch_id FROM tblcashier WHERE ID='$cashierId'");
    $result_branch = mysqli_fetch_assoc($query_branch);
    if($result_branch){
        $branchId = $result_branch['branch_id'];
    }
}

$success = true;
$errorMsg = "";

$postingDate = date('Y-m-d H:i:s'); // Get current time based on timezone in dbconnection.php

// 1. Check Stock Availability First
foreach ($items as $item) {
    $serviceId = intval($item['id']);
    $qty = intval($item['qty']);
    
    // Check stock in tbl_branch_stock for this branch
    $stockQuery = mysqli_query($con, "SELECT s.ServiceName, s.type, bs.quantity FROM tblservices s LEFT JOIN tbl_branch_stock bs ON s.ID = bs.service_id AND bs.branch_id = '$branchId' WHERE s.ID='$serviceId'");
    $stockRow = mysqli_fetch_assoc($stockQuery);
    
    if ($stockRow && $stockRow['type'] == 1) { // Only check stock for products (type 1)
        $available_qty = $stockRow['quantity'] ? $stockRow['quantity'] : 0;
        if ($available_qty < $qty) {
            echo json_encode(['status' => 'error', 'message' => "Insufficient stock for " . $stockRow['ServiceName'] . ". Available: " . $available_qty]);
            exit;
        }
    }
}

foreach ($items as $item) {
    $serviceId = intval($item['id']);
    $qty = intval($item['qty']);
    $staffId = isset($item['staff_id']) ? intval($item['staff_id']) : 0;
    
    // Insert into tblinvoice
    $query = "INSERT INTO tblinvoice (Userid, ServiceId, BillingId, tax, discount, qty, total, received_amount, payment_method, type, CashierId, branch_id, PostingDate, customer_phone, staff) 
              VALUES (NULL, '$serviceId', '$invoiceId', '$taxRate', '$discount', '$qty', '$grandTotal', '$amountReceived', '$paymentMethod', 1, '$cashierId', '$branchId', '$postingDate', '$customerPhone', '$staffId')";
              
    if (!mysqli_query($con, $query)) {
        $success = false;
        $errorMsg = mysqli_error($con);
        break;
    }
    
    // Update stock in tbl_branch_stock if it is a product
    $checkType = mysqli_query($con, "SELECT type FROM tblservices WHERE ID='$serviceId'");
    $typeRow = mysqli_fetch_assoc($checkType);
    if($typeRow && $typeRow['type'] == 1) {
        $updateStock = "UPDATE tbl_branch_stock SET quantity = quantity - $qty WHERE service_id = '$serviceId' AND branch_id = '$branchId'";
        mysqli_query($con, $updateStock);
    }
}

if ($success) {
    echo json_encode(['status' => 'success', 'invoice_id' => $invoiceId, 'posting_date' => $postingDate]);
} else {
    echo json_encode(['status' => 'error', 'message' => $errorMsg]);
}
?>