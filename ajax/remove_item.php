<?php
session_start();

if(isset($_GET['key'])) {
    $key = $_GET['key'];
    unset($_SESSION['cart'][$key]);
}

header('Location: ../cart.php'); 
?>
