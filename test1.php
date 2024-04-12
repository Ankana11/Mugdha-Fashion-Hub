<?php
// session_start();
// echo "<pre>";
// print_r($_SESSION);
?>



<?php
$ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, 'https://api.razorpay.com/v1/payments/pay_NxHPTxZGOIJW8g' );
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
    curl_setopt($ch, CURLOPT_USERPWD, 'rzp_test_OM08EjjiG3F8AZ' . ':' . 'iRrG0Zz8zB7wPSXldILw5bhH'); 
   

    $result = curl_exec($ch);

    if (curl_errno($ch)) {
        echo 'Error:' . curl_error($ch);
    }

    curl_close($ch);

    $payment_details = json_decode($result, true);

    print_r($result);
    ?>