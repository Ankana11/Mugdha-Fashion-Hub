<?php
session_start();
include 'constant.php';
$grandtotal = 0;

if(isset($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $key => $value) {
        $schoolName = $value['name'];
        $photo = $value['photo'];
        $saleprice = $value['selected_saleprice'];
        $size = $value['size']; 
        $sku = $value['sku']; 
        $quantity = $value['quantity'];
       
        
        $totalPrice = $saleprice * $quantity;
        $grandtotal += $totalPrice; 
        
        $_SESSION['cart'][$key]['totalPrice'] = $totalPrice;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['quantity'])) {
    foreach ($_POST['quantity'] as $key => $value) {
        $_SESSION['cart'][$key]['quantity'] = $value;
        $_SESSION['cart'][$key]['totalPrice'] = $value * $_SESSION['cart'][$key]['selected_saleprice'];
    }
    header("Location: " . $_SERVER['PHP_SELF']); 
    exit();
}
// echo "<pre>";
// print_r($_SESSION);
?>

<!DOCTYPE html>
<html>
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
    <section class="breadcrumb-section set-bg " style="background-blend-mode: darken; background: rgba(0, 0, 0, 0.7); background-repeat: no-repeat; background-size: cover;" data-setbg="img/try.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Shopping Cart</h2>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Shopping Cart Section Begin -->
    <section class="shoping-cart spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <?php if(isset($_SESSION['cart']) && !empty($_SESSION['cart'])) { ?>
                    <div class="shoping__cart__table">
                        <table>
                            <thead>
                                <tr>
                                    <th class="shoping__product">Products</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($_SESSION['cart'] as $key => $value) { ?>
                                    <tr>
                                        <td class="shoping__cart__item">
                                            <img src="sadmin/image/<?php echo $value['photo']; ?>" alt="" height="100" width="100">
                                            <h5><?php echo $value['name']; ?></h5>
                                        </td>
                                        <td class="shoping__cart__price">
                                            Rs.<?php echo $value['selected_saleprice']; ?>/-
                                        </td>
                                        <td class="shoping__cart__quantity">
                                    <div class="input-group" style="max-width: 150px; margin-left:20px;height: 36px;">
                                        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                                            <input type="number" name="quantity[<?php echo $key; ?>]" value="<?php echo $value['quantity']; ?>" min="1" class="" style="width: 40px;">
                                            <span class="input-group-btn">
                                                <button type="submit" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Update Quantity" style="padding: 0.375rem 0.75rem;font-size: 1rem;line-height: 0.5;"><i class="fa fa-refresh"></i></button>
                                            </span>
                                        </form>
                                    </div>
                                </td>
                                <div class="total" style="max-width: 150px; margin-left:20px;" >
                                        <td class="shoping__cart__price">
                                            Rs.<?php echo $value['totalPrice']; ?>/-
                                        </td>
                                        </div>
                                        <td class="shoping__cart__item__close">
                                            <span class="icon_close" onclick="removeItem(<?php echo $key; ?>)"></span> 
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                    <?php } else { ?>
                        <h3 class="text-center">Your Cart Is Empty</h3>
                    <?php } ?>
                </div>
                <div class="col-lg-6">
                    <?php if(isset($_SESSION['cart']) && !empty($_SESSION['cart'])) { ?>
                    <div class="shoping__checkout">
                        <h5>Cart Total</h5>
                        <ul>
                            <li>Total <span>Rs.<?php echo $grandtotal; ?>/-</span></li>
                        </ul>
                        <a href="checkout.php" class="primary-btn">PROCEED TO CHECKOUT</a>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </section>
    <!-- Shopping Cart Section End -->
  
    <?php include "layout/footer.php"; ?>
  
    <script>
        function removeItem(key) {
            if (confirm("Are you sure you want to remove this item?")) {
                window.location.href = 'ajax/remove_item.php?key=' + key;
            }
        }
    </script>
</body>
</html>
