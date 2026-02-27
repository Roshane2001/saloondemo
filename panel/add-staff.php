<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['bpmsaid']==0)) {
  header('location:logout.php');
  } else{

if(isset($_POST['submit']))
  {
    $sername=$_POST['name'];
    $contact=$_POST['contact'];
    $email=$_POST['email'];
   $address=$_POST['address'];

     
    $query=mysqli_query($con, "insert into  tbl_staff(name,contact,address,email) value('$sername','$contact','$address','$email')");
    if ($query) {
    	echo "<script>alert('Staff has been added.');</script>"; 
    		echo "<script>window.location.href = 'manage-staff.php'</script>";   
    
  }
  else
    {
    echo "<script>alert('Something Went Wrong. Please try again.');</script>";  	
    }

  
}
$branding_query = mysqli_query($con, "select * from branding where id=1");
$branding_row = mysqli_fetch_array($branding_query);
  ?>
<!DOCTYPE HTML>
<html>
<head>
<title>Add Staff</title>
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
<script src="http://js.nicedit.com/nicEdit-latest.js" type="text/javascript"></script>
<script type="text/javascript">bkLib.onDomLoaded(nicEditors.allTextAreas);</script>
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
					<h3 class="title1">Add Staff</h3>
					<div class="form-grids row widget-shadow" data-example-id="basic-forms"> 
						<div class="form-title">
							<h4>Salon Staff:</h4>
						</div>
						<div class="form-body">
							<form method="post" class="row">

							 <div class="form-group col-md-6"> 
							 	<label> Name</label> 
							 	<input type="text" class="form-control" id="name" name="name" placeholder="Staff Name" value="" required="true"> 
							 </div>
							 <div class="form-group col-md-6"> <label>Email</label> <input type="email" class="form-control" name="email" id="email" placeholder="Email" rows="5" required="true"> </div>

							  <div class="form-group col-md-6"> <label>Contact</label> <input type="number" id="contact" name="contact" class="form-control" placeholder="Contact" value="" required="true"> </div>
							   <div class="form-group col-md-6"> <label>Address</label> <input type="text" id="address" name="address" class="form-control" placeholder="Address" value="" required="true"> </div>

							<div class="col-md-12">
							  <button type="submit" name="submit" class="btn btn-default">Add</button> </form> 
							</div>
						</div>
						
					</div>
				
				
			</div>
		</div>
		 <?php include_once('includes/footer.php');?>
	</div>
	
</body>
</html>
<?php } ?>