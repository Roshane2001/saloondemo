<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['bpmsaid']==0)) {
  header('location:logout.php');
  } else{

if(isset($_POST['submit']))
  {
    $brand_name=$_POST['brand_name'];
    $phone_no=$_POST['phone_no'];
    $company_email=$_POST['company_email'];
    $website_name=$_POST['website_name'];
    $address=$_POST['address'];
    
    // Handle Logo
    $logo=$_FILES["logo"]["name"];
    $old_logo=$_POST['old_logo'];
    if($logo!="") {
        $extension = strtolower(pathinfo($logo, PATHINFO_EXTENSION));
        $allowed_extensions = array("jpg", "jpeg", "png", "gif");
        if(!in_array($extension,$allowed_extensions)) {
            echo "<script>alert('Invalid logo format. Only jpg / jpeg/ png /gif format allowed');</script>";
        } else {
            $newlogo=md5($logo).time().".".$extension;
            move_uploaded_file($_FILES["logo"]["tmp_name"],"images/".$newlogo);
        }
    } else {
        $newlogo = $old_logo;
    }

    // Handle Favicon
    $favicon=$_FILES["favicon"]["name"];
    $old_favicon=$_POST['old_favicon'];
    if($favicon!="") {
        $extension = strtolower(pathinfo($favicon, PATHINFO_EXTENSION));
        $allowed_extensions = array("jpg", "jpeg", "png", "gif", "ico");
        if(!in_array($extension,$allowed_extensions)) {
             echo "<script>alert('Invalid favicon format. Only jpg / jpeg/ png /gif /ico format allowed');</script>";
        } else {
            $newfavicon=md5($favicon).time().".".$extension;
            move_uploaded_file($_FILES["favicon"]["tmp_name"],"images/".$newfavicon);
        }
    } else {
        $newfavicon = $old_favicon;
    }

    $ret=mysqli_query($con,"select * from branding");
    $count=mysqli_num_rows($ret);
    
    if($count > 0) {
        $query=mysqli_query($con, "update branding set brand_name='$brand_name', phone_no='$phone_no', company_email='$company_email', website_name='$website_name', address='$address', logo='$newlogo', favicon='$newfavicon' where id=1");
    } else {
        $query=mysqli_query($con, "insert into branding(id, brand_name, phone_no, company_email, website_name, address, logo, favicon) value(1, '$brand_name','$phone_no','$company_email','$website_name','$address','$newlogo','$newfavicon')");
    }

    if ($query) {
        echo "<script>alert('Branding settings updated successfully.');</script>"; 
        echo "<script>window.location.href = 'branding.php'</script>"; 
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
<title>Branding</title>
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
					<h3 class="title1">Branding Settings</h3>
					<div class="form-grids row widget-shadow" data-example-id="basic-forms"> 
						<div class="form-title">
							<h4>Update Branding:</h4>
						</div>
						<div class="form-body">
                            <?php
                            $ret=mysqli_query($con,"select * from branding where id=1");
                            $row=mysqli_fetch_array($ret);
                            ?>
							<form method="post" class="row" enctype="multipart/form-data">
								
							 <div class="form-group col-md-6"> <label>Brand Name</label> <input type="text" class="form-control" name="brand_name" value="<?php echo $row['brand_name'];?>" required="true"> </div>
							 <div class="form-group col-md-6"> <label>Website Name</label> <input type="text" class="form-control" name="website_name" value="<?php echo $row['website_name'];?>" required="true"> </div>
                             
                             <div class="form-group col-md-6"> <label>Company Email</label> <input type="email" class="form-control" name="company_email" value="<?php echo $row['company_email'];?>" required="true"> </div>
                             <div class="form-group col-md-6"> <label>Phone Number</label> <input type="text" class="form-control" name="phone_no" value="<?php echo $row['phone_no'];?>" required="true"> </div>

                             <div class="form-group col-md-12"> <label>Address</label> <textarea class="form-control" name="address" required="true"><?php echo $row['address'];?></textarea> </div>

                             <div class="form-group col-md-6"> 
                                 <label>Logo</label> 
                                 <input type="file" class="form-control" name="logo">
                                 <input type="hidden" name="old_logo" value="<?php echo $row['logo'];?>">
                                 <?php if($row['logo']!=""){ ?>
                                 <img src="images/<?php echo $row['logo'];?>" width="100" height="100">
                                 <?php } ?>
                             </div>

                             <div class="form-group col-md-6"> 
                                 <label>Favicon</label> 
                                 <input type="file" class="form-control" name="favicon">
                                 <input type="hidden" name="old_favicon" value="<?php echo $row['favicon'];?>">
                                 <?php if($row['favicon']!=""){ ?>
                                 <img src="images/<?php echo $row['favicon'];?>" width="50" height="50">
                                 <?php } ?>
                             </div>

							<div class="col-md-12">
							  <button type="submit" name="submit" class="btn btn-default">Update</button>
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