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
    <title>Invoice List</title>
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
    <!--//Metis Menu -->
</head>
<body onload="window.print()" onafterprint="window.close()">
                    <style>
                        .receipt-wrap {
                            font-family: 'Courier New', monospace;
                            font-size: 12px;
                            margin: 0 auto;
                            padding: 20px;
                            width: 300px;
                            background: #fff;
                            border: 1px solid #ddd;
                        }
                        .receipt-header { text-align: center; margin-bottom: 15px; }
                        .receipt-header h2 { margin: 0; font-size: 16px; }
                        .receipt-header p { margin: 2px 0; font-size: 11px; }
                        .separator { border-top: 1px dashed #000; margin: 10px 0; }
                        .receipt-wrap table { width: 100%; border-collapse: collapse; }
                        .receipt-wrap th, .receipt-wrap td { padding: 3px 0; }
                        .items-table th, .items-table td { border-bottom: 1px dashed #ccc; }
                        .items-table th { text-align: left; }
                        .text-right { text-align: right; }
                        .totals-table td:first-child { text-align: right; padding-right: 10px; }
                        .totals-table td { font-weight: bold; }
                        .footer { text-align: center; margin-top: 20px; border-top: 1px solid #000; padding-top: 5px; font-size: 11px; }
                    </style>

                    <div id="exampl" class="receipt-wrap">
                        <?php
                        $invid = intval($_GET['invoiceid']);
                        $branding_query = mysqli_query($con, "select * from branding where id=1");
                        $branding_row = mysqli_fetch_array($branding_query);

                        // Fetch invoice data.
                        $invoice_query = mysqli_query($con, "
                            SELECT i.PostingDate, i.tax, i.total, i.received_amount, i.customer_phone, i.payment_method, c.Name as CustomerName, c.MobileNumber, c.Email
                            FROM tblinvoice i
                            LEFT JOIN tblcustomers c ON i.Userid = c.ID
                            WHERE i.BillingId = '$invid'
                            LIMIT 1
                        ");
                        $invoiceData = mysqli_fetch_array($invoice_query);
                        ?>
                        <div class="receipt-header">
                            <h2><?php echo $branding_row['brand_name']; ?></h2>
                            <p><?php echo nl2br($branding_row['address']); ?></p>
                            <p>Phone: <?php echo $branding_row['phone_no']; ?></p>
                            <p>Email: <?php echo $branding_row['company_email']; ?></p>
                            <div class="separator"></div>
                            <p><strong>Invoice: #<?php echo $invid; ?></strong></p>
                            <p>Date: <?php echo date('d-m-Y H:i', strtotime($invoiceData['PostingDate'])); ?></p>
                        </div>

                        <table class="items-table">
                            <thead>
                                <tr>
                                    <th>Item</th>
                                    <th class="text-right">Qty</th>
                                    <th class="text-right">Price</th>
                                    <th class="text-right">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            $items_query = mysqli_query($con, "
                                SELECT s.ServiceName, i.qty, s.Cost
                                FROM tblinvoice i
                                JOIN tblservices s ON i.ServiceId = s.ID
                                WHERE i.BillingId = '$invid'
                            ");
                            $subtotal = 0;
                            while($item = mysqli_fetch_array($items_query)) {
                                $item_total = $item['qty'] * $item['Cost'];
                                $subtotal += $item_total;
                            ?>
                                <tr>
                                    <td><?php echo $item['ServiceName']; ?></td>
                                    <td class="text-right"><?php echo $item['qty']; ?></td>
                                    <td class="text-right"><?php echo number_format($item['Cost'], 0); ?></td>
                                    <td class="text-right"><?php echo number_format($item_total, 2); ?></td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                        <div class="separator"></div>
                        
                        <table class="totals-table">
                            <tr><td>Subtotal:</td><td class="text-right">LKR <?php echo number_format($subtotal, 0); ?></td></tr>
                            <?php
                                $grand_total = $invoiceData['total'];
                                $tax_val = $invoiceData['tax'];
                                $payment_method = $invoiceData['payment_method'];
                                $received_amount = $invoiceData['received_amount'];
                                $tax_query = mysqli_query($con, "SELECT name FROM tbl_tax WHERE value = '" . $tax_val . "' LIMIT 1");
                                $tax_row = mysqli_fetch_array($tax_query);
                                $tax_name = ($tax_row) ? $tax_row['name'] : 'Tax';
                                $net_amount = $grand_total / (1 + ($tax_val / 100));
                                $tax_amount = $grand_total - $net_amount;
                                $discount = $subtotal - $net_amount;
                                if($discount < 0) $discount = 0;
                                $discount_percent = ($subtotal > 0) ? round(($discount / $subtotal) * 100) : 0;
                                $change = $received_amount - $grand_total;
                            ?>
                            <tr><td>Discount (<?php echo $discount_percent; ?>%):</td><td class="text-right">LKR <?php echo number_format($discount, 0); ?></td></tr>
                            <tr><td><strong>Grand Total:</strong></td><td class="text-right"><strong>LKR <?php echo number_format($grand_total, 2); ?></strong></td></tr>
                            <tr><td>Amount Paid (<?php echo $payment_method; ?>):</td><td class="text-right">LKR <?php echo number_format($received_amount, 2); ?></td></tr>
                            <tr><td>Change:</td><td class="text-right">LKR <?php echo number_format($change, 2); ?></td></tr>
                        </table>
                        <div class="footer"><p>Thank you for your business!</p></div>
                    </div>
</body>

</html>
<!--  Author Name: Mayuri K. 
 for any PHP, Wordpress, Shopify or Laravel website or software development contact me at work@mayurik.com  -->
<?php }  ?>