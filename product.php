<?php
session_start();
include 'constant.php';
$alert='';
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM inventory WHERE id = $id";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        $school = mysqli_fetch_assoc($result);

        $variant_sql = "SELECT * FROM varient WHERE product_id = $id";
        $variant_result = mysqli_query($conn, $variant_sql);
        $sizes_array = array();
        if (mysqli_num_rows($variant_result) > 0) {
            while ($row = mysqli_fetch_assoc($variant_result)) {
                $sizes_array[] = $row;
            }
        }
    } else {
        echo "No record found with the provided ID.";
        exit;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_to_cart'])) {
    if (!isset($_POST['size']) || $_POST['size'] == "Choose...") {
        // echo '<script>alert("Please choose a size.");</script>';
        $alert = '<div class="alert alert-danger" role="alert">Please choose a size.</div>';
    } else {
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = array();
        }
        $id = $_GET['id'];
        $_SESSION['cart'][$id]['name'] = $school['name'];
        $_SESSION['cart'][$id]['photo'] = $school['photo'];
        $_SESSION['cart'][$id]['sku'] = $school['sku'];
        $_SESSION['cart'][$id]['id'] = $id;
        $_SESSION['cart'][$id]['size'] = $_POST['size'];
        $_SESSION['cart'][$id]['quantity'] = $_POST['quantity'];
        $_SESSION['cart'][$id]['selected_saleprice'] = $_POST['saleprice'];
        header("Location: cart.php");
        exit;
    }
}

// print_r($_SESSION);

?>

<!DOCTYPE html>
<html lang="zxx">
<head>
<?php include "layout/header.php"; ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
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
        font-size: 28px;
        text-transform: none;
        color: rgb(51, 55, 69);
        padding-left: 8px;
    }

    .select {
        background-color: #fff;
        border-radius: 5px;
        border: solid 1px #e8e8e8;
        box-sizing: border-box;
        clear: both;
        cursor: pointer;
        font-family: inherit;
        font-size: 14px;
        font-weight: normal;
        height: 31px;
        line-height: 40px;
        outline: none;
        padding-left: 18px;
        padding-right: 30px;
        position: relative;
        text-align: left !important;
    }
</style>
</head>
<body>
<div id="preloder">
    <div class="loader"></div>
</div>
<?php include "layout/menu.php"; ?>
<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-section set-bg "
         style="background-blend-mode: darken; background: rgba(0, 0, 0, 0.7); background-repeat: no-repeat; background-size: cover;"
         data-setbg="img/try.jpg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="breadcrumb__text">
                    <h2>Shopping</h2>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->

<!-- Product Details Section Begin -->
<section class="product-details spad">
    <div class="container">
        <form method="post">
        <?php echo $alert; ?>
            <div class="row g-2">
                <div class="col-lg-6 col-md-6">
                    <div class="product__details__pic">
                        <div class="product__details__pic__item">
                            <img src="sadmin/image/<?php echo $school['photo']; ?>"
                                 class="product__details__pic__item--large" alt="Product Image">
                        </div>
                        <div class="product__details__pic__slider owl-carousel">
                                <?php
                                $product_images = $school['product_image']; 
                                $images = explode(",", $product_images); 
                                foreach ($images as $image) {
                                    $image_path = "sadmin/product_images/" . $image;
                                ?>
                                <img data-imgbigurl="<?= $image_path ?>" src="<?= $image_path ?>" alt="">
                                <?php } ?>
                            </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="product__details__text">
                        <h3><?php echo $school['name']; ?></h3>
                        <input type="hidden" value="<?php echo $school['sku']; ?>">

                        <span class="oldprice" id="price">Rs.<?php echo $school['price']?></span>
                        <b><span class="currentprice" id="saleprice">Rs.<?php echo $school['saleprice']?></span></b>
                        <p>This price is inclusive of all Taxes</p>
                    <div class="input-group mb-3">

                    <input type="hidden" name="price" id="selected_price" value="">
                    <input type="hidden" name="saleprice" id="selected_saleprice" value="">

                    <label class="input-group-text" for="inputGroupSelect01">Size</label>
                    <select class="form-select" id="inputGroupSelect01" name="size" onchange="updatePrice(this)">
                        <option selected>Choose...</option>
                        <?php 
                        foreach ($sizes_array as $size_item) {
                            echo "<option value='".$size_item['size']."' data-price='".$size_item['price']."' data-saleprice='".$size_item['saleprice']."'>".$size_item['size']."</option>";
                        }
                        ?>
                    </select>

                    </div>
                        <div class="product__details__quantity">
                            <div class="quantity">
                                <div class="pro-qty">
                                    <input type="text" value="1" name="quantity">
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="primary-btn" name="add_to_cart">ADD TO CART</button>
                        <ul>
                            <li><b>Availability</b> <span>In Stock</span></li>
                            <li><b>Description</b> <span><?php echo $school['description']?></span></li>
                           
                        </ul>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>
<!-- Product Details Section End -->
<?php include "layout/footer.php"; ?>
                    
<script>
    function updatePrice(select) {

        var price = select.options[select.selectedIndex].getAttribute('data-price');
        var saleprice = select.options[select.selectedIndex].getAttribute('data-saleprice');

        document.getElementById('price').innerText = "Rs." + price;
        document.getElementById('saleprice').innerText = "Rs." + saleprice;

        document.getElementById('selected_price').value = price;
        document.getElementById('selected_saleprice').value = saleprice;
    }

</script>
</body>
</html>
