<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['bpmsaid']==0)) {
  header('location:logout.php');
  } else{

if(isset($_POST['submit']))
  {
    $AptNumber = mt_rand(100000000, 999999999);
    $Email = $_POST['Email'];
    $PhoneNumber = $_POST['PhoneNumber'];
    $AptDate = $_POST['AptDate'];
    $AptTime = $_POST['AptTime'];
    $branch_id = $_POST['branch_id'];
    $Services = implode(",", $_POST['services']);
    
    $customer_id = $_POST['Name']; // from hidden input
    $customer_name_text = $_POST['customer_name_text']; // from text input

    $final_customer_id = 0;

    if (!empty($customer_id)) {
        $final_customer_id = $customer_id;
    } else {
        // New customer, create one
        $new_customer_name = mysqli_real_escape_string($con, $customer_name_text);
        $new_customer_email = mysqli_real_escape_string($con, $Email);
        $new_customer_phone = mysqli_real_escape_string($con, $PhoneNumber);

        // Check if customer already exists by phone number to avoid duplicates
        $stmt_check = $con->prepare("SELECT ID FROM tblcustomers WHERE MobileNumber=? LIMIT 1");
        $stmt_check->bind_param("s", $new_customer_phone);
        $stmt_check->execute();
        $result_check = $stmt_check->get_result();

        if($result_check->num_rows > 0) {
            $existing_customer = $result_check->fetch_assoc();
            $final_customer_id = $existing_customer['ID'];
        } else {
            $stmt_insert = $con->prepare("INSERT INTO tblcustomers(Name, Email, MobileNumber) VALUES (?, ?, ?)");
            $stmt_insert->bind_param("sss", $new_customer_name, $new_customer_email, $new_customer_phone);
            if ($stmt_insert->execute()) {
                $final_customer_id = $stmt_insert->insert_id;
            }
        }
    }

    if ($final_customer_id > 0) {
        $stmt_appt = $con->prepare("INSERT INTO `tblappointment`(`AptNumber`, `Name`, `Email`, `PhoneNumber`, `AptDate`, `AptTime`, `Services`, `branch_id`) VALUES(?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt_appt->bind_param("issssssi", $AptNumber, $final_customer_id, $Email, $PhoneNumber, $AptDate, $AptTime, $Services, $branch_id);
        
        if ($stmt_appt->execute()) {
            echo '<script>alert("Appointment Added successfully. Appointment number is ' . $AptNumber . '")</script>';
            echo "<script>window.location.href = 'all-appointment.php'</script>"; 
        }
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
    <script type="application/x-javascript">
    addEventListener("load", function() {
        setTimeout(hideURLbar, 0);
    }, false);

    function hideURLbar() {
        window.scrollTo(0, 1);
    }
    </script>
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
    <link href='//fonts.googleapis.com/css?family=Roboto+Condensed:400,300,300italic,400italic,700,700italic'
        rel='stylesheet' type='text/css'>
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
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
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
                                    <input type="text" class="form-control" id="customer_name_text" name="customer_name_text" placeholder="Customer Name" required="true">
                                    <input type="hidden" name="Name" id="customer_id">
                                </div>

                                <div class="form-group col-md-6">
                                    <label>Branch</label>
                                    <select class="form-control" name="branch_id" required="true">
                                        <option value="">Select Branch</option>
                                        <?php
                                        $branch_query=mysqli_query($con,"select * from tblbranch");
                                        while($branch_row=mysqli_fetch_array($branch_query))
                                        {
                                        ?>
                                        <option value="<?php echo $branch_row['branch_id'];?>">
                                            <?php echo $branch_row['branch_name'];?></option>
                                        <?php } ?>
                                    </select>
                                </div>

                                <!--<input type="hidden" id="customer_name" name="Name">-->

                                <div class="form-group col-md-6">
                                    <label>Email</label>
                                    <input type="text" id="email" name="Email" class="form-control" placeholder="Email"
                                        >
                                </div>
								<div class="form-group col-md-6">
                                    <label>Phone</label>
                                    <input type="text" id="phone" name="PhoneNumber" class="form-control"
                                        placeholder="Type to search for customer by phone..." required>
                                </div>

                                <div class="form-group col-md-6">
                                    <label>Appointment Date</label>
                                    <input type="date" name="AptDate" class="form-control"
                                        placeholder="Appointment Date" required>
                                </div>

                                <div class="form-group col-md-6">
                                    <label>Appointment Time</label>
                                    <input type="time" name="AptTime" class="form-control"
                                        placeholder="Appointment Time" required>
                                </div>

                                <div class="form-group col-md-6">
                                    <label>Services </label>
                                    <select name="services[]" class="form-control select2" multiple="">
                                        <?php
$ret=mysqli_query($con,"select *from  tblservices where type = 2 ");
$cnt=1;
while ($row=mysqli_fetch_array($ret)) {

?>
                                        <option value="<?php  echo $row['ID'];?>"><?php  echo $row['ServiceName'];?>
                                        </option>
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

        <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
        <script>
        $(document).ready(function() {
            $("#phone").autocomplete({
                source: "search_customers.php",
                minLength: 2,
                select: function(event, ui) {
                    $("#phone").val(ui.item.phone);
                    $("#customer_name_text").val(ui.item.name);
                    $("#customer_id").val(ui.item.id); // save the ID to hidden field
                    $('#email').val(ui.item.email);
                    return false; // prevent the widget from inserting the value.
                }
            });

            // Clear other fields if phone is cleared
            $('#phone').on('input', function() {
                if ($(this).val() === '') {
                    $("#customer_id").val('');
                    $('#customer_name_text').val('');
                    $('#email').val('');
                }
            });

            // Initialize select2
            $('.select2').select2();
        });
        </script>
</body>

</html>
<!--  Author Name: Mayuri K. 
 for any PHP, Wordpress, Shopify or Laravel website or software development contact me at work@mayurik.com  -->
<?php } ?>