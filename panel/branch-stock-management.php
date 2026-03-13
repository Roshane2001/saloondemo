<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['bpmsaid']) == 0) {
  header('location:logout.php');
} else {

    // Fetch branding info
    $branding_query = mysqli_query($con, "select * from branding where id=1");
    $branding_row = mysqli_fetch_array($branding_query);

    // Fetch branches based on user role
    $branches = [];
    if ($_SESSION['bpmsut'] == 'admin') {
        $branches_query = mysqli_query($con, "SELECT * FROM tblbranch ORDER BY branch_id");
        while($branch = mysqli_fetch_assoc($branches_query)) {
            $branches[] = $branch;
        }
    } elseif ($_SESSION['bpmsut'] == 'cashier') {
        $cashier_id = intval($_SESSION['bpmsaid']);
        $stmt = $con->prepare("SELECT b.* FROM tblbranch b JOIN tblcashier c ON b.branch_id = c.branch_id WHERE c.ID = ?");
        $stmt->bind_param('i', $cashier_id);
        if ($stmt->execute()) {
            $result = $stmt->get_result();
            if ($branch = $result->fetch_assoc()) {
                $branches[] = $branch;
            }
            $stmt->close();
        } else {
            // Handle potential query error
        }
    }

    // Fetch all products (type=1)
    $products_query = mysqli_query($con, "SELECT ID, ServiceName FROM tblservices WHERE type=1 ORDER BY ServiceName");
    $products = [];
    while($product = mysqli_fetch_assoc($products_query)) {
        $products[] = $product;
    }

    // Fetch all current stock levels and store in an associative array for easy lookup
    $stock_levels_query = mysqli_query($con, "SELECT * FROM tbl_branch_stock");
    $stock_levels = [];
    while($stock = mysqli_fetch_assoc($stock_levels_query)) {
        $stock_levels[$stock['service_id']][$stock['branch_id']] = $stock['quantity'];
    }
?>
<!DOCTYPE HTML>
<html>
<head>
<title>Branch Stock Management</title>
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
				<div class="tables">
					<h3 class="title1">Branch Stock Management</h3>
					
					<div class="table-responsive bs-example widget-shadow">
						<h4>Manage Product Stock Across Branches:</h4>
                    
                        <form method="post" action="branch-stock-management-update.php">
                            <table class="table table-bordered table-striped"> 
                                <thead> 
                                    <tr> 
                                        <th>Product Name</th>
                                        <?php foreach($branches as $branch): ?>
                                            <th class="text-center"><?php echo htmlspecialchars($branch['branch_name']); ?></th>
                                        <?php endforeach; ?>
                                    </tr> 
                                </thead> 
                                <tbody>
                                    <?php if(empty($products)): ?>
                                        <tr>
                                            <td colspan="<?php echo count($branches) + 1; ?>" class="text-center">No products found. Please add products (type=1) from the 'Services/Product' menu.</td>
                                        </tr>
                                    <?php else: ?>
                                        <?php foreach($products as $product): ?>
                                            <tr>
                                                <td><?php echo htmlspecialchars($product['ServiceName']); ?></td>
                                                <?php foreach($branches as $branch): ?>
                                                    <td>
                                                        <input type="number" name="stock[<?php echo $product['ID']; ?>][<?php echo $branch['branch_id']; ?>]" class="form-control" value="<?php echo isset($stock_levels[$product['ID']][$branch['branch_id']]) ? $stock_levels[$product['ID']][$branch['branch_id']] : 0; ?>" min="0" <?php if ($_SESSION['bpmsut'] !== 'admin') echo 'readonly'; ?>>
                                                    </td>
                                                <?php endforeach; ?>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </tbody> 
                            </table>
                            <?php if(!empty($products) && $_SESSION['bpmsut'] === 'admin'): ?>
                                <div class="text-right">
                                    <button type="submit" name="submit" class="btn btn-primary">Update All Stock</button>
                                </div>
                            <?php endif; ?>
                        </form>
					</div>
				</div>
			</div>
		</div>
		<!--footer-->
		 <?php include_once('includes/footer.php');?>
        <!--//footer-->
	</div>
</body>
</html>
<?php } ?>