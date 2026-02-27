<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

if(isset($_POST['login']))
  {
    $adminuser=$_POST['username'];
    $password=md5($_POST['password']);
    $query=mysqli_query($con,"select ID from tbladmin where  UserName='$adminuser' && Password='$password' ");
    $ret=mysqli_fetch_array($query);
    if($ret>0){
      $_SESSION['bpmsaid']=$ret['ID'];
      echo "<script type='text/javascript'> document.location ='dashboard.php'; </script>";
    }
    else{
    echo "<script>alert('Invalid Details');</script>";
    }
  }
  $branding_query = mysqli_query($con, "select * from branding where id=1");
$branding_row = mysqli_fetch_array($branding_query);
  ?>
<!DOCTYPE HTML>
<html>

<head>
    <title>Login Page </title>
    <link rel="icon" type="image/x-icon" href="images/<?php echo $branding_row['favicon'];?>">


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
    <!--//Metis Menu -->


    <style>
    .toggle-password {
        position: relative;
        float: right;
        cursor: pointer;
        margin-right: 10px;
        margin-top: -50px;
    }
    </style>
</head>

<body class="login">
    <div class="main-content">

        <!-- main content start-->
        <div class="row">
            <div class="main-page col-md-4 login-page">

                <div class="widget-shadow">
                    <div class="login-top">
                        <img src="images/<?php echo $branding_row['logo'];?>" width="300px">
                        <!-- <h3 class="title1">SignIn Page</h3> -->
                        <h4>Welcome back to <?php echo $branding_row['brand_name'];?></h4>
                    </div>
                    <div class="login-body">
                        <form role="form" method="post" action="">
                            <label class="form-label">Email address</label>
                            <input type="text" class="" name="username" placeholder="Username" id="inputField1"
                                required="true">

                            <label class="form-label">Password</label>
                            <div class="password-wrapper">
                                <input type="password" name="password" id="inputField2" class="password-input"
                                    placeholder="Password" required>
                                <i class="toggle-password fa fa-eye"></i>
                            </div>

                            <div class="g-recaptcha pb-3 mt-3" data-sitekey="6LcUBM8pAAAAAHBupsOZjue6_YIn23Ws5IKgGqgc">
                            </div>
                            <div>
                                <input type="submit" name="login" value="Sign In">
                            </div>


                            <div class="forgot-grid">

                                <div class="forgot">
                                    <a href="forgot-password.php">forgot password?</a>
                                </div>
                                <div class="clearfix"> </div>
                            </div>
                            <div class="forgot-grid">

                                <div class="forgot">
                                    <a href="../index.php">Back to Home</a>
                                </div>
                                <div class="clearfix"> </div>
                            </div>
                        </form>
                    </div>
                </div>


            </div>
        </div>

    </div>
    <!-- Classie -->
    <script src="js/classie.js"></script>


    <script>
    var menuLeft = document.getElementById('cbp-spmenu-s1'),
        showLeftPush = document.getElementById('showLeftPush'),
        body = document.body;

    showLeftPush.onclick = function() {
        classie.toggle(this, 'active');
        classie.toggle(body, 'cbp-spmenu-push-toright');
        classie.toggle(menuLeft, 'cbp-spmenu-open');
        disableOther('showLeftPush');
    };

    function disableOther(button) {
        if (button !== 'showLeftPush') {
            classie.toggle(showLeftPush, 'disabled');
        }
    }
    </script>
    <!--scrolling js-->
   
    <script src="js/scripts.js"></script>
    <!--//scrolling js-->
    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.js"> </script>
    <script src="js/space.js"></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

    <script>
    $(document).ready(function() {
        $(".toggle-password").click(function() {
            let input = $("#password");
            let icon = $(this);

            if (input.attr("type") === "password") {
                input.attr("type", "text");
                icon.removeClass("fa-eye").addClass("fa-eye-slash"); // Change icon
            } else {
                input.attr("type", "password");
                icon.removeClass("fa-eye-slash").addClass("fa-eye"); // Revert icon
            }
        });
    });
    </script>

</body>

</html>