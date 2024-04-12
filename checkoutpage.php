<?php
@session_start();
include 'constant.php';
global $key;
$_SESSION['location'] ='checkoutpage.php';

if(isset($_SESSION['user']['email'])) {
    $email = $_SESSION['user']['email'];
    
    $sql = "SELECT * FROM `user` WHERE email='$email'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userId = $_POST["user_id"];
    $name = $_POST["name"];
    $address = $_POST["address"];
    $country = $_POST["country"];
    $pin = $_POST["pin"];
    $phone = $_POST["phone"];
    $email = $_POST["email"];
    $delivery = "Pending Confirmation";
    $paymentstatus = "pending";
    
    if (isset($_POST["payment"]) && $_POST["payment"] == "cod") {
        $paymentmethod = "cod";
    } elseif (isset($_POST["paypal"]) && $_POST["paypal"] == "online") {
        $paymentmethod = "online";
    } else {
        echo "<script>alert('Please select a payment mode');</script>";
        exit(); 
    }

   
    $totalAmount = 0;
    foreach ($_SESSION['cart'] as $key => $value) { 
        $totalAmount += $value['totalPrice'];
    }

    
    $sql = "INSERT INTO `orders` (customer_id, customer_name, delivery_address, country, pin, phone, email, delivery_status, payment_method, payment_status,total_amount, date) VALUES ('$userId', '$name', '$address', '$country', '$pin', '$phone', '$email', '$delivery', '$paymentmethod', '$paymentstatus','$totalAmount', NOW())";

    if (mysqli_query($conn, $sql)) {
        $orderId = mysqli_insert_id($conn); 
        // $_SESSION['OID'] = $orderId; 
        foreach ($_SESSION['cart'] as $key => $value) { 
            $productName = $value['name'];
            $qty = $value['quantity'];
            $amount = $value['totalPrice'];
            $size = $value['size'];
            $sku = $value['sku'];
            $itemSql = "INSERT INTO items (order_id, product_name, qty, amount, size, sku) VALUES ('$orderId', '$productName', '$qty', '$amount', '$size', '$sku')";
            mysqli_query($conn, $itemSql);
        }
        
        echo "Order placed successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }


    unset($_SESSION['cart']);

    header('Location: order_complete.php');
    exit();
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
 <section class="breadcrumb-section set-bg " style="background-blend-mode: darken; background: rgba(0, 0, 0, 0.7); background-repeat: no-repeat; background-size: cover;" data-setbg="img/breadcrumb.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Checkout</h2>
                        
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Checkout Section Begin -->
    <section class="checkout spad">
        <div class="container">
            <div class="checkout__form">
                <h4>Shipping Details</h4>
                <form method="post" action="">
                    <div class="row">
                    <div class="col-lg-8 col-md-6">
    <input type="hidden" name="user_id" id="userid" value="<?php echo $row['id']?>">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="checkout__input">
                            <p>Name<span>*</span></p>
                            <input type="text" name="name" id="name" value="<?php echo $row['name']?>" required="">
                        </div>
                    </div>
                </div>

                <div class="checkout__input">
                    <p>Address<span>*</span></p>
                    <input type="text" placeholder="Enter Your Address" class="checkout__input__add" name="address" id="address" value="<?php echo $row['address']?>" required="">
                </div>

                <div class="row">
                    <div class="col-lg-3">
                        <div class="checkout__input">
                            <p>Country<span>*</span></p>
                            <select id="country" class="col-md-6" name="country"  required="">
                                <option>India</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-lg-9">
                        <div class="checkout__input">
                            <p>Pin<span>*</span></p>
                            <input type="number" name="pin" id="pin" value="<?php echo $row['pin']?>" required="">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-6">
                        <div class="checkout__input">
                            <p>Phone<span>*</span></p>
                            <input type="number" name="phone" id="phone" value="<?php echo $row['mobile']?>" required="">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="checkout__input">
                            <p>Email<span>*</span></p>
                            <input type="email" name="email" id="email" value="<?php echo $row['email']?>" required="">
                        </div>
                    </div>
                </div>
                </div>

                        <div class="col-lg-4 col-md-6">
                            <div class="checkout__order">
                                <h4>Your Order</h4>
                                <?php if(isset($_SESSION['cart']) && !empty($_SESSION['cart'])) { ?>
                                <div class="checkout__order__products">Products  <span>Total</span>   <span>Quantity</span> </div>
                                <?php 
                                $gt=0;
                                foreach ($_SESSION['cart'] as $key => $value) { 
                                    $gt += $value['totalPrice'];
                                    ?>
                                <ul>
                                <li><?php echo $value['name']; ?><br>(Size: <?php echo $value['size']; ?>)
                                <span> Rs.<?php echo $value['totalPrice']; ?>/-</span> <span><?php echo $value['quantity']; ?></span></li>
                                </ul>

                                <?php } ?>
                                <div class="checkout__order__subtotal">Total <span name="amt" id="amt">Rs.<?php echo $gt; ?>/-</span></div>

                                <div class="checkout__input__checkbox">
                                <label for="payment">
                                    Cash On Delivery
                                    <input type="checkbox" id="payment" name="payment" value="cod">
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                            <div class="checkout__input__checkbox">
                                <label for="paypal">
                                    Online
                                    <input type="checkbox" id="paypal" name="payment" value="online">
                                    <input type="hidden" name="payment_id" id="payment_id" value="">
                                    <span class="checkmark"></span>
                                </label>
                            </div>

                     <button type="submit" class="site-btn" id="placeorder">PLACE ORDER</button>
                       <button type="button" class="site-btn" id="razorpayButton" style="display: none;" onclick="pay_now()">Pay with Razorpay</button>

                    <?php } else { ?>
                        <h3 class="text-center">Your Cart Is Empty</h3>
                    <?php } ?>
                            </div>

                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!-- Checkout Section End -->
  
  <?php include "layout/footer.php"; ?>
  <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
  <script>

    document.querySelectorAll('input[name="payment"]').forEach(function(element) {
        element.addEventListener('change', function() {
        
            if (element.value === "cod") {
                document.getElementById("placeorder").style.display = "inline-block";
                document.getElementById("razorpayButton").style.display = "none";
            } else if (element.value === "online") {
                document.getElementById("placeorder").style.display = "none";
                document.getElementById("razorpayButton").style.display = "inline-block";
            }
        });
    });

    function pay_now() {
    var userid = jQuery('#userid').val();
    var name = jQuery('#name').val();
    var amt = parseFloat(jQuery('#amt').text().replace('Rs.', '').replace('/-', ''));
    var phone = jQuery('#phone').val();
    var email = jQuery('#email').val();
    var address = jQuery('#address').val();
    var pin = jQuery('#pin').val();
    var country = jQuery('#country').val();

    var options = {
        "key": "rzp_test_OM08EjjiG3F8AZ",
        "amount": amt * 100, 
        "currency": "INR",
        "name": "Mugdha Fashion Hub",
        "description": "Test Transaction",
        "image": "img/icon.png",
        "handler": function (response) {
            jQuery.ajax({
                type: 'post',
                url: 'ajax/payment_process.php',
                data: {
                    "amt": amt,
                    "name": name,
                    "phone": phone,
                    "email": email,
                    "address": address,
                    "pin": pin,
                    "country": country,
                    "userid": userid,
                    "payment_id": response.razorpay_payment_id,
                    "payload": JSON.stringify(response)
                },
                success: function (result) {
                    console.log(result);
                    window.location.href = "order_complete.php";
                }
            });
        }
    };

    var rzp1 = new Razorpay(options);
    rzp1.open();
}

</script>

 </body>
</html>
