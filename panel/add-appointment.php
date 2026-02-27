<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['bpmsaid']==0)) {
  header('location:logout.php');
  } else{

if(isset($_POST['submit']))
  {
      
      $AptNumber= mt_rand(100000000, 999999999);
  
    $Name=$_POST['Name'];
   $Email=$_POST['Email'];
    $PhoneNumber=$_POST['PhoneNumber'];
$AptDate=$_POST['AptDate'];
 $AptTime=$_POST['AptTime'];
    $Services=implode(",", $_POST['services']);
 
     
    $query=mysqli_query($con, "INSERT INTO `tblappointment`(`AptNumber`, `Name`, `Email`, `PhoneNumber`, `AptDate`, `AptTime`, `Services`) VALUES('$AptNumber','$Name','$Email','$PhoneNumber','$AptDate','$AptTime','$Services')");
    if ($query) {
echo '<script>alert("Appointmenr Added successfully. Appointment number is "+"'.$AptNumber.'")</script>';
echo "<script>window.location.href = 'all-appointment.php'</script>"; 
 } else {
echo "<script>alert('Something Went Wrong. Please try again.');</script>";  	
} 
      
      
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
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
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
					<h3 class="title1">Add Appointment</h3>
					<div class="form-grids row widget-shadow" data-example-id="basic-forms"> 
						<div class="form-title">
							<h4>Salon Appointment:</h4>
						</div>
						<div class="form-body">
						<form method="post" action="" class="row">
								<!--<div class="form-group col-md-6"> -->
								<!-- 	<label>Full Name</label> -->
								<!-- 	<input type="text" class="form-control" id="sername" name="Name" placeholder="Full Name" required> -->
								<!--</div>-->
								
								
								 <div class="form-group col-md-6"> 
							 	<label>Customer Name</label> 
							 
							 	<select class="form-control" id="name" name="Name" required="true">
							 	    <option value="">Select Name</option>
							 	    <?php
$ret2=mysqli_query($con,"select *from  tblcustomers");
$cnt=1;
while ($row2=mysqli_fetch_array($ret2)) {

?>
							 	    <option value="<?php  echo $row2['ID'];?>" ><?php  echo $row2['Name'];?></option>
							 	    <?php } ?>
							 	</select>
							 </div>
							 
							 <!--<input type="hidden" id="customer_name" name="Name">-->
							 
							<div class="form-group col-md-6"> 
    <label>Email</label> 
    <input type="text" id="email" name="Email" class="form-control" placeholder="Email" required> 
</div>
<div class="form-group col-md-6"> 
    <label>Phone</label> 
    <input type="text" id="phone" name="PhoneNumber" class="form-control" placeholder="Phone Number" required> 
</div>
								
									<div class="form-group col-md-6"> 
									<label>Appointment Date</label> 
									<input type="date" name="AptDate" class="form-control" placeholder="Appointment Date" required> 
								</div>
								
								<div class="form-group col-md-6"> 
									<label>Appointment Time</label> 
									<input type="time"  name="AptTime" class="form-control" placeholder="Appointment Time" required> 
								</div>
								
									<div class="form-group col-md-6"> 
									<label>Services </label> 
								<select name="services[]" class="form-control select2" multiple="">
								    <?php
$ret=mysqli_query($con,"select *from  tblservices where type = 2 ");
$cnt=1;
while ($row=mysqli_fetch_array($ret)) {

?>
<option value="<?php  echo $row['ID'];?>"><?php  echo $row['ServiceName'];?></option>
<?php } ?>
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
	
 <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
 <!--<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>-->
<script>
$(document).ready(function () {
    $('#name').on('change', function () {
        var customerId = $(this).val();
        var selectedName = $('#name option:selected').data('name'); // fetch name from data-name

        // Set hidden field to selected name
        $('#customer_name').val(selectedName);

        if (customerId != '') {
            $.ajax({
                url: 'get_customer_details.php',
                method: 'POST',
                data: { id: customerId },
                dataType: 'json',
                success: function (data) {
                    $('#email').val(data.email);
                    $('#phone').val(data.phone);
                }
            });
        } else {
            $('#email').val('');
            $('#phone').val('');
            $('#customer_name').val('');
        }
    });
});

</script>
<script>
    $(document).ready(function() {
    $('.select2').select2();
});
</script>
</body>
</html><!--  Author Name: Mayuri K. 
 for any PHP, Wordpress, Shopify or Laravel website or software development contact me at work@mayurik.com  -->
<?php } ?>




