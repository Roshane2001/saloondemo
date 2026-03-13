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
    <title>Rejected Appointment</title>
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


    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link href="https://cdn.datatables.net/2.2.2/css/dataTables.bootstrap.css">
    <link href="https://cdn.datatables.net/buttons/3.2.2/css/buttons.bootstrap.css">
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
                    <h3 class="title1">Rejected Appointment</h3>



                    <div class="table-responsive bs-example widget-shadow">
                        <table id="example" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th> Appointment Number</th>
                                    <th>Name</th>
                                    <th>Mobile Number</th>
                                    <th>Appointment Date</th>
                                    <th>Appointment Time</th>
                                    <th>Services</th>
                                    <th>Branch</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php
$ret=mysqli_query($con,"SELECT ta.*, tc.Name as CustomerName, tb.branch_name FROM tblappointment as ta LEFT JOIN tblcustomers as tc ON ta.Name = tc.ID LEFT JOIN tblbranch as tb ON ta.branch_id = tb.branch_id WHERE ta.Status='2'");
$cnt=1;
while ($row=mysqli_fetch_array($ret)) {

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
                                    <td><?php  echo $row['branch_name'];?></td>

                                </tr> <?php 
$cnt=$cnt+1;
}?>
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

</body>

</html>
<?php }  ?>