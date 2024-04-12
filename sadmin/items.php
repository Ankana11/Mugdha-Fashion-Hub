<?php
include 'layout/sessioncheck.php';
include '../constant.php';
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
    } 
}
$sql = "SELECT * FROM `orders` WHERE id = $order_id"; 
$result = mysqli_query($conn, $sql);
if (!$result) {
    echo "Query failed: " . mysqli_error($conn);
} else {
    $order = mysqli_fetch_assoc($result);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $order_id = $_POST["order_id"];
    $delivery_status = $_POST["delivery_status"];

    $sql = "UPDATE orders SET delivery_status = '$delivery_status' WHERE id = $order_id";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        echo "Delivery status updated successfully.";
        header("Location: order.php");
        
    } else {
        echo "Error updating delivery status: " . mysqli_error($conn);
    }
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "layout/header.php"; ?>
    <style type="text/css">
        .btn {
            cursor: pointer;
        }

        .row {
            padding-top: 12px;
        }

        .container-fluid {
            width: 100%;
            padding-right: 20px;
            padding-left: 20px;
            margin-right: auto;
            margin-left: auto;
        }

        .col-md-6 {
            width: 50%;
            float: left;
        }
    </style>
</head>

<body class="fixed-nav sticky-footer bg-dark" id="page-top">

    <?php include "layout/menu.php"; ?>

    <script type="text/javascript">
        $("#order").addClass("active");
    </script>
    <div class="content-wrapper">

        <div class="container">
            <?php
            if (isset($_SESSION['successmsg'])) {
                echo '<div class="alert alert-success" role="alert">' . $_SESSION['successmsg'] . '</div>';
                unset($_SESSION['successmsg']);
            }
            ?>
            <div class="row">
                <div class="col-md-6">
                    <h5>Order Details</h5>
                    <table class="table">
                       <tr>
                            <td><b>Customer_id:</b></td>
                            <td><?php echo $order['customer_id']?></td>
                        </tr>
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
                    <h5>Product Details</h5>
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
                                        <td><?= $item['amount'] ?></td>
                                       
                                    </tr>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <tr>
                                    <td colspan="6">No items found</td>
                                </tr>
                            <?php endif; ?>
                            <tr>
                            <td colspan="5">
                            <form method="post" action="">
                    <select class="form-select form-control" name="delivery_status">
                    <option <?php if ($order['delivery_status'] == 'Pending Confirmation') echo 'selected'; ?>>Pending Confirmation</option>
                    <option <?php if ($order['delivery_status'] == 'Shipped') echo 'selected'; ?>>Shipped</option>
                    <option <?php if ($order['delivery_status'] == 'Out For Delivery') echo 'selected'; ?>>Out For Delivery</option>
                    <option <?php if ($order['delivery_status'] == 'Delivered') echo 'selected'; ?>>Delivered</option>
                    </select>

                                <input type="hidden" name="order_id" value="<?php echo $order_id; ?>">
                                <div class="text-center mt-3">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </form>

                            </td>
                        </tr>
                        
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <?php include "layout/footer.php"; ?>

</body>

</html>
