<?php
session_start();
include "../constant.php";

function fetchPaymentDetails($payment_id) {
    global $key, $secret_key;
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, 'https://api.razorpay.com/v1/payments/' . $payment_id);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
    curl_setopt($ch, CURLOPT_USERPWD, $key . ':' . $secret_key);

    $result = curl_exec($ch);

    if (curl_errno($ch)) {
        echo 'Error:' . curl_error($ch);
    }

    curl_close($ch);

    $payment_details = json_decode($result, true);

    return $payment_details;
}


if (isset($_POST['payment_id'])) {
   
    $payment_id = $_POST['payment_id'];
    $payment_details = fetchPaymentDetails($payment_id);

    if ($payment_details && isset($payment_details['amount'])) {
        $amount = $payment_details['amount'];
        if (isset($_POST['userid'], $_POST['name'], $_POST['phone'], $_POST['email'], $_POST['address'], $_POST['country'], $_POST['pin'])) {
          
            $userId = $_POST['userid'];
            $name = $_POST['name'];
            $address = $_POST['address'];
            $country = $_POST['country'];
            $pin = $_POST['pin'];
            $phone = $_POST['phone'];
            $email = $_POST['email'];
            
        $delivery = "Pending Confirmation";
        $payment_status = "Success"; 

        $totalAmount = 0;
        foreach ($_SESSION['cart'] as $key => $value) {
            $totalAmount += $value['totalPrice'];
        }
print_r($_POST);

        $sql = "INSERT INTO `orders` (customer_id,customer_name, delivery_address, country, pin, phone, email, delivery_status, payment_method, payment_status, payload, total_amount, date) 
                VALUES ('$userId','$name', '$address', '$country', '$pin', '$phone', '$email', '$delivery', 'online', '$payment_status','$payment_id', '$totalAmount', NOW())";

        if (mysqli_query($conn, $sql)) {

            $orderId = mysqli_insert_id($conn);
            foreach ($_SESSION['cart'] as $key => $value) {
                $productName = mysqli_real_escape_string($conn, $value['name']);
                $qty = $value['quantity'];
                $amount = $value['totalPrice'];
                $size = mysqli_real_escape_string($conn, $value['size']);
                $sku = mysqli_real_escape_string($conn, $value['sku']);

         print_r($value);
            
                $itemSql = "INSERT INTO items (order_id, product_name, qty, amount, size, sku) 
                            VALUES ('$orderId', '$productName', '$qty', '$amount', '$size', '$sku')";
                mysqli_query($conn, $itemSql);
            }


            echo "Order placed successfully.";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
        
        unset($_SESSION['cart']);
    } else {
        echo "Error: Failed to fetch payment details from Razorpay.";
    }
} else {
    echo "Error: Payment ID not provided.";
}
}

mysqli_close($conn);
?>
