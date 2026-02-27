<?php
$branding_query = mysqli_query($con, "select * from branding where id=1");
$branding_row = mysqli_fetch_array($branding_query);
?>
<div id="page"></div>
<div id="loading"></div>



<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<div class="sticky-header header-section ">


      <div class="header-left">
       
        <!--logo -->
        <div class="logo">
            <img src="images/<?php echo $branding_row['logo'];?>" width="190px" class="logo-top">
          </a>
        </div>
        <!--//logo-->
         <!--toggle button start-->
        <button id="showLeftPush"><i class="fa fa-bars"></i></button>
        <!--toggle button end-->
       
       
        <div class="clearfix"> </div>

      </div>

      <div class="header-right">

        <div class="profile_details_left"><!--notifications of menu start -->



          <ul class="nofitications-dropdown">


            <?php
$ret1=mysqli_query($con,"select ID,Name from  tblappointment where Status=''");
$num=mysqli_num_rows($ret1);

?>  
            <li class="dropdown head-dpdn">
              <div class="d-flex">
              

              <div id="google_translate_element"></div>
<!-- <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-bell"></i><span class="badge blue"></?php echo $num;?></span></a> -->
              </div>
              
              <ul class="dropdown-menu">

                <li>
                  <div class="notification_header">
                    <h3>You have <?php echo $num;?> new notification</h3>
                  </div>
                </li>
                <li>
            
                   <div class="notification_desc">
                     <?php if($num>0){
while($result=mysqli_fetch_array($ret1))
{
            ?>
                 <a class="dropdown-item" href="view-appointment.php?viewid=<?php echo $result['ID'];?>">New appointment received from <?php echo $result['Name'];?> </a><br />
<?php }} else {?>
    <a class="dropdown-item" href="all-appointment.php">No New Appointment Received</a>
        <?php } ?>
                           
                  </div>
                  <div class="clearfix"></div>  
                 </a></li>
                 
                
                 <li>
                  <div class="notification_bottom">
                    <a href="new-appointment.php">See all notifications</a>
                  </div> 
                </li>
              </ul>
            </li> 
          
          </ul>
          <div class="clearfix"> </div>
        </div>
        <!--notification menu end -->
        <div class="profile_details">  
        <?php
$adid=$_SESSION['bpmsaid'];
$ret=mysqli_query($con,"select AdminName from tbladmin where ID='$adid'");
$row=mysqli_fetch_array($ret);
$name=$row['AdminName'];

?> 
          <ul>
            <li class="dropdown profile_details_drop">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                <div class="profile_img"> 
                  <span class="prfil-img"><img src="images/1.png" alt="" width="50" height="50"> </span> 
                 <!--  <div class="user-name">
                    <p></?php echo $name; ?></p>
                    <span>Administrator</span>
                  </div>
                  <i class="fa fa-angle-down lnr"></i>
                  <i class="fa fa-angle-up lnr"></i> -->
                  <div class="clearfix"></div>  
                </div>  
              </a>
              <ul class="dropdown-menu drp-mnu">
                <li><a class="dropdown-item py-2">
      
                          <div class="avatar-box">
                                <div class="flex-shrink-0 me-2">
                                  <div class="avatar avatar-online">
                                    <img src="images/1.png" alt="" class="rounded-circle" width="50px">
                                  </div>
                                </div>
                                <div class="flex-grow-1">
                                  <h4 class="mb-0">Mayuri K.</h4>
                                  <small class="text-muted">work@mayurik.com</small>
                                </div>
                              </div>  
                                              
                            </a></li><hr>
                <li> <a href="change-password.php"><i class="fa fa-cog me-2"></i> Settings</a> </li> 
                <li> <a href="admin-profile.php"><i class="fa fa-user me-2"></i> Profile</a> </li> 
                <li class="btn-sm btn w-100 btn-danger bg-danger"> <a href="logout .php" class="text-white"> Logout    <i class="fa fa-sign-out text-white"></i></a> </li>
              </ul>
            </li>
          </ul>
        </div>  
        <div class="clearfix"> </div> 
      </div>
      <div class="clearfix"> </div> 
    </div>



<!--<script type="text/javascript">
function googleTranslateElementInit() {
  new google.translate.TranslateElement({pageLanguage: 'en'}, 'google_translate_element');
}
</script>

<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>-->
