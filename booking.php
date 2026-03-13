<?php
session_start();
include('panel/includes/dbconnection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $Name = mysqli_real_escape_string($con, $_POST['name']);
    $Email = mysqli_real_escape_string($con, $_POST['email']);
    $PhoneNumber = mysqli_real_escape_string($con, $_POST['phone']);
    
    $final_customer_id = 0;

    // Check if customer exists
    $stmt_check = $con->prepare("SELECT ID FROM tblcustomers WHERE Email=? OR MobileNumber=? LIMIT 1");
    $stmt_check->bind_param("ss", $Email, $PhoneNumber);
    $stmt_check->execute();
    $result_check = $stmt_check->get_result();

    if($result_check->num_rows > 0) {
        $existing_customer = $result_check->fetch_assoc();
        $final_customer_id = $existing_customer['ID'];
    } else {
        // New customer, create one
        $stmt_insert = $con->prepare("INSERT INTO tblcustomers(Name, Email, MobileNumber) VALUES (?, ?, ?)");
        $stmt_insert->bind_param("sss", $Name, $Email, $PhoneNumber);
        if ($stmt_insert->execute()) {
            $final_customer_id = $stmt_insert->insert_id;
        }
    }
    $stmt_check->close();

    if ($final_customer_id > 0) {
        $AptNumber = mt_rand(100000000, 999999999);
        $AptDate = mysqli_real_escape_string($con, $_POST['apt_date']);
        $AptTime = mysqli_real_escape_string($con, $_POST['apt_time']);
        $total = mysqli_real_escape_string($con, $_POST['total']);
        $branch_id = mysqli_real_escape_string($con, $_POST['branch_id']);
        $status = ''; // Pending status
        $Services = isset($_POST['serv_id']) ? implode(",", $_POST['serv_id']) : '';
        $remark = "Booked Online";
        $date= date('Y-m-d H:i:s');

        // Insert into tblappointment using the customer ID
        $sql = "INSERT INTO tblappointment (AptNumber, Status, Name, Email, PhoneNumber, AptDate, AptTime, Remark, RemarkDate, Services, total, branch_id) 
                VALUES ('$AptNumber','$status', '$final_customer_id', '$Email', '$PhoneNumber', '$AptDate', '$AptTime','$remark','$date', '$Services','$total', '$branch_id')";

        if (mysqli_query($con, $sql)) {
            echo "success";
        } else {
            echo "Error: " . mysqli_error($con);
        }
    } else {
        echo "Error: Could not find or create customer.";
    }
}
?>
