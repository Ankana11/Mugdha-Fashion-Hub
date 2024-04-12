<?php
session_start();
include 'constant.php';
if(isset($_GET['id'])) {
  $id = $_GET['id'];
  $sql = "SELECT * FROM school WHERE id = $id";
  $result = mysqli_query($conn, $sql);
  if(mysqli_num_rows($result) > 0) {
      $school = mysqli_fetch_assoc($result);
  } else {
      echo "No record found with the provided ID.";
      exit; 
  }
} 
$inventory=[];
if(isset($school)) {
    $schoolId = $school['id'];
    $sql = "SELECT * FROM inventory WHERE schoolid = $schoolId AND active=0";
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            $inventory[] = $row;
        }
    }
  }


?>

<!DOCTYPE html>
<html lang="zxx">
<head>
    <?php include "layout/header.php"; ?>
    <style>
        .oldprice {
            color: #EA2E49;
            font-size: 18px;
            text-decoration: line-through;
        }

        .currentprice {
            font-weight: 700;
            font-family: "Montserrat";
            font-style: normal;
            font-size: 22px;
            text-transform: none;
            color: rgb(51, 55, 69);
            padding-left: 8px;
        }

        .product-entry-wrapper {
            width: 100%;
            min-height: 300px;
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .product-entry-wrapper:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        .product-entry-wrapper .prod-img img {
            height: 250px;
            width: 100%;
            object-fit: cover;
            border-radius: 10px;
        }

        .product-entry-wrapper .desc {
            margin-top: 20px;
        }

        .product-entry-wrapper .desc p {
            margin-bottom: 5px;
        }

        .product-entry-wrapper .price {
            font-size: 16px;
            font-weight: 500;
        }
    </style>
</head>
<body>
<div id="preloder">
    <div class="loader"></div>
</div>
<?php include "layout/menu.php"; ?>
<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-section set-bg " style="background-blend-mode: darken; background: rgba(0, 0, 0, 0.7); background-repeat: no-repeat; background-size: cover;"
         data-setbg="img/try.jpg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="breadcrumb__text">
                    <h2>Dresses</h2>
                    <div class="breadcrumb__option">
                        <a href="./index.php">Shop</a>
                        <a href="./detail.php">details</a>
                        <span><?php echo $school['schoolname'] ?></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->
<!-- Product Details Section Begin -->
<section class="product-details spad">
    <div class="container">
        <p><?php echo $school['schoolname'] ?>'s Uniforms</p>
        <hr>
        <div class="row row-pb-md">
            <?php foreach ($inventory as $item): ?>
                <div class="col-lg-3 mb-5 text-center">
                    <div class="product-entry border product-entry-wrapper">
                        <a href="product.php?id=<?php echo $item['id']; ?>" class="prod-img">
                            <img src="sadmin/image/<?php echo $item['photo']; ?>" class="img-fluid"
                                 alt="Product Image">
                        </a>
                        <hr>
                        <div class="desc">
                            <p><?php echo $item['name'] ?></p>
                            <p class="price" name="sale"></p>
                            <span class="oldprice">Rs.<?php echo $item['price'] ?></span>
                            <b><span class="currentprice">Rs.<?php echo $item['saleprice'] ?></span></b>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php include "layout/footer.php"; ?>
</body>
</html>
