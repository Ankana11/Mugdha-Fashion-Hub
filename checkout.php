<?php

session_start();
$_SESSION['location'] ='checkout.php';
if ((!isset($_SESSION["user"]["email"]) || $_SESSION["user"]["email"] == '')) {
    include 'login.php';
   
}else{
    include 'checkoutpage.php';
}
?>