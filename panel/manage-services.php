<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['bpmsaid']==0)) {
  header('location:logout.php');
  } else{
// Code for deletion
if($_GET['action']=='delete')
{
$id=intval($_GET['id']);
$query=mysqli_query($con,"delete from tblservices where ID='$id'");
    if ($query) {
     echo "<script>alert('Service deleted.');</script>";
     echo "<script>window.location.href='manage-services.php'</script>";
  } else {
    echo "<script>alert('Something Went Wrong. Please try again.');</script>";
    echo "<script>window.location.href='manage-services.php'</script>";
    }
}

$branding_query = mysqli_query($con, "select * from branding where id=1");
$branding_row = mysqli_fetch_array($branding_query);


  ?>
<!DOCTYPE HTML>
<html>
<head>
<title>Manage Services/Product</title>
<link rel="icon" type="image/x-icon" href="images/<?php echo $branding_row['favicon'];?>">
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- Bootstrap Core CSS -->
<link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
<!-- Custom CSS -->
<link href="css/style.css" rel='stylesheet' type='text/css' />
<!-- font CSS -->
<!-- font-awesome icons -->
<link href="css/font-awesome.css" rel="stylesheet"> 

<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link href="https://cdn.datatables.net/2.2.2/css/dataTables.bootstrap.css">
<link href="https://cdn.datatables.net/buttons/3.2.2/css/buttons.bootstrap.css">

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
				<div class="tables">
					<h3 class="title1">Manage Services/Product</h3>
					
					
				
					<div class="table-responsive bs-example widget-shadow">
						
						<table id="example" class="table table-bordered" > <thead> <tr> <th>#</th> <th>Image</th> <th>Service/Product Name</th> <th>Price</th><th>Category</th> <th>Creation Date</th><th>Action</th> </tr> </thead> <tbody>
<?php
$ret=mysqli_query($con,"select *from  tblservices");
$cnt=1;
while ($row=mysqli_fetch_array($ret)) {

?>

						 <tr> <th scope="row"><?php echo $cnt;?></th>
						 <td><img src="images/<?php echo $row['Image'];?>" width="50" height="50"></td>
						 <td><?php  echo $row['ServiceName'];?></td>
						 <td><?php  echo number_format($row['Cost'],2);?></td>
						 <td><?php
						    $cid=$row['cate_id'];
						    $ret1=mysqli_query($con,"select * from  tbl_category where id='$cid'");
						    $row1=mysqli_fetch_array($ret1);
						    echo $row1['name'];
						 ?></td>
						 <td><?php  echo 
						 date('d-m-Y', strtotime($row['CreationDate']));?></td> <td><a href="edit-services.php?editid=<?php echo $row['ID'];?>" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a> | 
<a href="manage-services.php?action=delete&&id=<?php echo $row['ID'];?>" class="btn btn-danger btn-sm"><i class="fa fa-trash-o" aria-hidden="true"></i></a> | 

<?php if($row['type']==1){?>
<a href="#" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#flipFlop<?php echo $row['ID'];?>"><i class="fa fa-plus" aria-hidden="true"></i></a><?php } ?>

						 	</td> </tr>   <?php 
$cnt=$cnt+1;
} ?></tbody> </table> 
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

<?php
$ret5=mysqli_query($con,"select *from  tblservices  ");
$cnt5=1;
while ($row5=mysqli_fetch_array($ret5)) {

?>

<!-- The modal -->
<div class="modal fade" id="flipFlop<?php echo $row5['ID'];?>" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
<h4 class="modal-title" id="modalLabel">Add STock</h4>
</div>
<div class="modal-body">
<form action="stock.php" method="POST">
    <input type="hidden" class="form-control" id="ID" name="ID" value="<?php echo $row5['ID'];?>">
<div class="form-group">
<label for="first_name">Previouse Stock</label>
<input type="text" class="form-control" id="opening_stock1" name="opening_stock1" value="<?php echo $row5['opening_stock'];?>" readonly="">
</div>
<div class="form-group">
<label for="last_name">Add Stock</label>
<input type="text" class="form-control" id="opening_stock" name="opening_stock">
</div>
<button type="submit"  name="submit" class="btn btn-primary">Submit</button>
</form>

</div>
<div class="modal-footer">
<button type="submit" class="btn btn-secondary" data-dismiss="modal">Close</button>
</div>

</div>
</div>
</div>

<?php } ?>



</body>
</html><!--  Author Name: Mayuri K. 
 for any PHP, Wordpress, Shopify or Laravel website or software development contact me at work@mayurik.com  -->
<?php }  ?>