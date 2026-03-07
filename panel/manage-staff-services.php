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
<title>Staff Service Records</title>
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
					<h3 class="title1">Staff Service Records</h3>
					
					<div class="table-responsive bs-example widget-shadow">
						<div class="form-body">
							<h4 style="padding-bottom: 20px;">Filter:</h4>
							<form method="post" name="search" action="">
								<div class="form-group row">
                                    <div class="col-md-3">
                                        <label>Staff Member</label>
                                        <select class="form-control" name="staff_id">
                                            <option value="">All Staff</option>
                                            <?php
                                            $query_staff = mysqli_query($con, "select * from tbl_staff");
                                            while ($row_staff = mysqli_fetch_array($query_staff)) {
                                                $selected = (isset($_POST['staff_id']) && $_POST['staff_id'] == $row_staff['id']) ? 'selected' : '';
                                                echo '<option value="' . $row_staff['id'] . '" '.$selected.'>' . $row_staff['name'] . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
									<div class="col-md-3">
										<label for="fromdate">From Date</label>
										<input type="date" class="form-control" name="fromdate" id="fromdate" value="<?php echo isset($_POST['fromdate']) ? $_POST['fromdate'] : ''; ?>">
									</div>
									<div class="col-md-3">
										<label for="todate">To Date</label>
										<input type="date" class="form-control" name="todate" id="todate" value="<?php echo isset($_POST['todate']) ? $_POST['todate'] : ''; ?>">
									</div>
									<div class="col-md-3" style="padding-top: 25px;">
										<button type="submit" name="submit" class="btn btn-primary">Filter</button>
									</div>
								</div>
							</form>
						</div>
					
						<table id="example" class="table table-bordered"> 
							<thead> <tr> 
								<th>#</th> 
								<th>Staff Name</th> 
								<th>Service Name</th> 
								<th>Bill Id</th> 
								<th>Invoice Date</th> 
								<th>Service Price</th>
							</tr> 
							</thead> <tbody>
<?php
$where = "WHERE tblinvoice.staff != '' AND tblinvoice.staff != '0'";

if(isset($_POST['submit']))
{
    $staff_id = $_POST['staff_id'];
    $fdate = $_POST['fromdate'];
    $tdate = $_POST['todate'];

    if(!empty($staff_id)){
        $where .= " AND tblinvoice.staff = '$staff_id'";
    }
    if(!empty($fdate) && !empty($tdate)){
        $where .= " AND date(tblinvoice.PostingDate) BETWEEN '$fdate' AND '$tdate'";
    }
}

$sql = "SELECT tbl_staff.name as StaffName, tblservices.ServiceName, tblservices.Cost, tblinvoice.BillingId, tblinvoice.PostingDate 
        FROM tblinvoice 
        JOIN tbl_staff ON tblinvoice.staff = tbl_staff.id 
        JOIN tblservices ON tblinvoice.ServiceId = tblservices.ID 
        $where 
        ORDER BY tblinvoice.PostingDate DESC";

$ret = mysqli_query($con, $sql);
$cnt=1;
$total_price = 0;
while ($row=mysqli_fetch_array($ret)) {
    $total_price += $row['Cost'];
?>

						 <tr> 
						 	<th scope="row"><?php echo $cnt;?></th> 
						 	<td><?php  echo $row['StaffName'];?></td>
						 	<td><?php  echo $row['ServiceName'];?></td>
						 	<td><?php  echo $row['BillingId'];?></td> 
						 	<td><?php  echo date('d-m-Y h:i A', strtotime($row['PostingDate']));?></td> 
						 	<td><?php  echo number_format($row['Cost'], 2);?></td>
						  </tr>   <?php 
$cnt=$cnt+1;
}?></tbody>
<tfoot>
    <tr>
        <th colspan="5" style="text-align:right">Total</th>
        <th><?php echo number_format($total_price, 2); ?></th>
    </tr>
</tfoot>
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

</body>
</html>
<?php }  ?>