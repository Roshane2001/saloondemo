<?php
// session_start();
// error_reporting(0);
include('panel/includes/dbconnection.php');

$branding_query = mysqli_query($con, "select * from branding where id=1");
$branding_row = mysqli_fetch_array($branding_query);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Appointment Booking</title>
    <link rel="icon" type="image/x-icon" href="panel/images/<?php echo $branding_row['favicon'];?>">

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />


    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />


    <style>
    body {
        font-family: "Public Sans", "Oxygen", "Ubuntu", "Cantarell", "Fira Sans", sans-serif;
        background: url('panel/images/hero-img.jpg');
        background-repeat: no-repeat;
        background-size: cover;
        min-height: 100vh;
    }

    .card {
        border: none;
        border-radius: 15px;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        background-color: rgba(255, 255, 255, 0.95);
    }

    .form-control,
    .form-select {
        border-radius: 10px;
    }

    .form-label {
        font-weight: 600;
    }

    .btn-primary {
        border-radius: 10px;
        padding: 10px 20px;
        background: #2e4758;
        border-color: #2e4758;
    }

    .btn:hover {
        border-radius: 10px;
        padding: 10px 20px;
        background: #2e4758;
        border-color: #2e4758;
    }

    .btn:focus-visible {
        background: #2e4758;
        border-color: #2e4758;
    }

    .logo {
        width: 350px;
    }

    @media (max-width: 576px) {
        .card {
            padding: 1.5rem !important;
        }

        .logo {
            width: 120px;
        }

        h4 {
            font-size: 1.25rem;
        }
    }
    </style>
</head>

<body>

    <div class="container d-flex align-items-center  py-5" style="min-height: 100vh;">
        <div class="card p-4 p-md-5 w-100 bg-white" style="max-width: 700px;">
            <div class="text-center mb-4">
                <img src="panel/images/<?php echo $branding_row['logo'];?>" width="200px" alt="Logo" class="logo">
                <h4 class="mt-3">Welcome to <?php echo $branding_row['brand_name'];?> Appointment Booking</h4>
            </div>

            <form action="" method="post" id="add_slider" enctype="multipart/form-data">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="fullname" class="form-label">Full Name</label>
                        <input type="text" id="fullname" name="name" class="form-control"
                            placeholder="Enter your full name">
                    </div>

                    <div class="col-md-6">
                        <label for="email" class="form-label">Email Address</label>
                        <input type="email" id="email" name="email" class="form-control" placeholder="Enter your email">
                    </div>

                    <div class="col-md-6">
                        <label for="phone" class="form-label">Phone Number</label>
                        <input type="tel" id="phone" name="phone" class="form-control"
                            placeholder="Enter your phone number">
                    </div>

                    <div class="col-md-6">
                        <label for="branch" class="form-label">Branch</label>
                        <select id="branch" name="branch_id" class="form-select" required>
                            <option value="">Select a branch</option>
                            <?php
                            $branch_query=mysqli_query($con,"select * from tblbranch");
                            while($branch_row=mysqli_fetch_array($branch_query)) {
                            ?>
                            <option value="<?php echo $branch_row['branch_id'];?>"><?php echo $branch_row['branch_name'];?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label for="date" class="form-label">Appointment Date</label>
                        <input type="date" id="date" name="apt_date" class="form-control">
                    </div>

                    <div class="col-md-6">
                        <label for="time" class="form-label">Appointment Time</label>
                        <input type="time" id="time" name="apt_time" class="form-control">
                    </div>

                    <div class="col-md-6">
                        <label for="services" class="form-label">Service Required</label>
                        <select id="services" name="serv_id[]" class="form-select select2" multiple="multiple">
                            <option value="">Select a service</option>
                            <?php
$retr=mysqli_query($con,"select * from  tblservices where status='1'");
$cnt=1;
while ($rowr=mysqli_fetch_array($retr)) {?>
                            <option value="<?php echo $rowr['ID'];?>" data-cost="<?php echo $rowr['Cost']; ?>">
                                <?php echo $rowr['ServiceName'];?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label for="total" class="form-label">Price</label>
                        <input type="text" id="total" name="total" value="" class="form-control" readonly="">
                    </div>

                    <div class="col-12 text-center mt-4">
                        <button type="submit" class="btn btn-primary w-100">Book
                            Appointment</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
    $(document).ready(function() {
        $('.select2').select2();
    });
    </script>





    <script>
    $(document).ready(function() {
        $('#services').on('change', function() {
            let total = 0;

            // Calculate base price from selected services
            $('#services option:selected').each(function() {
                let cost = parseFloat($(this).data('cost')) || 0;
                total += cost;
            });

            $('#total').val(total.toFixed(2)); // Set base price
            $('#grand_total').val(total.toFixed(2));
        });
    });
    </script>

    <style>
    .error {
        color: red !important;
    }
    </style>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.20.0/jquery.validate.min.js"
        integrity="sha512-WMEKGZ7L5LWgaPeJtw9MBM4i5w5OSBlSjTjCtSnvFJGSVD26gE5+Td12qN5pvWXhuWaWcVwF++F7aqu9cvqP0A=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
    $(document).ready(function() {
        jQuery.validator.addMethod("noDigits", function(value, element) {
            return this.optional(element) || !/\d/.test(value);
        }, "Please enter a value without digits.");

        jQuery.validator.addMethod("noSpacesOnly", function(value, element) {
            return value.trim() !== '';
        }, "Please enter a non-empty value");

        $('#add_slider').validate({
            rules: {
                name: {
                    required: true

                },

                apt_time: {
                    required: true

                },
                email: {
                    required: true,
                    email: true
                },
                apt_date: {
                    required: true

                },
                'serv_id[]': {
                    required: true

                },
                branch_id: {
                    required: true
                },
                phone: {
                    required: true,
                    noSpacesOnly: true,
                    digits: true,
                    minlength: 10,
                    maxlength: 10
                }
            },
            messages: {
                name: {
                    required: "Please enter a  name."
                },

                'serv_id[]': {
                    required: "Please select at least one service."
                },
                branch_id: {
                    required: "Please select a branch."
                },
                email: {
                    required: "Please enter a email."
                },
                phone: {
                    required: "Please enter a phone."
                },
                apt_date: {
                    required: "Please enter a date."
                },
                apt_time: {
                    required: "Please enter a time."
                }
            },
            submitHandler: function(form) {
                var formData = $(form).serialize();
                $.ajax({
                    url: 'booking.php',
                    method: 'POST',
                    data: formData,
                    success: function(response) {
                        if (response.trim() === 'success') {
                            alert('Thank you for your booking request. We will confirm it shortly.');
                            window.location.href = 'index.php';
                        } else {
                            alert('An error occurred during booking: ' + response);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                        alert('A system error occurred. Please try again later.');
                    }
                });
            }
        });
    });
    </script>

    <script>
    function submitForm1(event, id, name, file) {
        event.preventDefault(); // Prevent the default link behavior
        // Remove spaces and slashes from the name
        var sanitizedName = name.replace(/[\s/]+/g, '-');
        // var sanitizedName = name.replace(/\s+/g, '-');
        // Construct the friendly URL
        var friendlyURL = file + '/' + id + '/' + sanitizedName;
        // Replace spaces with hyphens in the name
        //       var sanitizedName = name.replace(/\s+/g, '-');
        // alert(sanitizedName);
        //       // Create a form dynamically
        var form = document.createElement('form');

        // form.action = file + '/' + encodeURIComponent(sanitizedName);
        form.action = friendlyURL;
        form.method = 'post';

        // Create hidden input fields for ID and Name
        var idInput = document.createElement('input');
        idInput.type = 'hidden';
        idInput.name = 'id';
        idInput.value = id;

        var nameInput = document.createElement('input');
        nameInput.type = 'hidden';
        nameInput.name = 'name';
        nameInput.value = sanitizedName;

        // Append the input fields to the form
        form.appendChild(idInput);
        form.appendChild(nameInput);

        // Append the form to the body and submit it
        document.body.appendChild(form);
        form.submit();
    }
    </script>
</body>

</html>