<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['bpmsaid']==0)) {
  header('location:logout.php');
  } 
  $branding_query = mysqli_query($con, "select * from branding where id=1");
$branding_row = mysqli_fetch_array($branding_query);
     ?>
<!DOCTYPE HTML>
<html>

<head>
    <title>Admin Dashboard</title>

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
                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 mb-2">
                        <?php $query2=mysqli_query($con,"Select ID from tblappointment where Status='' OR Status IS NULL");
$totalappointment=mysqli_num_rows($query2);
?>
                        <div class="dashboard-boxes bg2">
                            <i class="ti ti-list fs"></i>


                            <div class="text-end">

                                <label> <?php echo $totalappointment;?></label>
                                <h4>Online Appoinments Pending</h4>

                            </div>
                        </div>
                        <div class="clearfix"> </div>
                    </div>

                </div>
                <div class="row">

                    <!--<div class="col-md-3 mb-2">
                            <?php $query1=mysqli_query($con,"Select * from tblcustomers");
                                    $totalcust=mysqli_num_rows($query1);
                                    ?>
                            <div class="dashboard-boxes bg1 ">
                                <i class="ti ti-user fs"></i>

                                <div class="text-end">
                                    <label> <?php echo $totalcust;?></label>
                                    <h4>Total Customer</h4>

                                </div>
                            </div>
                            <div class="clearfix"> </div>
                        </div>-->

                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 mb-2">
                        <?php $query1=mysqli_query($con,"Select distinct BillingId from tblinvoice where date(PostingDate)=CURDATE()");
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


                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 mb-2">
                        <?php $query2=mysqli_query($con,"Select * from tblappointment");
$totalappointment=mysqli_num_rows($query2);
?>
                        <div class="dashboard-boxes bg2">
                            <i class="ti ti-list fs"></i>


                            <div class="text-end">

                                <label> <?php echo $totalappointment;?></label>
                                <h4>Total Appointment</h4>

                            </div>
                        </div>
                        <div class="clearfix"> </div>
                    </div>
                    <!--<div class="col-md-3 mb-2">
                            <?php 
                            // Day Total Income
                            $query3=mysqli_query($con,"select sum(total) as todays_income from tblinvoice where date(PostingDate)=CURDATE()");
                            $result3=mysqli_fetch_array($query3);
                            $todays_income=$result3['todays_income'];
                            if($todays_income=='') $todays_income=0;
?>
                            <div class="dashboard-boxes bg3">
                                <i class="ti ti-wallet fs"></i>

                                <div class="text-end">
                                    <label><?php echo $todays_income;?></label>
                                    <h4>Day Total Income</h4>

                                </div>
                            </div>
                            <div class="clearfix"> </div>
                        </div>-->

                    <!--<div class="col-md-3 mb-2">
                            <?php $query4=mysqli_query($con,"Select * from tblappointment where Status='2'");
$totalrejapt=mysqli_num_rows($query4);
?>
                            <div class="dashboard-boxes bg4">
                                <i class="ti ti-file fs"></i>


                                <div class="text-end">
                                    <label> <?php echo $totalrejapt;?></label>
                                    <h4>Total Rejected Apt</h4>
                                    !--  Author Name: Mayuri K. 
 for any PHP, Wordpress, Shopify or Laravel website or software development contact me at work@mayurik.com  --
                                </div>
                            </div>
                            <div class="clearfix"> </div>
                        </div>-->

                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 mb-2">
                        <?php
                                //todays sale
                                $query6 = mysqli_query($con, "SELECT SUM(total) as todysale FROM (SELECT DISTINCT BillingId, total FROM tblinvoice WHERE date(PostingDate)=CURDATE()) as distinct_invoices");
                                $row6 = mysqli_fetch_assoc($query6);
                                $todysale = $row6['todysale'] ?? 0;
                                ?>
                        <div class="dashboard-boxes bg6">
                            <i class="ti ti-tags fs"></i>
                            <div class="text-end">
                                <label> <?php 
                                        echo number_format($todysale, 2);
                                        ?>
                                </label>
                                <h4>Today Sales</h4>
                            </div>
                        </div>
                        <div class="clearfix"> </div>
                    </div>
                    <!--<div class="col-md-3 mb-2">
                            <?php
                                //Yesterday's sale
                                $query7=mysqli_query($con,"select tblinvoice.ServiceId as ServiceId, tblservices.Cost
                                from tblinvoice 
                                join tblservices  on tblservices.ID=tblinvoice.ServiceId where date(PostingDate)=CURDATE()-1;");
                                while($row7=mysqli_fetch_array($query7))
                                {
                                $yesterdays_sale=$row7['Cost'];
                                $yesterdaysale+=$yesterdays_sale;

                                }
                                ?>
                            <div class="dashboard-boxes bg7">
                                <i class="ti ti-credit-card fs"></i>
                                <div class="text-end">
                                    <label>
                                        <?php if($yesterdaysale==''):
                                        echo "0";
                                    else:
                                        echo $yesterdaysale;
                                    endif;
                                    ?>
                                    </label>
                                    <h4>Yesterday Sales</h4>
                                </div>
                            </div>
                            <div class="clearfix"> </div>
                        </div>-->


                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 mb-2">
                        <?php
                            //Last Sevendays Sale
                            $query8 = mysqli_query($con, "SELECT SUM(total) as sevensale FROM (SELECT DISTINCT BillingId, total FROM tblinvoice WHERE date(PostingDate)>=(DATE(NOW()) - INTERVAL 7 DAY)) as distinct_invoices");
                            $row8 = mysqli_fetch_assoc($query8);
                            $tseven = $row8['sevensale'] ?? 0;
                            ?>
                        <div class="dashboard-boxes bg8">
                            <i class="ti ti-files fs"></i>
                            <div class="text-end">
                                <label>
                                    <?php echo number_format($tseven, 2); ?>
                                </label>
                                <h4>Last Sevendays Sale</h4>

                            </div>
                        </div>
                        <div class="clearfix"> </div>
                    </div>


                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 mb-2">
                        <?php
                            //Total Sale
                            $query9 = mysqli_query($con, "SELECT SUM(total) as totalsale FROM (SELECT DISTINCT BillingId, total FROM tblinvoice) as distinct_invoices");
                            $row9 = mysqli_fetch_assoc($query9);
                            $totalsale = $row9['totalsale'] ?? 0;
                            ?>
                        <div class="dashboard-boxes bg9">
                            <i class="ti ti-pig-money fs"></i>
                            <div class="text-end">
                                <label>
                                    <?php echo number_format($totalsale, 2); ?>
                                </label>
                                <h4>Total Sales</h4>
                            </div>
                        </div>
                        <div class="clearfix"> </div>
                    </div>
                    <div class="clearfix"> </div>
                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 mb-2">
                        <?php $query5=mysqli_query($con,"Select * from  tblservices");
$totalser=mysqli_num_rows($query5);
?>
                        <div class="dashboard-boxes bg5">
                            <i class="ti ti-hotel-service fs"></i>

                            <div class="text-end">
                                <label> <?php echo $totalser;?></label>
                                <h4>Total Services</h4>
                            </div>
                        </div>
                        <div class="clearfix"> </div>
                    </div>
                    <!--Total Branches-->
                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 mb-2">
                        <?php $query_branch=mysqli_query($con,"Select * from tblbranch");
$totalbranches=mysqli_num_rows($query_branch);
?>
                        <div class="dashboard-boxes bg5">
                            <i class="ti ti-hotel-service fs"></i>

                            <div class="text-end">
                                <label> <?php echo $totalbranches;?></label>
                                <h4>Total Branches</h4>
                            </div>
                        </div>
                        <div class="clearfix"> </div>
                    </div>
                </div>
                <div class="clearfix"> </div>
                <div class="row">
                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 mb-2">
                        <?php $query2=mysqli_query($con,"Select ID from tblappointment where date(AptDate)=CURDATE()");
$totalappointment=mysqli_num_rows($query2);
?>
                        <div class="dashboard-boxes bg2">
                            <i class="ti ti-list fs"></i>


                            <div class="text-end">

                                <label> <?php echo $totalappointment;?></label>
                                <h4>All Branches Appointments in Day</h4>

                            </div>
                        </div>
                        <div class="clearfix"> </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 mb-2">
                        <?php $query2=mysqli_query($con,"Select ID from tblappointment where date(AptDate)=CURDATE() AND Status='3'");
$totalappointment=mysqli_num_rows($query2);
?>
                        <div class="dashboard-boxes bg2">
                            <i class="ti ti-list fs"></i>


                            <div class="text-end">

                                <label> <?php echo $totalappointment;?></label>
                                <h4>All Branches Completed Appointments in Day</h4>

                            </div>
                        </div>
                        <div class="clearfix"> </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 mb-2">
                        <?php $query2=mysqli_query($con,"Select ID from tblappointment where date(AptDate)=CURDATE() AND Status='3'");
$totalappointment=mysqli_num_rows($query2);
?>
                        <div class="dashboard-boxes bg2">
                            <i class="ti ti-list fs"></i>
                            <div class="text-end">
                                <label> <?php echo $totalappointment;?></label>
                                <h4>All Branches Absent Appointments in Day</h4>
                            </div>
                        </div>
                        <div class="clearfix"> </div>
                    </div>
                </div>
                <div class="row">
                    <!----Each Branch Day income-->
                    <?php
                        $branch_income_query = mysqli_query($con, "
                            SELECT 
                                b.branch_name, 
                                SUM(sub.total) as daily_branch_income
                            FROM 
                                tblbranch b
                            LEFT JOIN 
                                (SELECT DISTINCT BillingId, total, branch_id FROM tblinvoice WHERE branch_id IS NOT NULL AND DATE(PostingDate) = CURDATE()) AS sub 
                            ON 
                                b.branch_id = sub.branch_id
                            GROUP BY 
                                b.branch_id, b.branch_name
                        ");
                        $bg_colors = ['bg1', 'bg2', 'bg3', 'bg4', 'bg5', 'bg6', 'bg7', 'bg8', 'bg9'];
                        $color_index = 0;
                        while ($branch_row = mysqli_fetch_array($branch_income_query)) {
                            $branch_income = $branch_row['daily_branch_income'] ? $branch_row['daily_branch_income'] : 0;
                        ?>
                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 mb-2">
                        <div class="dashboard-boxes <?php echo $bg_colors[$color_index % count($bg_colors)]; ?>">
                            <i class="ti ti-wallet fs"></i>
                            <div class="text-end">
                                <label> <?php echo number_format($branch_income, 2); ?></label>
                                <h4><?php echo $branch_row['branch_name']; ?> Day Income</h4>
                            </div>
                        </div>
                        <div class="clearfix"> </div>
                    </div>
                    <?php
                            $color_index++;
                        }
                        ?>
                </div>

                <div class="row">
                    <!----Each Branch Total customers-->
                    <?php
                        $branch_customer_query = mysqli_query($con, "
                            SELECT 
                                b.branch_name, 
                                COUNT(DISTINCT sub.BillingId) as daily_customers
                            FROM 
                                tblbranch b
                            LEFT JOIN 
                                tblinvoice sub
                            ON 
                                b.branch_id = sub.branch_id
                            WHERE 
                                DATE(sub.PostingDate) = CURDATE()
                            GROUP BY 
                                b.branch_id, b.branch_name
                        ");
                        while ($branch_cust_row = mysqli_fetch_array($branch_customer_query)) {
                        ?>
                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 mb-2">
                        <div class="dashboard-boxes bg-info">
                            <i class="ti ti-users fs"></i>
                            <div class="text-end">
                                <label> <?php echo $branch_cust_row['daily_customers']; ?></label>
                                <h4><?php echo $branch_cust_row['branch_name']; ?> Day Customers</h4>
                            </div>
                        </div>
                        <div class="clearfix"> </div>
                    </div>
                    <?php
                        }
                        ?>
                </div>




            </div>

            <!--<h3>New Appointments</h3>
                <div class="table-responsive bs-example widget-shadow">
                    <table id="example" class="table table-bordered mt-3">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th> Appointment Number</th>
                                <th>Name</th>
                                <th>Mobile Number</th>
                                <th>Appointment Date</th>
                                <th>Appointment Time</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
$ret=mysqli_query($con,"select *from  tblappointment where Status='1' ");
$cnt=1;
while ($row=mysqli_fetch_array($ret)) {

?>

                            <tr>
                                <th scope="row"><?php echo $cnt;?></th>
                                <td><?php  echo $row['AptNumber'];?></td>
                                <td><?php  echo $row['Name'];?></td>
                                <td><?php  echo $row['PhoneNumber'];?></td>
                                <td><?php  echo date('d-m-Y', strtotime($row['AptDate']));?></td>
                                <td><?php  echo date('H:i', strtotime($row['AptTime']));?></td>
                                <td><a href="view-appointment.php?viewid=<?php echo $row['ID'];?>">View</a></td>
                            </tr> <?php 
$cnt=$cnt+1;
}?>
                        </tbody>
                    </table>

                </div>-->


            <?php include_once('calender.php'); ?>



        </div>
        <div class="clearfix"> </div>
    </div>
    </div>
    <!--footer-->
    <?php include_once('includes/footer.php');?>
    <!--//footer-->
    </div>
    <!-- Classie -->
    <script src="js/classie.js"></script>
    <script>
    var menuLeft = document.getElementById('cbp-spmenu-s1'),
        showLeftPush = document.getElementById('showLeftPush'),
        body = document.body;

    showLeftPush.onclick = function() {
        classie.toggle(this, 'active');
        classie.toggle(body, 'cbp-spmenu-push-toright');
        classie.toggle(menuLeft, 'cbp-spmenu-open');
        disableOther('showLeftPush');
    };


    function disableOther(button) {
        if (button !== 'showLeftPush') {
            classie.toggle(showLeftPush, 'disabled');
        }
    }
    </script>
    <!--scrolling js-->

    <script src="js/scripts.js"></script>
    <!--//scrolling js-->
    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.js"> </script>

    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/2.2.2/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.2.2/js/dataTables.bootstrap.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.2.2/js/dataTables.buttons.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.2.2/js/buttons.bootstrap.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.2.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.2.2/js/buttons.colVis.min.js"></script>

    <script>
    new DataTable('#example', {
        layout: {
            topStart: {
                buttons: ['copy', 'excel', 'pdf', 'colvis']
            }
        }
    });
    </script>


    <!--scrript for the popup image start-->
    <script>
    $(document).ready(function() {
        setTimeout(function() {
            $('#refreshModal').modal('show');
        }, 7000); // 7000 milliseconds = 7 seconds
    });
    </script>
    <!--scrript for the popup image end-->
</body>

</html>