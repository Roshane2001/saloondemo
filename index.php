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
    <link rel="icon" type="image/x-icon" href="images/<?php echo $branding_row['favicon'];?>">

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
                <img src="panel/images/logo.png" width="200px" alt="Logo" class="logo">
                <h4 class="mt-3">Welcome to BarbarBaba Appointment Booking</h4>
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
$retr=mysqli_query($con,"select * from  tblservices");
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

                    <?php
$ret=mysqli_query($con,"select * from  tbl_tax");
$cnt=1;
while ($row=mysqli_fetch_array($ret)) {?>

                    <div class="col-md-6">
                        <label for="time" class="form-label"><?php echo $row['name'];?>(%)</label>
                        <input type="text" id="" value="<?php echo $row['value'];?>" class="form-control tax_value"
                            readonly="">
                    </div>
                    <?php $cnt=$cnt+1; }
?>
                    <div class="col-md-6">
                        <label class="form-label">Total (with Tax)</label>
                        <input type="text" id="grand_total" name="grand_total" value="" class="form-control" readonly>
                    </div>


                    <div class="col-12 text-center mt-4">
                        <button type="button" id="rzp-button1" onclick="add()" class="btn btn-primary w-100">Book
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

            // Calculate total tax %
            let taxPercent = 0;
            $('.tax_value').each(function() {
                let val = parseFloat($(this).val()) || 0;
                taxPercent += val;
            });

            // Apply tax
            let finalAmount = total + (total * taxPercent / 100);
            $('#grand_total').val(finalAmount.toFixed(2)); // Set total with tax
        });
    });
    </script>

    <style>
    .error {
        color: red !important;
    }
    </style>
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
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
                serv_id: {
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

                serv_id: {
                    required: "Please enter a serv_id."
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
                createOrder();
            }
        });
    });
    </script>
    <?php



    $keyId = "rzp_test_NztH8uGmFZkb5I";
    $keySecret = "Dqnjxwto91Zvp1NdudTG2ov1";



function generateUniqueRandomId($length = 5)
{
  $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
  $randomId = '';
  for ($i = 0; $i < $length; $i++) {
    $randomId .= $characters[rand(0, strlen($characters) - 1)];
  }
  return $randomId;
}

 $newRandomId = generateUniqueRandomId();
?>
    <script>
    function add() {
        if ($('#add_slider').valid()) {
            createOrder();
        }
    };

    function createOrder() {

        var recv = "<?php echo $newRandomId; ?>";
        var name = $("input[name='name']").val();
        
        var amount = $("input[name='grand_total']").val();
        var actual_amount = amount * 100;
        var description = 'Order Payment'; // Change description as per your requirement
        var formData = $('#add_slider').serialize();

        $.ajax({
            url: 'create_order.php', // Your PHP script to create order
            method: 'POST',
            dataType: 'json',
            data: {
                amount: amount,
                currency: 'LKR',
                receipt: recv, // You can set your custom receipt ID here
                payment_capture: 1
            },
            success: function(response) {
                // alert(response.id);
                if (response.id) {
                    var orderId = response.id;
                    var keyId = "<?php echo $keyId; ?>"; // Pass $keyId to JavaScript variable
                    var options = {
                        "key": keyId, // Your Razorpay API Key
                        "amount": actual_amount,
                        "currency": "LKR",
                        "name": name,
                        "description": description,
                        "image": "",
                        "order_id": orderId,
                        "handler": function(response) {
                            // alert(response);
                            $.ajax({
                                url: 'booking.php',
                                method: 'POST',
                                data: formData + '&payment_id=' + response
                                    .razorpay_payment_id + '&order_id=' + orderId,


                                success: function(data) {
                                    alert("Thank you for Booking!");
                                    // location.reload();
                                    window.location.href = 'index .php';
                                    //  window.location.href = 'reciept.php?payment_id='+ response.razorpay_payment_id;
                                },
                                error: function(xhr, status, error) {
                                    console.error(xhr
                                    .responseText); // Log any errors to console
                                }
                            });
                        }
                    };

                    var rzp1 = new Razorpay(options);
                    rzp1.on('payment.failed', function(response) {
                        console.error(response.error.code);
                        console.error(response.error.description);
                        console.error(response.error.source);
                        console.error(response.error.step);
                        console.error(response.error.reason);
                        console.error(response.error.metadata.order_id);
                        console.error(response.error.metadata.payment_id);
                    });

                    rzp1.open();
                } else {
                    console.error('Order ID not found in response', response);
                }
            },
            error: function(xhr, status, error) {
                console.error('Error creating order:', xhr.responseText);
            }
        });
    }
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