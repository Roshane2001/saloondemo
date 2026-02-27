  <style type="text/css">
#leftCol {
    position: fixed;
    width: 309px;
    overflow-y: scroll;
    top: 0;
    bottom: 0;
}

.me-2 {
    margin-right: 12px;
}

.font {
    font-size: .70rem !important;
}
  </style>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <link href="./css/fonts/tabler-icons.css" rel='stylesheet' type='text/css' />




  <div class=" sidebar" role="navigation">
      <div class="navbar-collapse">
          <nav class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-left navigation" id="cbp-spmenu-s1">
              <ul class="nav sidetab" id="leftCol" style="margin-top:7% ;">
                  <li class="nav-item">
                      <a href="dashboard.php"><i class="ti ti-smart-home me-2"></i> Dashboard</a>
                  </li>


                  <li class="nav-item">
                      <a href="#"><i class="ti ti-users me-2"></i>Customer <span class="fa arrow"></span></a>
                      <ul class="nav nav-second-level collapse">
                          <li class="nav-item">
                              <a href="add-customer.php"><i class="ti ti-circle me-2 font"></i>Add</a>
                          </li>
                          <li class="nav-item">
                              <a href="customer-list.php"><i class="ti ti-circle me-2 font"></i>Manage</a>
                          </li>
                          <li class="nav-item">
                              <a href="visit.php"><i class="ti ti-circle me-2 font"></i>Visit</a>
                          </li>
                      </ul>

                  </li>


                  <!--<li class="nav-item">
                      <a href="all-appointment.php"><i class="ti ti-list me-2"></i>Appointment<span
                              class="fa arrow"></span></a>
                      <ul class="nav nav-second-level collapse">
                          <li class="nav-item">
                              <a href="add-appointment.php"><i class="ti ti-circle me-2 font"></i>Add Appointment</a>
                          </li>
                          <li class="nav-item">
                              <a href="all-appointment.php"><i class="ti ti-circle me-2 font"></i>All Appointment</a>
                          </li>
                          !--<li class="nav-item">-->
                  <!--  <a href="new-appointment.php"><i class="ti ti-circle me-2 font"></i>New Appointment</a>-->
                  <!--</li>--
                          <li class="nav-item">
                              <a href="accepted-appointment.php"><i class="ti ti-circle me-2 font"></i>Accepted
                                  Appointment</a>
                          </li>
                          <li class="nav-item">
                              <a href="rejected-appointment.php"><i class="ti ti-circle me-2 font"></i>Rejected
                                  Appointment</a>
                          </li>
                      </ul>
                      !-- //nav-second-level --
                  </li>-->


                  <li class="nav-item">
                      <a href="add-staff.php"><i class="ti ti-users me-2"></i>Staff<span class="fa arrow"></span> </a>
                      <ul class="nav nav-second-level collapse nav-item">
                          <li class="nav-item">
                              <a href="add-staff.php"><i class="ti ti-circle me-2 font"></i>Add Staff</a>
                          </li>
                          <li class="nav-item">
                              <a href="manage-staff.php"><i class="ti ti-circle me-2 font"></i>Manage Staff</a>
                          </li>


                      </ul>
                      <!-- /nav-second-level -->
                  </li>

                  <li class="nav-item">
                      <a href="add-services.php"><i class="ti ti-shopping-cart me-2"></i>Cashier<span
                              class="fa arrow"></span> </a>
                      <ul class="nav nav-second-level collapse nav-item">
                          <li class="nav-item">
                              <a href="Cashier/cashier.php" target="_blank"><i
                                      class="ti ti-circle me-2 font"></i>Cart</a>
                          </li>
                      </ul>
                      <!-- /nav-second-level -->
                  </li>

                  <li class="nav-item">
                      <a href="add-services.php"><i class="ti ti-hotel-service me-2"></i>Services/Product<span
                              class="fa arrow"></span> </a>
                      <ul class="nav nav-second-level collapse nav-item">
                          <li class="nav-item">
                              <a href="add-services.php"><i class="ti ti-circle me-2 font"></i>Add</a>
                          </li>
                          <li class="nav-item">
                              <a href="manage-services.php"><i class="ti ti-circle me-2 font"></i>Manage</a>
                          </li>
                      </ul>
                      <!-- /nav-second-level -->
                  </li>


                  <!--    <li class="nav-item">-->
                  <!--  <a href="order.php" class="chart-nav"><i class="ti ti-file-invoice me-2"></i>Orders</a>-->
                  <!--</li>
              <li class="nav-item">
              <a href="add-services.php"><i class="ti ti-file-invoice me-2"></i>Orders<span class="fa arrow"></span> </a>
              <ul class="nav nav-second-level collapse nav-item">
                <li class="nav-item">
                  <a href="order.php"><i class="ti ti-circle me-2 font"></i>Add</a>
                </li>
                <li class="nav-item">
                  <a href="view_order.php"><i class="ti ti-circle me-2 font"></i>Manage</a>
                </li>
              </ul>
              <!-- /nav-second-level --
            </li>-->

                  <li class="nav-item">
                      <a href="invoices.php" class="chart-nav"><i class="ti ti-wallet me-2"></i>Invoices</a>
                  </li>


                  <!--reports-->
                  <li class="nav-item">
                      <a href="#"><i class="ti ti-file me-2"></i>Reports<span class="fa arrow"></span> </a>
                      <ul class="nav nav-second-level collapse nav-item">
                          <li class="nav-item">
                              <a href="bwdates-reports-ds.php" class="chart-nav"><i class="ti ti-report me-2"></i>Sales
                                  Report</a>
                          </li>
                          <!--<li class="nav-item">
              <a href="pro_sale.php" class="chart-nav"><i class="ti ti-report me-2"></i>Product Sales Report</a>
            </li>-->

                          <li class="nav-item">
                              <a href="staff_commision.php" class="chart-nav"><i class="ti ti-report me-2"></i>Staff
                                  Commision</a>
                          </li>

                          <li class="nav-item">
                              <a href="top_services.php" class="chart-nav"><i class="ti ti-star me-2"></i>Top
                                  Services</a>
                          </li>

                          <li class="nav-item">
                              <a href="top_staff.php" class="chart-nav"><i class="ti ti-star me-2"></i>Top Staff</a>
                          </li>

                      </ul>
                      <!-- /nav-second-level -->
                  </li>



                  <!--<li class="nav-item">
                      <a href="#"><i class="ti ti-id-badge me-2"></i>Plan <span class="fa arrow"></span></a>
                      <ul class="nav nav-second-level collapse">
                          <li class="nav-item">
                              <a href="add_plan.php"><i class="ti ti-circle me-2 font"></i>Add</a>
                          </li>
                          <li class="nav-item">
                              <a href="manage_plan.php"><i class="ti ti-circle me-2 font"></i>Manage</a>
                          </li>
                      </ul>

                  </li>-->

                  <!--<li class="nav-item">
                      <a href="#"><i class="ti ti-files me-2"></i>Subscription <span class="fa arrow"></span></a>
                      <ul class="nav nav-second-level collapse">
                          <li class="nav-item">
                              <a href="add_subscribe.php"><i class="ti ti-circle me-2 font"></i>Add</a>
                          </li>
                          <li class="nav-item">
                              <a href="manage_subscribe.php"><i class="ti ti-circle me-2 font"></i>Manage</a>
                          </li>
                      </ul>

                  </li>-->


                  <li class="nav-item">
                      <a href="add-category.php"><i class="ti ti-globe me-2"></i>Category<span class="fa arrow"></span>
                      </a>
                      <ul class="nav nav-second-level collapse nav-item">
                          <li class="nav-item">
                              <a href="add-category.php"><i class="ti ti-circle me-2 font"></i>Add Category</a>
                          </li>
                          <li class="nav-item">
                              <a href="manage-category.php"><i class="ti ti-circle me-2 font"></i>Manage Category</a>
                          </li>
                      </ul>
                      <!-- /nav-second-level -->
                  </li>


                  <!--<li class="nav-item">
                      <a href="search-appointment.php" class="chart-nav"><i
                              class="ti ti-adjustments-search me-2"></i>Search Appointment</a>
                  </li>-->

                  <!--<li class="nav-item">
                      <a href="add-tax.php"><i class="ti ti-tag me-2"></i>Tax<span class="fa arrow"></span> </a>
                      <ul class="nav nav-second-level collapse nav-item">
                          !--<li class="nav-item">-->
                  <!--  <a href="add-tax.php"><i class="ti ti-circle me-2 font"></i>Add Tax</a>-->
                  <!--</li>--
                          <li class="nav-item">
                              <a href="manage-tax.php"><i class="ti ti-circle me-2 font"></i>Manage Tax</a>
                          </li>
                      </ul>
                      !-- /nav-second-level --
                  </li>-->




                  <li class="nav-item">
                      <a href="#"><i class="ti ti-menu me-2"></i>Staff Scheduling<span class="fa arrow"></span> </a>
                      <ul class="nav nav-second-level collapse nav-item">
                          <li class="nav-item">
                              <a href="schedule-staff.php"><i class="ti ti-circle me-2 font"></i>Add</a>
                          </li>
                          <li class="nav-item">
                              <a href="view_schedule.php"><i class="ti ti-circle me-2 font"></i>Manage </a>
                          </li>


                      </ul>

                  </li>

                  <li class="nav-item">
                      <a href="branding.php"><i class="ti ti-hotel-service me-2"></i>Branding<span
                              class="fa arrow"></span> </a>
                      <!-- /nav-second-level -->
                  </li>


                  <li class="nav-item">
                      <a href="logout.php"><i class="ti ti-circle me-2 font"></i>Logout</a>
                  </li>




                  <!--<li class="nav-item">-->
                  <!--   <a href="subcriber.php" class="chart-nav"><i class="ti ti-tags me-2"></i>Subcriber</a>-->
                  <!-- </li>-->



















                  <!--<li class="nav-item">-->
                  <!--  <a href="sales-reports.php" class="chart-nav"><i class="ti ti-file me-2"></i>Sales Report</a>-->
                  <!--</li>-->


                  <!--<li class="nav-item">-->
                  <!--  <a href="search-invoices.php" class="chart-nav"><i class="ti ti-devices-search me-2"></i>Search Invoice</a>-->
                  <!--</li>-->


              </ul>
              <div class="clearfix"> </div>
              <!-- //sidebar-collapse -->
          </nav>
      </div>
  </div>


  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
      integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
      crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script>
$(function($) {
    let url = window.location.href;
    $('.navigation ul .nav-item a').each(function() {
        if (this.href === url) {
            // Only For Menu
            $(this).closest('.navigation ul .nav-item').addClass('active');
            // For Dropdown Menu
            $(this).parent('.nav-item').addClass("active");
        }
    });
});
  </script>

  <script>
$(function() {
    $(window).bind("load resize", function() {
        let topOffset = 50;
        let width = (this.window.innerWidth > 0) ? this.window.innerWidth : this.screen.width;

        if (width < 768) {
            $('div.navbar-collapse').addClass('collapse');
            topOffset = 100; // Adjust for smaller screens
        } else {
            $('div.navbar-collapse').removeClass('collapse');
        }

        let height = ((this.window.innerHeight > 0) ? this.window.innerHeight : this.screen.height) - 1;
        height = height - topOffset;
        if (height < 1) height = 1;
        if (height > topOffset) {
            $("#page-wrapper").css("min-height", height + "px");
        }
    });

    // Highlight active menu and keep parent open
    let url = window.location.href;
    $(".nav-second-level li a").each(function() {
        if (this.href === url) {
            $(this).addClass("active"); // Highlight active link
            $(this).closest(".nav-second-level").addClass("show"); // Keep parent open
            $(this).closest(".nav-item").find("> a").addClass("active"); // Highlight parent
        }
    });

    // Sidebar Active State for Both Sidebar and Submenu Items
    let currentUrl = window.location.href;
    $('.sidebar ul .s-item a, #sidebar ul li a').each(function() {
        if (this.href === currentUrl) {
            $(this).closest('.s-item, li').addClass('active'); // Add active class to menu
            $(this).parent('.s-item, li').addClass("active"); // Add active class to submenu item
            $(this).closest(".nav-second-level").addClass("show"); // Keep submenu open
            $(this).closest(".nav-item").find("> a").addClass("active"); // Highlight parent menu
        }
    });

    // Toggle Dropdown Functionality
    $(".nav-item > a").click(function(e) {
        let $parent = $(this).parent();
        let $submenu = $parent.find(".nav-second-level");

        if ($submenu.length) {
            e.preventDefault(); // Prevent default link behavior for dropdown items
            if ($submenu.hasClass("show")) {
                $submenu.removeClass("show").slideUp(300); // Close submenu
                $parent.removeClass("active");
            } else {
                $(".nav-second-level").removeClass("show").slideUp(300); // Close other submenus
                $(".nav-item").removeClass("active");
                $submenu.addClass("show").slideDown(300); // Open clicked submenu
                $parent.addClass("active");
            }
        }
    });
});
  </script>