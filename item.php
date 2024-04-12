<?php
@session_start();
include 'constant.php';
$successmsg = "";
$errormsg = "";
$uploadOk = 1;
 
if (isset($_GET['id'])) {
    $order_id = $_GET['id'];

    $sql1 = "SELECT * FROM items WHERE order_id = $order_id";
    $run = mysqli_query($conn, $sql1);

    if ($run && mysqli_num_rows($run) > 0) {
        $items = array();

       
        while ($row = mysqli_fetch_assoc($run)) {
            $items[] = $row;
        }
    } else{
        $items = NULL;
    }
}
$sql = "SELECT * FROM `orders` WHERE id = $order_id"; 
$result = mysqli_query($conn, $sql);
if (!$result) {
    echo "Query failed: " . mysqli_error($conn);
} else {
    $order = mysqli_fetch_assoc($result);
}


?>

<!DOCTYPE html>
<html lang="zxx">
<head>
    <?php include "layout/header.php"; ?>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <style>
        .hh-grayBox {
	background-color: #F8F8F8;
	margin-bottom: 20px;
	padding: 35px;
  margin-top: 20px;
}
.pt45{padding-top:45px;}
.order-tracking{
	text-align: center;
	width: 33.33%;
	position: relative;
	display: block;
}
.order-tracking .is-complete{
	display: block;
	position: relative;
	border-radius: 50%;
	height: 30px;
	width: 30px;
	border: 0px solid #AFAFAF;
	background-color: #f7be16;
	margin: 0 auto;
	transition: background 0.25s linear;
	-webkit-transition: background 0.25s linear;
	z-index: 2;
}
.order-tracking .is-complete:after {
	display: block;
	position: absolute;
	content: '';
	height: 14px;
	width: 7px;
	top: -2px;
	bottom: 0;
	left: 5px;
	margin: auto 0;
	border: 0px solid #AFAFAF;
	border-width: 0px 2px 2px 0;
	transform: rotate(45deg);
	opacity: 0;
}
.order-tracking.completed .is-complete{
	border-color: #27aa80;
	border-width: 0px;
	background-color: #27aa80;
}
.order-tracking.completed .is-complete:after {
	border-color: #fff;
	border-width: 0px 3px 3px 0;
	width: 7px;
	left: 11px;
	opacity: 1;
}
.order-tracking p {
	color: #A4A4A4;
	font-size: 16px;
	margin-top: 8px;
	margin-bottom: 0;
	line-height: 20px;
}
.order-tracking p span{font-size: 14px;}
.order-tracking.completed p{color: #000;}
.order-tracking::before {
	content: '';
	display: block;
	height: 3px;
	width: calc(100% - 40px);
	background-color: #f7be16;
	top: 13px;
	position: absolute;
	left: calc(-50% + 20px);
	z-index: 0;
}
.order-tracking:first-child:before{display: none;}
.order-tracking.completed:before{background-color: #27aa80;}

    </style>
</head>
<body>
    <div id="preloder">
        <div class="loader"></div>
    </div>
    <?php include "layout/menu.php"; ?>
    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg " style="background-blend-mode: darken; background: rgba(0, 0, 0, 0.7); background-repeat: no-repeat; background-size: cover;" data-setbg="img/order.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>My Items</h2>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->
    <div class="container mt-4">
    <?php if(isset($_SESSION['user']['email']) && !empty($_SESSION['user']['email'])) { ?>
        <?php if ($items !== NULL) { ?>
    <div class="row">
                <div class="col-md-6">
                    <h5 class="mt-2 mb-2">Order Details</h5>
                    <table class="table">
                       <tr>
                            <td><b>Customer Name:</b></td>
                            <td><?php echo $order['customer_name']?></td>
                        </tr>
                       <tr>
                            <td><b>Amount:</b></td>
                            <td><?php echo $order['total_amount']?></td>
                        </tr>
                       <tr>
                            <td><b>Delivery Address:</b></td>
                            <td><?php echo $order['delivery_address']?></td>
                        </tr>
                       <tr>
                            <td><b>Pin:</b></td>
                            <td><?php echo $order['pin']?></td>
                        </tr>
                       <tr>
                            <td><b>Phone:</b></td>
                            <td><?php echo $order['phone']?></td>
                        </tr>
                       <tr>
                            <td><b>Email:</b></td>
                            <td><?php echo $order['email']?></td>
                        </tr>
                      
                    </table>
                </div>
                <div class="col-md-6">
                    <h5 class="mt-2 mb-2">Product Details</h5>
                    <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>Name</th>
                                <th>SKU</th>
                                <th>Quantity</th>
                                <th>Size</th>
                                <th>Amount</th>
                               
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($items)) : ?>
                                <?php foreach ($items as $item) : ?>
                                    <tr>
                                        <td><?= $item['order_id'] ?></td>
                                        <td><?= $item['product_name'] ?></td>
                                        <td><?= $item['sku'] ?></td>
                                        <td><?= $item['qty'] ?></td>
                                        <td><?= $item['size'] ?></td>
                                        <td>Rs.<?= $item['amount'] ?>/-</td>
                                       
                                    </tr>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <tr>
                                    <td colspan="6">No items found</td>
                                </tr>
                            <?php endif; ?>
                           
                        
                        </tbody>
                     <tfoot>
                        <tr>
                            <td colspan="5"><b>Total Amount:</b></td>
                            <td>Rs.<?php echo $order['total_amount']?>/-</td>
                        </tr>
                    </tfoot>
                    </table>
                    </div>
            <div class="row justify-content-between mb-3">
               
                <div class="order-tracking<?= $order['delivery_status'] == 'Shipped' || $order['delivery_status'] == 'Out For Delivery' || $order['delivery_status'] == 'Delivered' ? ' completed' : '' ?>">
                <span class="is-complete"></span>
                    <p>Shipped</p>
                </div>
                <div class="order-tracking<?= $order['delivery_status'] == 'Out For Delivery' || $order['delivery_status'] == 'Delivered' ? ' completed' : '' ?>">
                    <span class="is-complete"></span>
                    <p>Out For Delivery</p>
                </div>
                <div class="order-tracking<?= $order['delivery_status'] == 'Delivered' ? ' completed' : '' ?>">
                    <span class="is-complete"></span>
                    <p>Delivered</p>
                </div>
             </div>
         
				</div>
                </div>
            </div>
            <?php } else { ?>
                        <h3 class="text-center mb-5">No Items found.</h3>
                    <?php } ?>
                <?php } else { ?>
                    <h3 class="text-center mb-5">Please login to see your items</h3>
                <?php } ?>
    </div>
   
    <?php include "layout/footer.php"; ?>
    <script type="text/javascript">
  $(document).ready(function() {
    
      $(".order").addClass("active");
});
   
   </script>
</body>
</html>
