<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

if (strlen($_SESSION['bpmsaid']) == 0) {
    header('location:logout.php');
} else {
    if (isset($_POST['submit'])) {
        $stocks = $_POST['stock'];

        // Begin transaction
        mysqli_begin_transaction($con);

        try {
            // Prepare the statement once outside the loop
            $stmt = $con->prepare("INSERT INTO tbl_branch_stock (service_id, branch_id, quantity) VALUES (?, ?, ?) ON DUPLICATE KEY UPDATE quantity = ?");

            foreach ($stocks as $service_id => $branch_stocks) {
                foreach ($branch_stocks as $branch_id => $quantity) {
                    $service_id_int = intval($service_id);
                    $branch_id_int = intval($branch_id);
                    $quantity_int = intval($quantity);

                    // Bind parameters and execute for each item
                    $stmt->bind_param("iiii", $service_id_int, $branch_id_int, $quantity_int, $quantity_int);

                    if (!$stmt->execute()) {
                        // If a single update fails, throw an exception to trigger a rollback
                        throw new Exception(mysqli_error($con));
                    }
                }
            }
            // If all queries were successful, commit the transaction
            mysqli_commit($con);
            echo "<script>alert('Stock levels updated successfully.');</script>";
            echo "<script>window.location.href = 'branch-stock-management.php'</script>";
        } catch (Exception $e) {
            // If any query fails, roll back the transaction
            mysqli_rollback($con);
            echo "<script>alert('Something went wrong. Please try again.');</script>";
            echo "<script>window.location.href = 'branch-stock-management.php'</script>";
        }
    } else {
        header('location:branch-stock-management.php');
    }
}
?>