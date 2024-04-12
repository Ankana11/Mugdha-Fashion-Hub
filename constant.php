<?php

$severname = "localhost";
$username = "root";
$password = "";
$db = "ecommerce";

$conn = mysqli_connect ($severname , $username , $password , $db); 


// Razorpay keys----
// For test credentials------
$key='rzp_test_OM08EjjiG3F8AZ';
$secret_key='iRrG0Zz8zB7wPSXldILw5bhH';

// For live credentials------
// $key='rzp_live_QTUdtTEj8GL67P';
// $secret_key='NbFXwK80ABu16bVvv4NqnFzB';

?>