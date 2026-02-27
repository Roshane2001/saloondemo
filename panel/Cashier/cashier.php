<?php
session_start();
error_reporting(0);
include('../includes/dbconnection.php');
if (strlen($_SESSION['bpmsaid'])==0) {
  header('location:../logout.php');
  } else{

    $tax_query = mysqli_query($con, "SELECT * FROM tbl_tax WHERE delete_status='0' ORDER BY id DESC LIMIT 1");
    $tax_res = mysqli_fetch_array($tax_query);
    $tax_val = $tax_res['value'];
    $tax_name = $tax_res['name'];
  ?>
<!DOCTYPE HTML>
<html>
<head>
<title>Cashier POS</title>
<base href="../">
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
<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!--//Metis Menu -->
<style>
    /* Modern POS Dashboard Styles */
    .pos-dashboard {
        padding: 20px;
        background-color: #fff;
        min-height: 85vh;
    }
    .cbp-spmenu-push div#page-wrapper {
        margin: 0 !important;
    }
    button#showLeftPush {
        display: none !important;
    }
    
    /* Category Filter Bar */
    .category-filter-bar {
        display: flex;
        gap: 12px;
        overflow-x: auto;
        padding: 10px 5px 20px 5px;
        margin-bottom: 10px;
        -webkit-overflow-scrolling: touch;
        scrollbar-width: none; /* Firefox */
    }
    .category-filter-bar::-webkit-scrollbar {
        display: none; /* Chrome/Safari */
    }
    
    .cat-pill {
        background: #ffffff;
        border: 1px solid #e8e8e8;
        border-radius: 30px;
        padding: 10px 24px;
        font-size: 14px;
        font-weight: 600;
        color: #6c757d;
        cursor: pointer;
        white-space: nowrap;
        transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
        box-shadow: 0 2px 6px rgba(0,0,0,0.02);
    }
    
    .cat-pill:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 12px rgba(0,0,0,0.08);
        color: #2e4758;
    }
    
    .cat-pill.active {
        background: #2e4758;
        color: #ffffff;
        border-color: #2e4758;
        box-shadow: 0 4px 10px rgba(46, 71, 88, 0.3);
    }

    /* Grid Layout */
    .pos-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
        gap: 24px;
        padding-bottom: 40px;
    }

    /* Food/Service Card */
    .pos-card {
        background: #ffffff;
        border-radius: 16px;
        overflow: hidden;
        border: 1px solid #f0f0f0;
        box-shadow: 0 4px 20px rgba(0,0,0,0.03);
        transition: all 0.3s ease;
        position: relative;
        display: flex;
        flex-direction: column;
        cursor: pointer;
    }
    
    .pos-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 30px rgba(0,0,0,0.08);
    }

    .card-img-wrap {
        height: 160px;
        width: 100%;
        background-color: #f8f9fa;
        position: relative;
        overflow: hidden;
    }
    
    .card-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }
    
    .pos-card:hover .card-img {
        transform: scale(1.08);
    }

    .status-badge {
        position: absolute;
        top: 12px;
        right: 12px;
        background: rgba(40, 167, 69, 0.95);
        color: white;
        font-size: 11px;
        font-weight: 700;
        padding: 4px 10px;
        border-radius: 20px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        z-index: 2;
    }

    .card-content {
        padding: 16px;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
    }

    .card-title {
        font-size: 16px;
        font-weight: 700;
        color: #333;
        margin-bottom: 6px;
        line-height: 1.4;
    }

    .card-desc {
        font-size: 12px;
        color: #888;
        margin-bottom: 12px;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        flex-grow: 1;
    }

    .card-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: auto;
    }

    .price-tag {
        font-size: 18px;
        font-weight: 800;
        color: #2e4758;
    }

    .add-btn {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        background: #f0f2f5;
        color: #2e4758;
        border: none;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.2s;
    }
    
    .add-btn:hover {
        background: #2e4758;
        color: #fff;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .pos-grid {
            grid-template-columns: repeat(auto-fill, minmax(160px, 1fr));
            gap: 15px;
        }
        .card-img-wrap {
            height: 120px;
        }
        .card-content {
            padding: 12px;
        }
        .card-title {
            font-size: 14px;
        }
        .price-tag {
            font-size: 16px;
        }
    }
    
    /* Cart Panel Styles */
    .cart-panel {
        background: #fff;
        min-height: 85vh;
        padding: 15px;
        border-left: 1px solid #eee;
    }
    .cart-item {
        padding: 10px 0;
        border-bottom: 1px dashed #eee;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .item-details h5 {
        font-size: 14px;
        margin: 0 0 5px;
    }
    .qty-btn {
        padding: 0 5px;
        background: #eee;
        border: none;
        border-radius: 3px;
    }
    .remove-btn {
        color: red;
        cursor: pointer;
        margin-left: 10px;
    }
    .cart-controls {
        display: flex;
        align-items: center;
    }
    
    /* Enhanced Cart Panel */
    .cart-items-container {
        height: 40vh;
        overflow-y: auto;
        margin-bottom: 15px;
        border-top: 1px solid #eee;
        border-bottom: 1px solid #eee;
    }
    .payment-methods button {
        margin-right: 5px;
        margin-bottom: 5px;
    }
    .payment-methods button.active {
        background-color: #2e4758;
        color: #fff;
    }
    .billing-summary-panel {
        background-color: #f9f9f9;
        padding: 10px;
        border-radius: 5px;
    }
    .customer-info-panel {
        background-color: #f0f4f7;
        padding: 10px;
        border-radius: 5px;
        margin-bottom: 10px;
    }
    .action-buttons .btn {
        margin-bottom: 5px;
    }
    .input-group-text {
        font-size: 0.8rem;
    }
    #amountReceived {
        font-weight: bold;
        font-size: 1.1rem;
    }
</style>
</head> 
<body class="cbp-spmenu-push">
	<div class="main-content">
		<!-- header-starts -->
	 <?php include_once('../includes/header.php');?>
		<!-- //header-ends -->
		<!-- main content start-->
		<div id="page-wrapper">
			<div class="main-page">
                <div class="row">
                    <div class="col-md-9">
                <div class="pos-dashboard">
                    <!-- Category Filter -->
                    <div class="category-filter-bar">
                        <button class="cat-pill active" onclick="filterSelection('all', this)">All</button>
                        <?php
                        $ret=mysqli_query($con,"select * from tbl_category where status='1'");
                        while ($row=mysqli_fetch_array($ret)) {
                        ?>
                        <button class="cat-pill" onclick="filterSelection('<?php echo $row['id'];?>', this)"><?php echo $row['name'];?></button>
                        <?php } ?>
                    </div>

                    <!-- Items Grid -->
                    <div class="pos-grid">
                        <?php
                        $ret=mysqli_query($con,"select * from tblservices");
                        while ($row=mysqli_fetch_array($ret)) {
                        ?>
                        <div class="pos-card filterDiv <?php echo $row['cate_id'];?>" onclick="addToCart(<?php echo $row['ID'];?>, '<?php echo htmlspecialchars(addslashes($row['ServiceName']));?>', <?php echo $row['Cost'];?>)">
                            <div class="card-img-wrap">
                                <img src="images/<?php echo $row['Image'];?>" class="card-img" alt="<?php echo $row['ServiceName'];?>">
                                <span class="status-badge">Available</span>
                            </div>
                            <div class="card-content">
                                <h3 class="card-title"><?php echo $row['ServiceName'];?></h3>
                                <p class="card-desc"><?php echo $row['Description'];?></p>
                                <div class="card-footer">
                                    <span class="price-tag">LKR<?php echo number_format($row['Cost'], 0);?></span>
                                    <button class="add-btn" title="Add to Cart">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                </div>
                    </div>
                    <div class="col-md-3">
                        <div class="cart-panel">
                            
                            <!-- 1. Order Cart Section -->
                            <h5 class="mb-2">Order Cart</h5>
                            <div id="cartItems" class="cart-items-container">
                                <div class="text-center text-muted mt-5">Cart is empty</div>
                            </div>

                            <!-- 3. Billing Summary Panel -->
                            <div class="billing-summary-panel">
                                <div class="d-flex justify-content-between"><span>Subtotal:</span> <span id="subTotal">LKR0.00</span></div>
                                <div class="d-flex justify-content-between align-items-center mt-1">
                                    <span>Discount (%):</span>
                                    <input type="number" id="discountInput" class="form-control form-control-sm" style="width: 60px; text-align: right;" value="0" min="0" max="100" oninput="updateTotals()">
                                </div>
                                <hr style="margin: 5px 0;">
                                <div class="d-flex justify-content-between" style="font-size: 1.2em; color: #2e4758;"><strong>Grand Total:</strong> <strong id="grandTotal">LKR0.00</strong></div>
                            </div>

                            <!-- 4. Payment Section -->
                            <div class="payment-section mt-3">
                                <h5>Payment</h5>
                                <div class="payment-methods mb-2">
                                    <button class="btn btn-default btn-sm active" onclick="selectPaymentMethod(this, 'Cash')">Cash</button>
                                    <button class="btn btn-default btn-sm" onclick="selectPaymentMethod(this, 'Card')">Card</button>
                                    <button class="btn btn-default btn-sm" onclick="selectPaymentMethod(this, 'Online')">Online</button>
                                    <button class="btn btn-default btn-sm" onclick="selectPaymentMethod(this, 'Split')">Split</button>
                                </div>
                                <div class="form-group mb-2">
                                    <input type="number" id="amountReceived" class="form-control" placeholder="Amount Received" oninput="calculateBalance()">
                                </div>
                                <div class="d-flex justify-content-between mb-3">
                                    <span>Balance / Change:</span> <span id="balanceAmount" style="font-weight:bold; color: green;">LKR0.00</span>
                                </div>
                            </div>

                            <!-- 5. Action Buttons -->
                            <div class="action-buttons row">
                                <div class="col-md-6" style="padding-right: 5px;"><button class="btn btn-success btn-block" onclick="processPayment()"><i class="fa fa-check"></i> Confirm</button></div>
                                <div class="col-md-6" style="padding-left: 5px;"><button class="btn btn-info btn-block" onclick="printReceipt()"><i class="fa fa-print"></i> Print</button></div>
                                <div class="col-md-12 mt-2"><button class="btn btn-danger btn-block" onclick="clearCart()"><i class="fa fa-times"></i> Cancel</button></div>
                            </div>
                        </div>
                    </div>
                </div>
			</div>
		</div>
		 <?php include_once('../includes/footer.php');?>
	</div>
	<!-- Classie -->
		<script src="js/classie.js"></script>
		<script>
			var menuLeft = document.getElementById( 'cbp-spmenu-s1' ),
				showLeftPush = document.getElementById( 'showLeftPush' ),
				body = document.body;
				
			showLeftPush.onclick = function() {
				classie.toggle( this, 'active' );
				classie.toggle( body, 'cbp-spmenu-push-toright' );
				classie.toggle( menuLeft, 'cbp-spmenu-open' );
				disableOther( 'showLeftPush' );
			};
			
			function disableOther( button ) {
				if( button !== 'showLeftPush' ) {
					classie.toggle( showLeftPush, 'disabled' );
				}
			}
		</script>
	
<script>
    let cart = [];
    let currentPaymentMethod = 'Cash';
    let lastInvoiceId = null;

    function filterSelection(category, element) {
        const cards = document.getElementsByClassName('pos-card');
        if (category === 'all') {
            for (let i = 0; i < cards.length; i++) {
                cards[i].style.display = 'flex';
            }
        } else {
            for (let i = 0; i < cards.length; i++) {
                if (cards[i].classList.contains(category)) {
                    cards[i].style.display = 'flex';
                } else {
                    cards[i].style.display = 'none';
                }
            }
        }
        
        const pills = document.getElementsByClassName('cat-pill');
        for (let i = 0; i < pills.length; i++) {
            pills[i].classList.remove('active');
        }
        element.classList.add('active');
    }

    function addToCart(id, name, price) {
        const existingItem = cart.find(item => item.id === id);
        if (existingItem) {
            existingItem.qty++;
        } else {
            cart.push({ id: id, name: name, price: price, qty: 1 });
        }
        renderCart();
        updateTotals();
    }

    function removeFromCart(id) {
        cart = cart.filter(item => item.id !== id);
        renderCart();
        updateTotals();
    }

    function updateQty(id, change) {
        const item = cart.find(item => item.id === id);
        if (item) {
            item.qty += change;
            if (item.qty <= 0) {
                removeFromCart(id);
            } else {
                renderCart();
                updateTotals();
            }
        }
    }

    function renderCart() {
        const cartContainer = document.getElementById('cartItems');
        if (cart.length === 0) {
            cartContainer.innerHTML = '<div class="text-center text-muted mt-5">Cart is empty</div>';
            return;
        }
        let html = '';
        cart.forEach(item => {
            html += `
                <div class="cart-item">
                    <div class="item-details" style="flex-grow: 1;">
                        <h5 class="mb-0" style="margin-bottom: 0;">${item.name}</h5>
                        <small class="text-muted">LKR${item.price.toFixed(2)} x ${item.qty}</small>
                    </div>
                    <div class="cart-controls">
                        <button class="qty-btn" onclick="updateQty(${item.id}, -1)">-</button>
                        <span class="mx-2" style="margin: 0 8px;">${item.qty}</span>
                        <button class="qty-btn" onclick="updateQty(${item.id}, 1)">+</button>
                        <span class="ml-3 font-weight-bold" style="margin-left: 12px; font-weight: bold;">LKR${(item.price * item.qty).toFixed(2)}</span>
                        <i class="fa fa-trash remove-btn" onclick="removeFromCart(${item.id})"></i>
                    </div>
                </div>
            `;
        });
        cartContainer.innerHTML = html;
    }

    function updateTotals() {
        let subtotal = 0;
        cart.forEach(item => {
            subtotal += item.price * item.qty;
        });

        const discountPercent = parseFloat(document.getElementById('discountInput').value) || 0;
        const discountAmount = subtotal * (discountPercent / 100);
        const grandTotal = subtotal - discountAmount;

        document.getElementById('subTotal').innerText = 'LKR' + subtotal.toFixed(2);
        document.getElementById('grandTotal').innerText = 'LKR' + grandTotal.toFixed(2);
        
        calculateBalance();
    }

    function selectPaymentMethod(btn, method) {
        currentPaymentMethod = method;
        const buttons = document.querySelectorAll('.payment-methods button');
        buttons.forEach(b => b.classList.remove('active'));
        btn.classList.add('active');
    }

    function calculateBalance() {
        const grandTotalText = document.getElementById('grandTotal').innerText.replace('LKR', '');
        const grandTotal = parseFloat(grandTotalText) || 0;
        const received = parseFloat(document.getElementById('amountReceived').value) || 0;
        const balance = received - grandTotal;
        
        const balanceEl = document.getElementById('balanceAmount');
        balanceEl.innerText = 'LKR' + balance.toFixed(2);
        if (balance < 0) {
            balanceEl.style.color = 'red';
        } else {
            balanceEl.style.color = 'green';
        }
    }

    function clearCart() {
        Swal.fire({
            title: 'Are you sure?',
            text: "This will clear the entire cart. This action cannot be undone.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, clear it!'
        }).then((result) => {
            if (result.isConfirmed) {
                cart = [];
                lastInvoiceId = null;
                renderCart();
                updateTotals();
                document.getElementById('amountReceived').value = '';
                document.getElementById('discountInput').value = 0;
                calculateBalance();
            }
        })
    }

    function processPayment() {
        if (cart.length === 0) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Cart is empty!',
            });
            return;
        }
        
        const grandTotalText = document.getElementById('grandTotal').innerText.replace('LKR', '');
        const grandTotal = parseFloat(grandTotalText);
        const received = parseFloat(document.getElementById('amountReceived').value) || 0;

        if (currentPaymentMethod === 'Cash' && received < grandTotal) {
            Swal.fire({
                icon: 'error',
                title: 'Insufficient Payment',
                text: 'Amount received is less than the grand total.',
            });
            return;
        }

        Swal.fire({
            title: "Enter Customer Phone No",
            input: "text",
            inputAttributes: {
                autocapitalize: "off",
                placeholder: "Phone Number"
            },
            showCancelButton: true,
            confirmButtonText: "Submit Order",
            showLoaderOnConfirm: true,
            preConfirm: async (phone) => {
                const orderData = {
                    items: cart,
                    subtotal: parseFloat(document.getElementById('subTotal').innerText.replace('LKR', '')),
                    discount: parseFloat(document.getElementById('discountInput').value) || 0,
                    tax: 0,
                    taxRate: 0,
                    grandTotal: grandTotal,
                    paymentMethod: currentPaymentMethod,
                    amountReceived: received,
                    customerPhone: phone
                };

                try {
                    const response = await $.ajax({
                        url: 'Cashier/save_order.php',
                        type: 'POST',
                        data: JSON.stringify(orderData),
                        contentType: 'application/json'
                    });
                    
                    if (response.status !== 'success') {
                        throw new Error(response.message || 'Unknown error');
                    }
                    return response;
                } catch (error) {
                    Swal.showValidationMessage(
                        `Request failed: ${error}`
                    );
                }
            },
            allowOutsideClick: () => !Swal.isLoading()
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: 'Success!',
                    text: 'Order processed successfully! Invoice #' + result.value.invoice_id,
                    icon: 'success',
                    confirmButtonText: 'OK'
                });
                lastInvoiceId = result.value.invoice_id; // Store invoice ID for printing
            }
        });
    }
    
    function printReceipt() {
        if (cart.length === 0) {
            Swal.fire('Cart is empty!', 'Cannot print a receipt for an empty cart.', 'warning');
            return;
        }
        if (lastInvoiceId === null) {
            Swal.fire('Payment Not Confirmed', 'Please confirm the payment first to generate an invoice ID for the receipt.', 'warning');
            return;
        }

        const brandName = "<?php echo addslashes($branding_row['brand_name']); ?>";
        const address = "<?php echo addslashes($branding_row['address']); ?>";
        const phone = "<?php echo addslashes($branding_row['phone_no']); ?>";
        const email = "<?php echo addslashes($branding_row['company_email']); ?>";

        let receiptContent = `
            <html>
            <head>
                <title>Receipt - ${lastInvoiceId}</title>
                <style>
                    body { font-family: 'Courier New', monospace; font-size: 12px; margin: 0; padding: 20px; width: 300px; }
                    .receipt-header { text-align: center; margin-bottom: 15px; }
                    .receipt-header h2 { margin: 0; font-size: 16px; }
                    .receipt-header p { margin: 2px 0; font-size: 11px; }
                    .separator { border-top: 1px dashed #000; margin: 10px 0; }
                    table { width: 100%; border-collapse: collapse; }
                    th, td { padding: 3px 0; }
                    .items-table th, .items-table td { border-bottom: 1px dashed #ccc; }
                    .items-table th { text-align: left; }
                    .text-right { text-align: right; }
                    .totals-table td:first-child { text-align: right; padding-right: 10px; }
                    .totals-table td { font-weight: bold; }
                    .footer { text-align: center; margin-top: 20px; border-top: 1px solid #000; padding-top: 5px; font-size: 11px; }
                </style>
            </head>
            <body>
                <div class="receipt-header">
                    <h2>${brandName}</h2>
                    <p>${address.replace(/\r\n|\r|\n/g, '<br>')}</p>
                    <p>Phone: ${phone}</p>
                    <p>Email: ${email}</p>
                    <div class="separator"></div>
                    <p><strong>Invoice: #${lastInvoiceId}</strong></p>
                    <p>Date: ${new Date().toLocaleString()}</p>
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
        `;

        cart.forEach(item => {
            receiptContent += `
                <tr>
                    <td>${item.name}</td>
                    <td class="text-right">${item.qty}</td>
                    <td class="text-right">${item.price.toFixed(0)}</td>
                    <td class="text-right">${(item.price * item.qty).toFixed(2)}</td>
                </tr>
            `;
        });

        const subtotal = parseFloat(document.getElementById('subTotal').innerText.replace('LKR', ''));
        const discountPercent = parseFloat(document.getElementById('discountInput').value) || 0;
        const discountAmount = subtotal * (discountPercent / 100);

        receiptContent += `
                    </tbody>
                </table>
                <div class="separator"></div>
                <table class="totals-table">
                    <tr><td>Subtotal:</td><td class="text-right">LKR ${subtotal.toFixed(0)}</td></tr>
                    <tr><td>Discount (${discountPercent}%):</td><td class="text-right">LKR ${discountAmount.toFixed(0)}</td></tr>
                    <tr><td><strong>Grand Total:</strong></td><td class="text-right"><strong>${document.getElementById('grandTotal').innerText}</strong></td></tr>
                    <tr><td>Amount Paid (${currentPaymentMethod}):</td><td class="text-right">LKR ${parseFloat(document.getElementById('amountReceived').value || 0).toFixed(2)}</td></tr>
                    <tr><td>Change:</td><td class="text-right">${document.getElementById('balanceAmount').innerText}</td></tr>
                </table>
                <div class="footer"><p>Thank you for your business!</p></div>
            </body>
            </html>
        `;

        const receiptWindow = window.open('', 'Print Receipt', 'height=600,width=400');
        receiptWindow.document.write(receiptContent);
        receiptWindow.document.close();
        receiptWindow.focus();
        receiptWindow.print();
    }
</script>
</body>
</html><!--  Author Name: Mayuri K. 
 for any PHP, Wordpress, Shopify or Laravel website or software development contact me at work@mayurik.com  -->
<?php } ?>