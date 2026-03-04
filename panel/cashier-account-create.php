<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['bpmsaid']==0)) {
  header('location:logout.php');
  } else{

if(isset($_POST['submit']))
  {
      
    
    $branch_id=$_POST['branch_id'];
    $cashiername=$_POST['cashiername'];
    $username=$_POST['username'];
    $mobilenum=$_POST['mobilenum'];
    $password=md5($_POST['password']);
    
    
    $query=mysqli_query($con, "insert into  tblcashier(branch_id,CashierName,UserName,MobileNumber,Password) value('$branch_id','$cashiername','$username','$mobilenum','$password')");
   
    //  print_r($_POST); 
    if ($query) {
echo "<script>alert('Cashier account has been created.');</script>"; 
echo "<script>window.location.href = 'cashier-account-create.php'</script>"; 
 } else {
echo "<script>alert('Something Went Wrong. Please try again.');</script>";  	
} }

$branding_query = mysqli_query($con, "select * from branding where id=1");
$branding_row = mysqli_fetch_array($branding_query);

  ?>
<!DOCTYPE HTML>
<html>
<head>
<title>Create Cashier Account</title>

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
					<h3 class="title1">Create Cashier Account</h3>
					<div class="form-grids row widget-shadow" data-example-id="basic-forms"> 
						<div class="form-title">
							<h4>Cashier Details:</h4>
						</div>
						<div class="form-body">
							<form method="post" class="row">
								
							 <div class="form-group col-md-6"> 
							     <label>Branch</label> 
							     <select class="form-control" name="branch_id" required="true">
							         <option value="">Select Branch</option>
							         <?php
							         $query_branch=mysqli_query($con,"select * from tblbranch");
							         while($row_branch=mysqli_fetch_array($query_branch))
							         {
							         ?>
							         <option value="<?php echo $row_branch['branch_id'];?>"><?php echo $row_branch['branch_name'];?></option>
							         <?php } ?>
							     </select>
							 </div>
							 <div class="form-group col-md-6"> <label>Cashier Name</label> <input type="text" class="form-control" name="cashiername" placeholder="Cashier Name" required="true"> </div>
							 <div class="form-group col-md-6"> <label>User Name</label> <input type="text" class="form-control" name="username" placeholder="User Name" required="true"> </div>
							 <div class="form-group col-md-6"> <label>Mobile Number</label> <input type="text" class="form-control" name="mobilenum" placeholder="Mobile Number" required="true" maxlength="10" pattern="[0-9]+"> </div>
							 <div class="form-group col-md-6"> <label>Password</label> <input type="text" class="form-control" name="password" placeholder="Password" required="true"> </div>

							<div class="col-md-12">
							  <button type="submit" name="submit" class="btn btn-default">Create</button>
							  </div> 
							</form> 
						</div>
						
					</div>
				
				
			</div>
		</div>
		 <?php include_once('includes/footer.php');?>
	</div>
	
</body>
</html><!--  Author Name: Mayuri K. 
 for any PHP, Wordpress, Shopify or Laravel website or software development contact me at work@mayurik.com  -->
<?php } ?>