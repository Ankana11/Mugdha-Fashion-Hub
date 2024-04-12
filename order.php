<?php
@session_start();
include 'constant.php';
$errormsg="";
if(isset($_SESSION['user']['email'])) {
    $user_email = $_SESSION['user']['email'];

    $user_query = "SELECT * FROM user WHERE email = '$user_email'";
    $user_result = mysqli_query($conn, $user_query);

    if(mysqli_num_rows($user_result) > 0) {
        $user_row = mysqli_fetch_assoc($user_result);
        $user_id = $user_row['id'];

        $orders_query = "SELECT * FROM orders WHERE customer_id = $user_id";
        $orders_result = mysqli_query($conn, $orders_query);

        if(mysqli_num_rows($orders_result) > 0) {
            $orders = array();
            while($order_row = mysqli_fetch_assoc($orders_result)) {
                $orders[] = $order_row;
            }
        } else {
            $orders = NULL;
        }
    } else {
        echo "User not found.";
    }
} else {
    $errormsg= "User not logged in.";
}
?>

<!DOCTYPE html>
<html lang="zxx">
<head>
    <?php include "layout/header.php"; ?>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
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
                        <h2>My Orders</h2>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->
    <div class="container mt-4">
    <?php if(isset($_SESSION['user']['email']) && !empty($_SESSION['user']['email'])) { ?>
        <?php if ($orders !== NULL) { ?>
        <div class="table-responsive">

            <table class="table mt-4 mb-5">
                <thead>
                    <tr>
                        <th scope="col">Order Id</th>
                        <th scope="col">Total Amount</th>
                        <th scope="col">Delivery Status</th>
                        <th scope="col">Date</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($orders as $order): ?>
                    <tr>
                        <td><?php echo $order['id']?></td>
                        <td><?php echo $order['total_amount']?></td>
                        <td><?php echo $order['delivery_status']?></td>
                        <td><?php echo $order['date']?></td>
                        <td><a href="item.php?id=<?php echo $order['id']?>" class="btn btn-sm btn-success">Detail</a></td>
                    </tr>
                    <?php endforeach; ?>
                      </tbody>
                     </table>
                    </div>
                    <?php } else { ?>
                        <h3 class="text-center mb-5">No orders found.</h3>
                    <?php } ?>
                <?php } else { ?>
                    <h3 class="text-center mb-5">Please login to see your orders</h3>
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
