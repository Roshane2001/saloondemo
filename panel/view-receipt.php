<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

if(strlen($_SESSION['bpmsaid'])==0){
    header('location:logout.php');
    exit();
}

$invid = intval($_GET['invoiceid']);
?>

<!DOCTYPE html>
<html>
<head>
<title>Print Receipt</title>

<style>

/* ===============================
   EPSON TM-T81III RECEIPT STYLE
================================ */

@page{
    size:80mm auto;
    margin:0;
}

body{
    font-family:"Courier New", monospace;
    font-size:12px;
    width:72mm;
    margin:0 auto;
}

#receipt{
    width:72mm;
    padding:5px;
}

.center{text-align:center;}
.right{text-align:right;}

.separator{
    border-top:1px dashed #000;
    margin:6px 0;
}

table{
    width:100%;
    border-collapse:collapse;
}

td{
    padding:2px 0;
}

.footer{
    text-align:center;
    margin-top:10px;
    margin-bottom:35px; /* cutter space */
}

@media print{
    body{width:280px;}
    #receipt{width:280px;}
}

</style>
</head>

<body onload="printReceipt()">

<div id="receipt">

<?php
$brand=mysqli_fetch_array(
mysqli_query($con,"SELECT * FROM branding LIMIT 1")
);
?>

<div class="center">
<h3><?php echo $brand['brand_name']; ?></h3>
<p><?php echo nl2br($brand['address']); ?></p>
<p>Tel: <?php echo $brand['phone_no']; ?></p>

<div class="separator"></div>

<b>Invoice #<?php echo $invid;?></b><br>

<?php
$invoice=mysqli_fetch_array(mysqli_query($con,"
SELECT PostingDate,total,received_amount,payment_method
FROM tblinvoice
WHERE BillingId='$invid'
LIMIT 1
"));
?>

Date:
<?php echo date('d-m-Y H:i',
strtotime($invoice['PostingDate'])); ?>

</div>

<div class="separator"></div>

<table>

<?php
$items=mysqli_query($con,"
SELECT s.ServiceName,i.qty,s.Cost
FROM tblinvoice i
JOIN tblservices s ON s.ID=i.ServiceId
WHERE i.BillingId='$invid'
");

$subtotal=0;

while($row=mysqli_fetch_array($items)){

$itemTotal=$row['qty']*$row['Cost'];
$subtotal+=$itemTotal;
?>

<tr>
<td><?php echo $row['ServiceName'];?></td>
<td class="right"><?php echo number_format($itemTotal,2);?></td>
</tr>

<?php } ?>

</table>

<div class="separator"></div>

<table>
<tr>
<td><b>TOTAL</b></td>
<td class="right">
<b>LKR <?php echo number_format($subtotal,2);?></b>
</td>
</tr>

<tr>
<td>Paid (<?php echo $invoice['payment_method'];?>)</td>
<td class="right">
LKR <?php echo number_format($invoice['received_amount'],2);?>
</td>
</tr>

<tr>
<td>Change</td>
<td class="right">
LKR <?php
echo number_format(
$invoice['received_amount']-$subtotal,2);
?>
</td>
</tr>

</table>

<div class="footer">
Thank You Come Again!
</div>

</div>

<script>

function printReceipt(){

    window.print();

    setTimeout(function(){

        /* SEND CUT COMMAND */
        fetch("cut.php");

        window.close();

    },1000);
}

</script>

</body>
</html>
