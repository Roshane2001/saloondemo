<?php
session_start();
error_reporting(0);
include('../includes/dbconnection.php');

if(strlen($_SESSION['bpmsaid'])==0){
    header('location:../logout.php');
    exit();
}

$invid = intval($_GET['invoiceid']);
?>

<!DOCTYPE html>
<html>
<head>
<title>Print Receipt</title>
<style>
/* ======================================
   EPSON TM-T81III RECEIPT CSS
   80mm THERMAL PRINTER OPTIMIZED
====================================== */

/* PAPER SIZE */
@page {
    size: 80mm auto;
    margin: 0;
}

/* RESET */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

/* BODY */
body {
    font-family: "Courier New", monospace;
    font-size: 12px;
    width: 72mm;          /* Printable area */
    margin: 0 auto;
    color: #000;
}

/* RECEIPT CONTAINER */
#receipt-content {
    width: 72mm;
    padding: 5px;
}

/* HEADER */
.receipt-header {
    text-align: center;
}

.receipt-header h2 {
    font-size: 16px;
    font-weight: bold;
}

.receipt-header p {
    font-size: 11px;
}

/* DASH LINE */
.separator {
    border-top: 1px dashed #000;
    margin: 6px 0;
}

/* TABLE */
table {
    width: 100%;
    border-collapse: collapse;
}

/* ITEMS TABLE */
.items-table th,
.items-table td {
    padding: 3px 0;
    font-size: 12px;
}

.items-table th {
    border-bottom: 1px dashed #000;
}

/* ALIGNMENT */
.text-right {
    text-align: right;
}

/* TOTAL SECTION */
.totals-table {
    margin-top: 5px;
}

.totals-table td {
    padding: 2px 0;
    font-weight: bold;
}

.totals-table td:first-child {
    text-align: left;
}

.totals-table td:last-child {
    text-align: right;
}

/* FOOTER */
.footer {
    text-align: center;
    margin-top: 8px;
    font-size: 11px;
    border-top: 1px dashed #000;
    padding-top: 5px;
}

/* PRINT SETTINGS */
@media print {
    body {
        width: 280px;   /* Browser safe width */
        margin: 0;
    }
    #receipt-content {
        width: 280px;
    }
}
</style>
</head>

<body>

<div id="receipt-content">

<?php
$brand_query = mysqli_query($con, "SELECT * FROM branding LIMIT 1");
$brand = mysqli_fetch_array($brand_query);

$invoice_query = mysqli_query($con, "
    SELECT PostingDate, total, received_amount, payment_method, discount, tax, customer_phone
    FROM tblinvoice
    WHERE BillingId='$invid'
    LIMIT 1
");
$invoice = mysqli_fetch_array($invoice_query);
?>

<div class="receipt-header">
    <h2><?php echo $brand['brand_name']; ?></h2>
    <p><?php echo nl2br($brand['address']); ?></p>
    <p>Tel: <?php echo $brand['phone_no']; ?></p>
    <div class="separator"></div>
    <p><strong>Invoice #<?php echo $invid;?></strong></p>
    <p>Date: <?php echo date('d-m-Y H:i', strtotime($invoice['PostingDate'])); ?></p>
    <?php if (!empty($invoice['customer_phone'])) : ?>
    <p>Customer Phone: <?php echo $invoice['customer_phone']; ?></p>
    <?php endif; ?>
</div>

<div class="separator"></div>

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
    <?php
        $discount_percent = $invoice['discount'];
        $discount_amount = $subtotal * ($discount_percent / 100);
        $tax_percent = $invoice['tax'];
        $subtotal_after_discount = $subtotal - $discount_amount;
        $tax_amount = $subtotal_after_discount * ($tax_percent / 100);
        $grand_total = $invoice['total']; // Use the stored grand total
        $received_amount = $invoice['received_amount'];
        $change = $received_amount - $grand_total;
    ?>
    <tr>
        <td>Subtotal:</td>
        <td>LKR <?php echo number_format($subtotal, 2); ?></td>
    </tr>
    <?php if ($discount_amount > 0): ?>
    <tr>
        <td>Discount (<?php echo $discount_percent; ?>%):</td>
        <td>-LKR <?php echo number_format($discount_amount, 2); ?></td>
    </tr>
    <?php endif; ?>
    <?php if ($tax_amount > 0): ?>
    <tr>
        <td>Tax (<?php echo $tax_percent; ?>%):</td>
        <td>LKR <?php echo number_format($tax_amount, 2); ?></td>
    </tr>
    <?php endif; ?>
    <tr>
        <td><strong>Grand Total:</strong></td>
        <td><strong>LKR <?php echo number_format($grand_total, 2); ?></strong></td>
    </tr>
    <tr>
        <td>Paid (<?php echo $invoice['payment_method']; ?>):</td>
        <td>LKR <?php echo number_format($received_amount, 2); ?></td>
    </tr>
    <tr>
        <td>Change:</td>
        <td>LKR <?php echo number_format($change, 2); ?></td>
    </tr>
</table>

<div class="footer">
    <p>Thank you for your business!</p>
</div>

</div>
<script>
    window.onload = function() {
        window.print();
        setTimeout(function() {
            fetch('../cut.php');
            window.close();
        }, 1000);
    };
</script>
</body>
</html>