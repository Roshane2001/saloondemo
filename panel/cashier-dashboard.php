<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['bpmsaid']==0)) {
  header('location:logout.php');
  }

  // Get cashier's branch ID
  $cashierId = $_SESSION['bpmsaid'];
  $branch_query = mysqli_query($con, "SELECT branch_id FROM tblcashier WHERE ID = '$cashierId'");
  $branch_row_data = mysqli_fetch_assoc($branch_query);
  $branchId = $branch_row_data['branch_id'];

  $branding_query = mysqli_query($con, "select * from branding where id=1");
$branding_row = mysqli_fetch_array($branding_query);
     ?>
<!DOCTYPE HTML>
<html>

<head>
    <title>Cashier Dashboard</title>

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
    <!-- chart -->
    <script src="js/Chart.js"></script>
    <!-- //chart -->
    <!--Calender-->
    <link rel="stylesheet" href="css/clndr.css" type="text/css" />
    <script src="js/underscore-min.js" type="text/javascript"></script>
    <script src="js/moment-2.2.1.js" type="text/javascript"></script>
    <script src="js/clndr.js" type="text/javascript"></script>
    <script src="js/site.js" type="text/javascript"></script>
    <!--End Calender-->
    <!-- Metis Menu -->
    <script src="js/metisMenu.min.js"></script>
    <script src="js/custom.js"></script>
    <link href="css/custom.css" rel="stylesheet">


    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link href="https://cdn.datatables.net/2.2.2/css/dataTables.bootstrap.css">
    <link href="https://cdn.datatables.net/buttons/3.2.2/css/buttons.bootstrap.css">

    <!-- FullCalendar CSS -->
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.css" rel="stylesheet" />

    <!--//Metis Menu -->
</head>

<body class="cbp-spmenu-push">
    <div class="main-content">

        <?php include_once('includes/sidebar.php');?>

        <?php include_once('includes/header.php');?>

        <!-- main content start-->
        <div id="page-wrapper" class="row calender widget-shadow">

            <div class="main-page">
                <div class="row">

                    <div class="col-md-4 mb-2">
                        <?php $query1=mysqli_query($con,"Select distinct BillingId from tblinvoice where date(PostingDate)=CURDATE() AND branch_id = '$branchId'");
                                    $totalcust=mysqli_num_rows($query1);
                                    ?>
                        <div class="dashboard-boxes bg1 ">
                            <i class="ti ti-user fs"></i>
                            <div class="text-end">
                                <label> <?php echo $totalcust;?></label>
                                <h4>Day Total Customers</h4>
                            </div>
                        </div>
                        <div class="clearfix"> </div>
                    </div>

                    <div class="col-md-4 mb-2">
                        <?php
                                // Today's sale for the specific branch
                                $query_sales = mysqli_query($con, "SELECT SUM(total) as todays_sale FROM (SELECT DISTINCT BillingId, total FROM tblinvoice WHERE date(PostingDate) = CURDATE() AND branch_id = '$branchId') as daily_sales");
                                $sales_row = mysqli_fetch_assoc($query_sales);
                                $todysale = $sales_row['todays_sale'] ? $sales_row['todays_sale'] : 0;
                                ?>
                        <div class="dashboard-boxes bg6">
                            <i class="ti ti-tags fs"></i>
                            <div class="text-end">
                                <label> <?php echo number_format($todysale,2);?></label>
                                <h4>Today Sales</h4>
                            </div>
                        </div>
                        <div class="clearfix"> </div>
                    </div>

                    <div class="col-md-4 mb-2">
                        <?php
                                // Today's processed (Completed or Absent) appointments for the specific branch
                                $query_appts = mysqli_query($con, "SELECT COUNT(ID) as total_appts FROM tblappointment WHERE DATE(AptDate) = CURDATE() AND branch_id = '$branchId' AND (Status = '3' OR Status = '4')");
                                $appts_row = mysqli_fetch_assoc($query_appts);
                                $today_appts = $appts_row['total_appts'] ? $appts_row['total_appts'] : 0;
                                ?>
                        <div class="dashboard-boxes bg5">
                            <i class="ti ti-list fs"></i>
                            <div class="text-end">
                                <label> <?php echo $today_appts;?></label>
                                <h4>Day Branch Appoinment</h4>
                            </div>
                        </div>
                        <div class="clearfix"> </div>
                    </div>

                    <div class="col-md-4 mb-2">
                        <?php
                                // Today's COMPLETED appointments for the specific branch
                                $query_appts_completed = mysqli_query($con, "SELECT COUNT(ID) as total_appts FROM tblappointment WHERE DATE(AptDate) = CURDATE() AND branch_id = '$branchId' AND Status = '3'");
                                $appts_row_completed = mysqli_fetch_assoc($query_appts_completed);
                                $today_appts_completed = $appts_row_completed['total_appts'] ? $appts_row_completed['total_appts'] : 0;
                                ?>
                        <div class="dashboard-boxes bg3">
                            <i class="ti ti-check fs"></i>
                            <div class="text-end">
                                <label> <?php echo $today_appts_completed;?></label>
                                <h4>Day Branch Appoinments completed</h4>
                            </div>
                        </div>
                        <div class="clearfix"> </div>
                    </div>

                    <div class="col-md-4 mb-2">
                        <?php
                                // Today's ABSENT appointments for the specific branch
                                $query_appts_absent = mysqli_query($con, "SELECT COUNT(ID) as total_appts FROM tblappointment WHERE DATE(AptDate) = CURDATE() AND branch_id = '$branchId' AND Status = '4'");
                                $appts_row_absent = mysqli_fetch_assoc($query_appts_absent);
                                $today_appts_absent = $appts_row_absent['total_appts'] ? $appts_row_absent['total_appts'] : 0;
                                ?>
                        <div class="dashboard-boxes bg4">
                            <i class="ti ti-file fs"></i>
                            <div class="text-end">
                                <label> <?php echo $today_appts_absent;?></label>
                                <h4>Day Branch Appoinments Absent</h4>
                            </div>
                        </div>
                        <div class="clearfix"> </div>
                    </div>


                    <div class="clearfix"> </div>
                </div>
            </div>
        </div>
        <!--footer-->
        <?php include_once('includes/footer.php');?>
    </div>
</body>

</html>