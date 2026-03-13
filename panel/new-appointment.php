<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['bpmsaid']==0)) {
  header('location:logout.php');
  } else{

  if(isset($_GET['action']) && $_GET['action'] == 'update_status') {
    $id = intval($_GET['id']);
    $status = intval($_GET['status']); // 1 for select, 2 for reject
    
    if ($status == 1 || $status == 2) {
        $query = mysqli_query($con, "UPDATE tblappointment SET Status='$status' WHERE ID='$id'");
        if($query) {
            $msg = ($status == 1) ? "Appointment has been Selected." : "Appointment has been Rejected.";
            echo "<script>alert('$msg');</script>";
            echo "<script>window.location.href='new-appointment.php'</script>";
        } else {
            echo "<script>alert('Something went wrong. Please try again.');</script>";
            echo "<script>window.location.href='new-appointment.php'</script>";
        }
    }
}

$branding_query = mysqli_query($con, "select * from branding where id=1");
$branding_row = mysqli_fetch_array($branding_query);

  ?>
<!DOCTYPE HTML>
<html>

<head>
    <title>New Appointment</title>
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
                    <h3 class="title1">New Appointment</h3>

                    <?php include_once('appointment-search-filter.php'); ?>



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
                                    <th>Branch Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
$where_conditions = ["(ta.Status = '' OR ta.Status IS NULL)"];
$sql = "SELECT ta.*, tc.Name as CustomerName, tb.branch_name
        FROM tblappointment as ta 
        LEFT JOIN tblcustomers as tc ON ta.Name = tc.ID 
        LEFT JOIN tblbranch as tb ON ta.branch_id = tb.branch_id";

if(isset($_POST['filter'])) {
    if(!empty($_POST['searchdata'])) {
        $sdata = mysqli_real_escape_string($con, $_POST['searchdata']);
        $where_conditions[] = "(ta.AptNumber LIKE '%$sdata%' OR tc.Name LIKE '%$sdata%' OR ta.PhoneNumber LIKE '%$sdata%')";
    }

    if(!empty($_POST['branch_id'])) {
        $branch_id = intval($_POST['branch_id']);
        $where_conditions[] = "ta.branch_id = $branch_id";
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

$sql .= " WHERE " . implode(' AND ', $where_conditions) . " ORDER BY ta.ID DESC";

$ret = mysqli_query($con, $sql);
$cnt=1;
while ($row=mysqli_fetch_array($ret)) {

?>

                                <tr>
                                    <th scope="row"><?php echo $cnt;?></th>
                                    <td><?php  echo $row['AptNumber'];?></td>
                                    <td><?php  echo $row['CustomerName'] ? $row['CustomerName'] : $row['Name'];?></td>
                                    <td><?php  echo $row['PhoneNumber'];?></td>
                                    <td><?php  echo $row['AptDate'];?></td>
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
                                    <td>
                                        <a href="new-appointment.php?action=update_status&id=<?php echo $row['ID'];?>&status=1"
                                            class="btn btn-success btn-sm"
                                            onclick="return confirm('Are you sure you want to select this appointment?')">Select</a> |
                                        <a href="new-appointment.php?action=update_status&id=<?php echo $row['ID'];?>&status=2" 
                                            class="btn btn-danger btn-sm"
                                            onclick="return confirm('Are you sure you want to reject this appointment?')">Reject</a>
                                    </td>
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