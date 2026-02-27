<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['bpmsaid']==0)) {
  header('location:logout.php');
  } else{

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $customer_name = $_POST['user_id'];
//   print_r($customer_name);exit;
    $plan_id = intval($_POST['plan_id']);

    // Fetch plan duration
    $res = mysqli_query($con, "SELECT duration_days FROM membership_plans WHERE id = $plan_id");
    $plan = mysqli_fetch_assoc($res);

    $start = date('Y-m-d');
    $end = date('Y-m-d', strtotime("+{$plan['duration_days']} days"));

    // Insert subscription
    mysqli_query($con, "INSERT INTO user_memberships (user_id, plan_id, start_date, end_date)
        VALUES ('$customer_name',  '$plan_id', '$start', '$end')");

    echo "<script>alert('Subscription Added successful!');</script>";
    echo "<script>window.location.href = 'manage_subscribe.php'</script>";
}

$branding_query = mysqli_query($con, "select * from branding where id=1");
$branding_row = mysqli_fetch_array($branding_query);

  ?>
<!DOCTYPE HTML>
<html>
<head>
<title>Add Customers</title>
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
					<h3 class="title1">Add Plan</h3>
					<div class="form-grids row widget-shadow" data-example-id="basic-forms"> 
						<div class="form-title">
							<h4>Add Plan:</h4>
						</div>
						<div class="form-body">
							<form method="post" class="row">
								
						 <div class="form-group col-md-6"> 
							 	<label>Customer</label> 
							 
							 	<select class="form-control" id="user_id" name="user_id" required="true">
							 	    <option value="">Select</option>
							 	    <?php
$ret2=mysqli_query($con,"select *from  tblcustomers");
$cnt=1;
while ($row2=mysqli_fetch_array($ret2)) {

?>
							 	    <option value="<?php  echo $row2['ID'];?>"><?php  echo $row2['Name'];?></option>
							 	    <?php } ?>
							 	</select >
							 </div>
							 
							  <div class="form-group col-md-6"> <label for="exampleInputPassword1">Plan</label> 
							<select name="plan_id" class="form-control"  required>
        <option value="">Choose a Plan</option>
        <?php
        $plans = mysqli_query($con, "SELECT * FROM membership_plans");
        while($plan = mysqli_fetch_assoc($plans)) {
            echo "<option value='{$plan['id']}'>{$plan['plan_name']} - ₹{$plan['price']}</option>";
        }
        ?>
    </select>
							       </div>

						
				
						       	<div class="col-md-12">
							  <button type="submit" name="submit" class="btn btn-default">Add</button>
							  </div> 
							</form> 
						</div>
						
					</div>
				
				
			</div>
		</div>
		 <?php include_once('includes/footer.php');?>
	</div>
	<!-- Classie -->
		<script src="js/classie.js"></script>
		<script>
			var menuLeft = document.getElementById( 'cbp-spmenu-s1' ),
				showLeftPush = document.getElementById( 'showLeftPush' ),
				body = document.body;
				
			showLeftPush.onclick = function() {
				classie.toggle( this, 'active' );
				classie.toggle( body, 'cbp-spmenu-push-toright' );
				classie.toggle( menuLeft, 'cbp-spmenu-open' );
				disableOther( 'showLeftPush' );
			};
			
			function disableOther( button ) {
				if( button !== 'showLeftPush' ) {
					classie.toggle( showLeftPush, 'disabled' );
				}
			}
		</script>
	<!--scrolling js-->
	
	<script src="js/scripts.js"></script>
	<!--//scrolling js-->
	<!-- Bootstrap Core JavaScript -->
   <script src="js/bootstrap.js"> </script>
</body>
</html><!--  Author Name: Mayuri K. 
 for any PHP, Wordpress, Shopify or Laravel website or software development contact me at work@mayurik.com  -->
<?php } ?>