<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['bpmsaid']==0)) {
  header('location:logout.php');
  } else{

if(isset($_POST['submit']))
  {
    $sername=$_POST['sername'];
    $des=$_POST['des'];
   $cost=$_POST['cost'];
    $cate_id=$_POST['cate_id'];
     $type=$_POST['type'];
     
    $image=$_FILES["image"]["name"];
    if($image!="") {
        $extension = strtolower(pathinfo($image, PATHINFO_EXTENSION));
        $allowed_extensions = array("jpg", "jpeg", "png", "gif");
        if(!in_array($extension,$allowed_extensions)) {
            echo "<script>alert('Invalid format. Only jpg / jpeg/ png /gif format allowed');</script>";
        } else {
            $newimage=md5($image).time().".".$extension;
            move_uploaded_file($_FILES["image"]["tmp_name"],"images/".$newimage);
            $query=mysqli_query($con, "insert into  tblservices(ServiceName,Description,Cost,type,cate_id,Image) value('$sername','$des','$cost','$type','$cate_id','$newimage')");
        }
    } else {
        $query=mysqli_query($con, "insert into  tblservices(ServiceName,Description,Cost,type,cate_id) value('$sername','$des','$cost','$type','$cate_id')");
    }

    if ($query) {
    	echo "<script>alert('Service/Product has been added.');</script>"; 
    		echo "<script>window.location.href = 'add-services.php'</script>";   
    
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
<title>Add Services</title>
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
					<h3 class="title1">Add Services/Products</h3>
					<div class="form-grids row widget-shadow" data-example-id="basic-forms"> 
						<div class="form-title">
							<h4>Salon Services/Products:</h4>
						</div>
						<div class="form-body">
							<form method="post" class="row" enctype="multipart/form-data">
							    
							    <div class="form-group col-md-6"> 
							 	<label> Type</label> 
							
							 	<select class="form-control" id="type" name="type" required>
							 	    	<option value="">Select</option>
							 	<option value="1">Product</option>
							 	<option value="2">Service</option>
							 	</select>
							 	
							 </div>
                                 <div class="form-group col-md-6"> 
							 	<label>Category</label> 
							 
							 	<select class="form-control" id="cate_id" name="cate_id" required="true">
							 	    <option value="">Select Category</option>
							 	    <?php
$ret2=mysqli_query($con,"select *from  tbl_category");
$cnt=1;
while ($row2=mysqli_fetch_array($ret2)) {

?>
							 	    <option value="<?php  echo $row2['id'];?>"><?php  echo $row2['name'];?></option>
							 	    <?php } ?>
							 	</select>
							 </div>
							 <div class="form-group col-md-6"> 
							 	<label> Name</label> 
							 	<input type="text" class="form-control" id="sername" name="sername" placeholder="Name" value="" required="true"> 
							 </div>
							 <div class="form-group col-md-6"> <label>Description</label> <input class="form-control" name="des" id="des" rows="5" required="true"> </div>

							  <div class="form-group col-md-6"> <label>Cost</label> <input type="text" id="cost" name="cost" class="form-control" placeholder="Cost" value="" required="true"> </div>
							  <div class="form-group col-md-6"> <label>Image</label> <input type="file" id="image" name="image" class="form-control"> </div>

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
</html><!--  Author Name: Mayuri K. 
 for any PHP, Wordpress, Shopify or Laravel website or software development contact me at work@mayurik.com  -->
<?php } ?>