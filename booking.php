<?php
session_start();
include('panel/includes/dbconnection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $AptNumber = mt_rand(100000000, 999999999);
    // print_r($_POST); exit;
    // Secure inputs
    $Name = mysqli_real_escape_string($con, $_POST['name']);
    $Email = mysqli_real_escape_string($con, $_POST['email']);
    $PhoneNumber = mysqli_real_escape_string($con, $_POST['phone']);
    $AptDate = mysqli_real_escape_string($con, $_POST['apt_date']);
    $AptTime = mysqli_real_escape_string($con, $_POST['apt_time']);
    $total = mysqli_real_escape_string($con, $_POST['total']);
    $grand_total = mysqli_real_escape_string($con, $_POST['grand_total']);
    $payment_id = mysqli_real_escape_string($con, $_POST['payment_id']);
    $order_id = mysqli_real_escape_string($con, $_POST['order_id']);
    $status = '1';
    // Multiple services as comma-separated
    $Services = isset($_POST['serv_id']) ? implode(",", $_POST['serv_id']) : '';
    $remark = "Booked";
    $date= date('d-m-Y H:i:s');
//  print_r($date); exit;
    // Insert into tblappointment
    $sql = "INSERT INTO tblappointment (AptNumber, Status, Name, Email, PhoneNumber, AptDate, AptTime, Remark, RemarkDate, Services, total, grand_total, payment_id, order_id) 
            VALUES ('$AptNumber','$status', '$Name', '$Email', '$PhoneNumber', '$AptDate', '$AptTime','$remark','$date', '$Services','$total','$grand_total', '$payment_id', '$order_id')";

    if (mysqli_query($con, $sql)) {
        echo "success";
    } else {
        echo "Error: " . mysqli_error($con);
    }
}
?>
<!--  Author Name: Mayuri K. 
 for any PHP, Wordpress, Shopify or Laravel website or software development contact me at work@mayurik.com  -->