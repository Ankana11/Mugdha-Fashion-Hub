<?php
@session_start();
include 'constant.php';
// print_r($_SESSION['cart']);
// print_r($_SESSION['user']);
?>

<!DOCTYPE html>
<html lang="zxx">
 <head>
 <?php include "layout/header.php";
?>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <style>
    .card-body {
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      text-align: center;
    }
  </style>
  
 </head>
 <body>
 <div id="preloder">
        <div class="loader"></div>
    </div>
 <?php include "layout/menu.php";
?>
<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-section set-bg " style="background-blend-mode: darken; background: rgba(0, 0, 0, 0.7); background-repeat: no-repeat; background-size: cover;" data-setbg="img/breadcrumb.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Oreder Received</h2>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->
<div class="container mt-4 mb-5">



<div class="card">
  <h5 class="card-header"></h5>
  <div class="card-body">
    <h2 class="card-title text-center">Thank You!For Shoping With Us</h2>
    <p class="card-text text-center">Your Order Was Completed Successfully!</p>
    <a href="index.php" class="btn site-btn">Continue Your Shopping</a>
  </div>
</div>

</div>
   
  <?php include "layout/footer.php";
?>

 
 </body>
</html>


