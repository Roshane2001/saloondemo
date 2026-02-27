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
<title>Sales Reports</title>
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
				<div class="forms">
					<h3 class="title1">Staff Commission Report</h3>
					<div class="form-grids row widget-shadow" data-example-id="basic-forms"> 
						<div class="form-title">
							<h4>Staff Commission Report</h4>
						</div>
						<div class="form-body">
							<form method="post" class="row" name="bwdatesreport"  action="" enctype="multipart/form-data">
								

  
							 <div class="form-group col-md-6"> <label for="exampleInputEmail1">From Date</label> <input type="date" class="form-control1" name="fromdate" id="fromdate" value="" required='true'> </div> 
							 <div class="form-group col-md-6"> <label for="exampleInputPassword1">To Date</label><input type="date" class="form-control1" name="todate" id="todate" value="" required='true'> </div>
						
							
							<div class="col-md-12">
							  <button type="submit" name="submit" class="btn btn-default">Submit</button> 
							  </div>
							</form> 
						</div>
						
						
						
							<div class="tables">
				
					
				
		<?php
if (isset($_POST['submit'])) {
    $fdate = $_POST['fromdate'];
    $tdate = $_POST['todate'];

    $total = 0;
    $cnt = 1;

    $ret = mysqli_query($con, "SELECT * FROM tblinvoice WHERE type =0 AND PostingDate BETWEEN '$fdate' AND '$tdate'  group by staff ");
    ?>
    <div class="table-responsive bs-example widget-shadow">
        <table id="example" class="table table-bordered">
            <thead>
                <tr> 
                    <th>#</th>
                    <th>Name</th>
                    <th>Cost</th>
                  
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = mysqli_fetch_array($ret)) {
                    $serviceId = $row['staff'];
                    $qty = $row['commision'];

                    // Fetch service details
                    $rett = mysqli_query($con, "SELECT * FROM tbl_staff WHERE ID = '$serviceId' ");
                    $rowt = mysqli_fetch_array($rett);
                    $prod = $rowt['name'];
                    // $cost = $rowt['commision'];

                    $total += $qty;

                    echo "<tr>
                            <th scope='row'>{$cnt}</th>
                            <td>{$prod}</td>
                            <td>{$qty}</td>
                           
                          </tr>";
                    $cnt++;
                }
                ?>
                <tr>
                    <th colspan="2" class="text-right">Total</th>
                    <td><?php echo number_format($total, 2); ?></td>
                </tr>
            </tbody>
        </table>
    </div>
<?php
}
?>

				</div>
					</div>
				
				
			</div>
		</div>
		 <?php include_once('includes/footer.php');?>
	</div>
	
</body>
</html>
<?php } ?>