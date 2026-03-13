<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['bpmsaid']==0)) {
  header('location:logout.php');
  } else{

$branding_query = mysqli_query($con, "select * from branding where id=1");
$branding_row = mysqli_fetch_array($branding_query);
?>
<!DOCTYPE HTML>
<html>
<head>
<title>Completed Appointments</title>
<link rel="icon" type="image/x-icon" href="images/<?php echo $branding_row['favicon'];?>">
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
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
<link href='//fonts.googleapis.com/css?family=Roboto+Condensed:400,300,300italic,400italic,700,700italic' rel='stylesheet' type='text/css'>
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
					<h3 class="title1">All Completed Appointments</h3>
					<?php include_once('appointment-search-filter.php'); ?>
					<div class="table-responsive bs-example widget-shadow" style="margin-bottom: 30px;">
						<h4>Completed Appointments List:</h4>
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
                                    <th>Branch</th>
                                    <th>Status</th>
                                </tr> 
                            </thead> 
                            <tbody>
                            <?php
                            $where_conditions = ["ta.Status = '3'"];
                            $appointment_sql = "SELECT ta.*, tc.Name as CustomerName, tb.branch_name 
                                                FROM tblappointment as ta 
                                                LEFT JOIN tblcustomers as tc ON ta.Name = tc.ID 
                                                LEFT JOIN tblbranch as tb ON ta.branch_id = tb.branch_id";

                            // If a branch is selected from the filter (for admins)
                            if ($_SESSION['bpmsut'] == 'admin' && isset($_POST['filter']) && !empty($_POST['branch_id'])) {
                                $branch_id = intval($_POST['branch_id']);
                                $where_conditions[] = "ta.branch_id = $branch_id";
                            }

                            // If user is a cashier, they can only see their own branch, regardless of filter.
                            if ($_SESSION['bpmsut'] == 'cashier') {
                                $cashierId = $_SESSION['bpmsaid'];
                                $cashier_branch_query = mysqli_query($con, "SELECT branch_id FROM tblcashier WHERE ID = '$cashierId'");
                                if ($cashier_branch_row = mysqli_fetch_assoc($cashier_branch_query)) {
                                    $user_branch_id = $cashier_branch_row['branch_id'];
                                    if ($user_branch_id) {
                                        $where_conditions[] = "ta.branch_id = '$user_branch_id'";
                                    } else {
                                        $where_conditions[] = "1=0"; // Cashier not assigned to a branch
                                    }
                                } else {
                                    $where_conditions[] = "1=0"; // Cashier not found
                                }
                            }

                            if(isset($_POST['filter'])) {
                                if(!empty($_POST['searchdata'])) {
                                    $sdata = mysqli_real_escape_string($con, $_POST['searchdata']);
                                    $where_conditions[] = "(ta.AptNumber LIKE '%$sdata%' OR tc.Name LIKE '%$sdata%' OR ta.PhoneNumber LIKE '%$sdata%')";
                                }

                                $from_date = !empty($_POST['fromdate']) ? mysqli_real_escape_string($con, $_POST['fromdate']) : '';
                                $to_date = !empty($_POST['todate']) ? mysqli_real_escape_string($con, $_POST['todate']) : '';

                                if(!empty($from_date) && !empty($to_date)) {
                                    $where_conditions[] = "ta.AptDate BETWEEN '$from_date' AND '$to_date'";
                                } elseif(!empty($from_date)) {
                                    $where_conditions[] = "ta.AptDate >= '$from_date'";
                                } elseif(!empty($to_date)) {
                                    $where_conditions[] = "ta.AptDate <= '$to_date'";
                                }
                            }
                            
                            $appointment_sql .= " WHERE " . implode(' AND ', $where_conditions) . " ORDER BY ta.AptDate DESC, ta.AptTime DESC";
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
                                    <td><?php echo $row['branch_name']; ?></td>
                                    <td>Completed</td>
                                </tr>
                            <?php 
                                $cnt=$cnt+1;
                                }
                            } else {
                                echo '<tr><td colspan="8" class="text-center">No completed appointments found for this branch with the current filter.</td></tr>';
                            }
                            ?>
                            </tbody> 
                        </table> 
					</div>
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