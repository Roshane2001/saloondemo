<?php
session_start();
include('includes/dbconnection.php');
if (strlen($_SESSION['bpmsaid']==0)) {
  // No output on error for AJAX
  http_response_code(401);
  exit();
}

if (isset($_GET['term'])) {
    $term = $_GET['term'];
    $stmt = $con->prepare("SELECT * FROM tblcustomers WHERE MobileNumber LIKE ? LIMIT 10");
    $searchTerm = "%" . $term . "%";
    $stmt->bind_param("s", $searchTerm);
    $stmt->execute();
    $result = $stmt->get_result();
    
    $customers = [];
    while ($row = $result->fetch_assoc()) {
        $customers[] = [
            'id' => $row['ID'],
            'label' => $row['MobileNumber'] . ' (' . $row['Name'] . ')', // for display in dropdown
            'email' => $row['Email'],
            'name' => $row['Name'],
            'phone' => $row['MobileNumber']
        ];
    }
    echo json_encode($customers);
}
?>