<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
?>

<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
    if (strlen($_SESSION['bpmsaid']==0)) {
  header('location:logout.php');
  } else{


if (isset($_POST['submit'])) {
    
//   print_r($_POST);exit;
    $cid = $_GET['viewid'];
      $name = $_POST['Userid'];
    $remark = $_POST['remark'];
    $status = $_POST['status'];
    $tax = $_POST['tax'];
    $grand_total = $_POST['total'];
    $total = $_POST['service_total'];
    $staffId = $_POST['staff'];
      $posting_date = date('Y-m-d H:i:s');
      
      
    if($status==1){
        
        
          // First update the appointment
    $update = mysqli_query($con, "UPDATE tblappointment 
        SET Remark='$remark', Status='$status',total ='$total',  grand_total='$grand_total' 
        WHERE ID='$cid'");
//  print_r($_POST); exit;
    if ($update) {
        $invoiceid = mt_rand(100000000, 999999999);

        // Get the list of service IDs from the appointment
        $res = mysqli_query($con, "SELECT * FROM tblappointment WHERE ID='$cid'");
        $row = mysqli_fetch_assoc($res);
        $service_ids = explode(",", $row['Services']);
        
        $book_date = date('d-M-Y', strtotime($row['AptDate']));
        $book_time = date('g:i A', strtotime($row['AptTime']));
         $book_id =  $row['AptNumber'];

        foreach ($service_ids as $svid) {
            $svid = intval($svid); // sanitize
            
              // OPTIONAL: if you want to split $grand_total by number of services
    $service_count = count($service_ids);
    $service_total = $grand_total / $service_count;

    // 10% commission
    $commission = round(($service_total * 10) / 100, 2);
            
            $insert = mysqli_query($con, "INSERT INTO tblinvoice (
                Userid, ServiceId, BillingId, staff, tax, total, PostingDate,commision, qty
            ) VALUES (
                '$name', '$svid', '$invoiceid', '$staffId', '$tax', '$grand_total',  '$posting_date', '$commission', 1
            )");
            
            
        }

       
        
        
    //          $res_email = mysqli_query($con, "SELECT * FROM emailsetting ");
    //     // $row_email = mysqli_fetch_assoc($res);
    // while ($row=mysqli_fetch_array($res_email)) {
    //     $smtp_server = $row['smtp_server'];
    //             $smtp_password = $row['smtp_password'];
    //             $smtp_enc = $row['smtp_type'];
    //             $smtp_username = $row['smtp_username'];
    //             $smtp_port = $row['stmp_port'];
    //             $email = $row['email'];
    
        
    // }
    
    
    //  $dt = date('Y-m-d H:i:s');

    //         $msg1 = "Dear Customer, <br>
    // Your Appointment Booked, Your Booking Id is  $book_id please come on $book_date Time: $book_time  Have new message from <br> 
 
   
    //  ";

    //         $mail = new PHPMailer(true);

    //         $mail->isSMTP();
    //         $mail->Host       = $smtp_server;
    //         $mail->SMTPAuth   = true;
    //         $mail->Username   = $smtp_username;
    //         $mail->Password   = $smtp_password;
    //         $mail->SMTPSecure = $smtp_enc;
    //         $mail->Port       = $smtp_port;

    //         $mail->setFrom($smtp_username);
    //         $mail->addAddress($email);

    //         $mail->isHTML(true);
    //         $mail->Subject = 'Salon Appointment: ' . $dt;
    //         $mail->Body    = $msg1;
    //         $mail->AltBody = $msg1;

    //         $mail->send();
    
    
    // print_r($smtp_password);exit;
    
         echo '<script>alert("Appointment Book and Email Send successfully.");</script>';
         echo "<script>window.location.href = 'all-appointment.php'</script>"; 
      //  exit;
    } else {
        echo "<script>alert('Something went wrong.');</script>";
    }
    
    
    }else  if($status==2){
        
         $update = mysqli_query($con, "UPDATE tblappointment 
        SET Remark='$remark', Status='$status' 
        WHERE ID='$cid'");
        
          echo '<script>alert("Appointment Rejected");</script>';
         echo "<script>window.location.href = 'all-appointment.php'</script>"; 
        
    }
   
  

  
    
  
}
?>

  
<!DOCTYPE HTML>
<html>
<head>
<title>BarbarBaba 1.0 || View Appointment</title>
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
					<h3 class="title1">View Appointment</h3>
					
					
				
					<div class="table-responsive bs-example widget-shadow">
						<p style="font-size:16px; color:red" align="center"> <?php if($msg){
    echo $msg;
  }  ?> </p>
						<h4>View Appointment:</h4>
						<?php
$cid=$_GET['viewid'];
$ret=mysqli_query($con,"select * from tblappointment where ID='$cid'");
$cnt=1;
while ($row=mysqli_fetch_array($ret)) {
    
    //  $ret4=mysqli_query($con,"select * from tblcustomers where ID ='".$row['Name']."' ");
    // $row4=mysqli_fetch_array($ret4);

?>
						<table class="table table-bordered">
							<tr>
    <th>Appointment Number</th>
    <td><?php  echo $row['AptNumber'];?></td>
  </tr>
  <tr>
<th>Name</th>
    <td><?php
   $retr=mysqli_query($con,"select * from tblcustomers where ID='".$row['Name']."' ");
// $cnt=1;
while ($rowr=mysqli_fetch_array($retr)) {

    echo $rowr['Name']; }  ?></td>
  </tr>

<tr>
    <th>Email</th>
    <td><?php  echo $row['Email'];?></td>
  </tr>
   <tr>
    <th>Mobile Number</th>
    <td><?php  echo $row['PhoneNumber'];?></td>
  </tr>
   <tr>
    <th>Appointment Date</th>
    <td><?php  echo  date('d-M-Y', strtotime($row['AptDate']));?></td>
  </tr>
 
<tr>
    <th>Appointment Time</th>
    <td><?php  echo date('H:i', strtotime($row['AptTime']));?></td>
  </tr>
  
  <tr>
    <th>Services</th>
   <td>
<?php
$service_ids = explode(",", $row['Services']);
$service_names = [];
 $total_cost = 0;
foreach ($service_ids as $sid) {
    $sid = intval($sid); // sanitize
    $res = mysqli_query($con, "SELECT ServiceName , Cost FROM tblservices WHERE ID = $sid");
    if ($srow = mysqli_fetch_assoc($res)) {
        $service_names[] = $srow['ServiceName'] . " (₹" . $srow['Cost'] . ")";
        // $cost = $srow['Cost'];
        // echo $srow['Cost'];
        
        $total_cost += $srow['Cost'];
    }
}


echo implode(", ", $service_names);

echo "<br><strong>Total: ₹" . number_format($total_cost, 2) . "</strong>";
?>
</td>
  </tr>
  <tr>
    <th>Apply Date</th>
    <td><?php  echo  date('d-M-Y', strtotime($row['ApplyDate'])) ;?></td>
  </tr>
  

<tr>
    <th>Status</th>
    <td> <?php  
if($row['Status']=="1")
{
  echo "Selected";
}

if($row['Status']=="2")
{
  echo "Rejected";
}

     ;?></td>
  </tr>
						</table>
						<table class="table table-bordered">
							<?php if($row['Remark']==""){ ?>


<form name="submit" method="post" enctype="multipart/form-data"> 

<tr>
    <th>Remark :</th>
    <td>
    <textarea name="remark" placeholder="" rows="3" cols="14" class="form-control wd-450" required="true"></textarea></td>
   </tr>

  <tr>
    <th>Status :</th>
   
    <td>
   <select name="status" id="status" class="form-control wd-450" required="true" >
       <option value="">Select</option>
     <option value="1" >Selected</option>
     <option value="2">Rejected</option>
   </select> <br>
   
   
   </td>
    <input type='hidden' id='Userid' name="Userid" value='<?php  echo $row['Name'];?>'>
  
   <input type='hidden' id='service_total' name="service_total" value=' <?php echo $total_cost; ?>'>
  <tr id="tax_row" style="display: none;">
  <th>Tax (%) :</th>
  <td>
    <!--<input type="number" name="tax" id="tax" class="form-control wd-450" required>-->
    	<select class="form-control" id="tax" name="tax" required="true">
							 	    <option value="">Select Tax</option>
							 	    <?php
$ret2=mysqli_query($con,"select *from  tbl_tax");
$cnt=1;
while ($row2=mysqli_fetch_array($ret2)) {

?>
							 	    <option value="<?php  echo $row2['value'];?>"><?php  echo $row2['name'];?></option>
							 	    <?php } ?>
							 	</select>
  </td>
</tr>


<tr id="staff_row" style="display: none;">
  <th>Assign Staff :</th>
  <td>
    <select class="form-control" id="staff" name="staff">
      <option value="">Select Staff</option>
      <?php
      $ret2 = mysqli_query($con, "select *from tbl_staff");
      while ($row2 = mysqli_fetch_array($ret2)) {
      ?>
        <option value="<?php echo $row2['id']; ?>"><?php echo $row2['name']; ?></option>
      <?php } ?>
    </select>
  </td>
</tr>
  <tr id="total_row" style="display: none;">
  <th>Total :</th>
  <td>
    <input type="text" name="total" id="total" class="form-control wd-450" readonly>
  </td>
</tr>
 
   
  </tr>
  


  <tr align="center">
    <td colspan="2"><button type="submit" name="submit" class="btn btn-az-primary pd-x-20">Submit</button></td>
  </tr>
  </form>
<?php } else { ?>
						</table>
						<table class="table table-bordered">
							<tr>
    <th>Remark</th>
    <td><?php echo $row['Remark']; ?></td>
  </tr>


<tr>
<th>Remark date</th>
<td><?php echo date('d-m-Y', strtotime($row['ApplyDate'])) ; ?>  </td></tr>

						</table>
						<?php } ?>
						<?php } ?>
					</div>
				</div>
			</div>
		</div>
		<!--footer-->
		 <?php include_once('includes/footer.php');?>
        <!--//footer-->
	</div>
	
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    function toggleFieldsByStatus(status) {
        if (status === '1') {
            $('#tax_row').show();
            $('#total_row').show();
            $('#staff').closest('tr').show();

            $('#tax').attr('required', true);
            $('#staff').attr('required', true);
        } else {
            $('#tax_row').hide();
            $('#total_row').hide();
            $('#staff').closest('tr').hide();

            $('#tax').val('').removeAttr('required');
            $('#staff').val('').removeAttr('required');
            $('#total').val('');
        }
    }

    $('#status').on('change', function() {
        toggleFieldsByStatus($(this).val());
    });

    $('#tax').on('change', function() {
        var taxRate = parseFloat($(this).val()) || 0;
        var baseTotal = parseFloat($('#service_total').val()) || 0;

        var taxAmount = (baseTotal * taxRate) / 100;
        var finalTotal = baseTotal + taxAmount;

        $('#total').val(finalTotal.toFixed(2));
    });

    // Initialize on page load
    toggleFieldsByStatus($('#status').val());
});
</script>


</body>
</html><!--  Author Name: Mayuri K. 
 for any PHP, Wordpress, Shopify or Laravel website or software development contact me at work@mayurik.com  -->
<?php }  ?>