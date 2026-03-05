<?php
include('includes/dbconnection.php');

if (isset($_POST['branch_id'])) {
    $branch_id = $_POST['branch_id'];
    
    if ($branch_id != "") {
        $query = mysqli_query($con, "SELECT * FROM tbl_staff WHERE branch_id = '$branch_id'");
    } else {
        $query = mysqli_query($con, "SELECT * FROM tbl_staff");
    }
    
    echo '<option value="">All Staff</option>';
    while ($row = mysqli_fetch_array($query)) {
        echo '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
    }
}
?>