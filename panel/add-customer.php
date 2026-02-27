<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['bpmsaid']==0)) {
  header('location:logout.php');
  } else{

if(isset($_POST['submit']))
  {
      
    
    $name=$_POST['name'];
    $email=$_POST['email'];
   $mobilenum=$_POST['mobilenum'];
    $gender=$_POST['gender'];
$details=$_POST['details'];
$dob=$_POST['dob'];
 $marriage_date=$_POST['marriage_date'];
    
    $query=mysqli_query($con, "insert into  tblcustomers(Name,Email,MobileNumber,Gender, Details, dob, marriage_date) value('$name','$email','$mobilenum','$gender','$details','$dob','$marriage_date')");
   
    //  print_r($_POST); 
    if ($query) {
echo "<script>alert('Customer has been added.');</script>"; 
echo "<script>window.location.href = 'customer-list.php'</script>"; 
 } else {
echo "<script>alert('Something Went Wrong. Please try again.');</script>";  	
} }

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
					<h3 class="title1">Add Customer</h3>
					<div class="form-grids row widget-shadow" data-example-id="basic-forms"> 
						<div class="form-title">
							<h4>Salon Customers:</h4>
						</div>
						<div class="form-body">
							<form method="post" class="row">
								
							 <div class="form-group col-md-6"> <label for="exampleInputEmail1">Name</label> <input type="text" class="form-control" id="name" name="name" placeholder="Full Name" value="" required="true"> </div>
							  <div class="form-group col-md-6"> <label for="exampleInputPassword1">Email</label> <input type="email" id="email" name="email" class="form-control" placeholder="Email" value="" required="true"> </div>

							 <div class="form-group col-md-6"> <label for="exampleInputEmail1">Mobile Number</label> <input type="text" class="form-control" id="mobilenum" name="mobilenum" placeholder="Mobile Number" value="" required="true" maxlength="10" pattern="[0-9]+"> </div>
							 
							 
							  <div class="form-group col-md-6"> <label for="exampleInputEmail1">DOB</label> <input type="date" class="form-control" id="dob" name="dob" placeholder="Mobile Number" value="" required="true" > </div>
							  
							  
							  
							  <div class="form-group col-md-6"> <label for="exampleInputEmail1">Anniversary Date</label> <input type="date" class="form-control" id="marriage_date" name="marriage_date" > </div>
							 
							 
							 <div class="radio col-md-6">

                               <p style="padding-top: 20px; font-size: 15px"> <strong>Gender:</strong> 
                                <label>
                                    <input type="radio" name="gender" id="gender" value="Male">
                                    Male
                                </label>
                                 <label>
                                    <input type="radio" name="gender" id="gender" value="Female">
                                    Female
                                </label>
                                <label>
                                    <input type="radio" name="gender" id="gender" value="Transgender">
                                   Transgender
                                </label></p>
                            </div>
							 	<div class="form-group col-md-6"> <label for="exampleInputEmail1">Note</label> <textarea type="text" class="form-control" id="details" name="details" placeholder="Details" required="true" rows="3" cols="4"></textarea> </div>
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
	
</body>
</html><!--  Author Name: Mayuri K. 
 for any PHP, Wordpress, Shopify or Laravel website or software development contact me at work@mayurik.com  -->
<?php } ?>