<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['bpmsaid']==0)) {
  header('location:logout.php');
  } else{

if(isset($_GET['action']) && $_GET['action'] == 'update_status') {
    $id = intval($_GET['id']);
    $status = intval($_GET['status']);
    
    if ($status == 3 || $status == 4) { // 3 for Completed, 4 for Absent
        $query = mysqli_query($con, "UPDATE tblappointment SET Status='$status' WHERE ID='$id'");
        if($query) {
            $msg = ($status == 3) ? "Appointment marked as Completed." : "Appointment marked as Absent.";
            echo "<script>alert('$msg');</script>";
            echo "<script>window.location.href='branch-appoinment-list.php'</script>";
        } else {
            echo "<script>alert('Something went wrong. Please try again.');</script>";
            echo "<script>window.location.href='branch-appoinment-list.php'</script>";
        }
    }
}

$branding_query = mysqli_query($con, "select * from branding where id=1");
$branding_row = mysqli_fetch_array($branding_query);
?>
<!DOCTYPE HTML>
<html>

<head>
    <title>Branch Wise Accepted Appointments</title>
    <link rel="icon" type="image/x-icon" href="images/<?php echo $branding_row['favicon'];?>">
    <script type="application/x-javascript">
    addEventListener("load", function() {
        setTimeout(hideURLbar, 0);
    }, false);

    function hideURLbar() {
        window.scrollTo(0, 1);
    }
    </script>
    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
    <!-- Custom CSS -->
    <link href="css/style.css" rel='stylesheet' type='text/css' />
    <!-- font CSS -->
    <!-- font-awesome icons -->
    <link href="css/font-awesome.css" rel="stylesheet">
    <!-- //font-awesome icons -->
    <!-- js-->
    <script src="js/jquery-1.11.1.min.js"></script>
    <script src="js/modernizr.custom.js"></script>
    <!--webfonts-->
    <link href='//fonts.googleapis.com/css?family=Roboto+Condensed:400,300,300italic,400italic,700,700italic'
        rel='stylesheet' type='text/css'>
    <!--//webfonts-->
    <!--animate-->
    <link href="css/animate.css" rel="stylesheet" type="text/css" media="all">
    <script src="js/wow.min.js"></script>
    <script>
    new WOW().init();
    </script>
    <!--//end-animate-->
    <!-- Metis Menu -->
    <script src="js/metisMenu.min.js"></script>
    <script src="js/custom.js"></script>
    <link href="css/custom.css" rel="stylesheet">
    <!--//Metis Menu -->
</head>

<body class="cbp-spmenu-push">
    <div class="main-content">
        <!--left-fixed -navigation-->
        <?php include_once('includes/sidebar.php');?>
        <!--left-fixed -navigation-->
        <!-- header-starts -->
        <?php include_once('includes/header.php');?>
        <!-- //header-ends -->
        <!-- main content start-->
        <div id="page-wrapper">
            <div class="main-page">
                <div class="tables">
                    <h3 class="title1">Branch Wise Accepted Appointments</h3>

                    <?php
                    $branch_sql = "SELECT * FROM tblbranch ORDER BY branch_name";
                    if ($_SESSION['bpmsut'] == 'cashier') {
                        $cashierId = $_SESSION['bpmsaid'];
                        $cashier_branch_query = mysqli_query($con, "SELECT branch_id FROM tblcashier WHERE ID = '$cashierId'");
                        if ($cashier_branch_row = mysqli_fetch_assoc($cashier_branch_query)) {
                            $user_branch_id = $cashier_branch_row['branch_id'];
                            if ($user_branch_id) {
                                $branch_sql = "SELECT * FROM tblbranch WHERE branch_id = '$user_branch_id'";
                            } else {
                                // Cashier not assigned to a branch, show nothing.
                                $branch_sql = "SELECT * FROM tblbranch WHERE 1=0"; 
                            }
                        } else {
                            // Cashier not found, show nothing.
                            $branch_sql = "SELECT * FROM tblbranch WHERE 1=0";
                        }
                    }
                    $branch_query = mysqli_query($con, $branch_sql);
                    if(mysqli_num_rows($branch_query) > 0) {
                        while($branch = mysqli_fetch_array($branch_query)) {
                            $branch_id = $branch['branch_id'];
                            $branch_name = $branch['branch_name'];
                    ?>
                    <div class="table-responsive bs-example widget-shadow" style="margin-bottom: 30px;">
                        <h4>Accepted Appointments for: <?php echo htmlspecialchars($branch_name); ?></h4>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Apt. Number</th>
                                    <th>Name</th>
                                    <th>Mobile Number</th>
                                    <th>Apt. Date</th>
                                    <th>Apt. Time</th>
                                    <th>Services</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                            $appointment_sql = "SELECT ta.*, tc.Name as CustomerName 
                                                FROM tblappointment as ta 
                                                LEFT JOIN tblcustomers as tc ON ta.Name = tc.ID 
                                                WHERE ta.branch_id = '$branch_id' AND ta.Status = '1'
                                                ORDER BY ta.AptDate DESC, ta.AptTime DESC";
                            $appointment_result = mysqli_query($con, $appointment_sql);
                            $cnt=1;
                            if(mysqli_num_rows($appointment_result) > 0) {
                                while ($row=mysqli_fetch_array($appointment_result)) {
                            ?>
                                <tr>
                                    <th scope="row"><?php echo $cnt;?></th>
                                    <td><?php  echo $row['AptNumber'];?></td>
                                    <td><?php  echo $row['CustomerName'];?></td>
                                    <td><?php  echo $row['PhoneNumber'];?></td>
                                    <td><?php  echo date('d-m-Y', strtotime($row['AptDate']));?></td>
                                    <td><?php  echo date('H:i', strtotime($row['AptTime']));?></td>
                                    <td>
                                        <?php
                                        $service_ids_str = $row['Services'];
                                        if (!empty($service_ids_str)) {
                                            $service_ids = array_map('intval', explode(',', $service_ids_str));
                                            $service_ids_in = implode(',', $service_ids);
                                            
                                            if (!empty($service_ids_in)) {
                                                $service_names = [];
                                                $service_query = mysqli_query($con, "SELECT ServiceName FROM tblservices WHERE ID IN ($service_ids_in)");
                                                while ($service_row = mysqli_fetch_array($service_query)) {
                                                    $service_names[] = $service_row['ServiceName'];
                                                }
                                                echo implode(', ', $service_names);
                                            }
                                        } ?>
                                    </td>
                                    <td>
                                        <?php
                                        if($row['Status']=="1") {
                                            echo "Accepted";
                                        } elseif($row['Status']=="2") {
                                            echo "Rejected";
                                        } else {
                                            echo "Pending";
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <a href="branch-appoinment-list.php?action=update_status&id=<?php echo $row['ID'];?>&status=3"
                                            class="btn btn-success btn-sm"
                                            onclick="return confirm('Mark as Completed?')">Completed</a>
                                        <a href="branch-appoinment-list.php?action=update_status&id=<?php echo $row['ID'];?>&status=4"
                                            class="btn btn-danger btn-sm"
                                            onclick="return confirm('Mark as Absent?')">Absent</a>
                                    </td>
                                </tr>
                                <?php 
                                $cnt=$cnt+1;
                                }
                            } else {
                                echo '<tr><td colspan="9" class="text-center">No appointments found for this branch.</td></tr>';
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>
                    <?php 
                        }
                    } else {
                        echo '<p>No branches found.</p>';
                    }
                    ?>
                </div>
            </div>
        </div>
        <!--footer-->
        <?php include_once('includes/footer.php');?>
        <!--//footer-->
    </div>
</body>

</html>
<?php }  ?>