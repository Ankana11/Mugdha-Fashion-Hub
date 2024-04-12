<?php
include 'layout/sessioncheck.php';
include '../constant.php';
$successmsg = "";
$errormsg = "";
$uploadOk = 1;
if(isset($_GET['id'])) {
    $dress_id = $_GET['id'];
}

$name= "SELECT * FROM inventory where id=$dress_id";
$run= mysqli_query($conn,$name);


if(mysqli_num_rows($run)>0){
    while ($row = mysqli_fetch_assoc($run)) {
       $photo=$row['photo'];
       $name=$row['name'];
    }
}
if(isset($_POST['btnSubmit'])) {
    $size = $_POST['size'];
    $price = $_POST['price'];
    $sale = $_POST['sale'];

    $sql= "INSERT INTO varient SET product_id= '$dress_id', size='$size', price='$price', saleprice='$sale'";
    $result= mysqli_query($conn,$sql);

    if($result) {
        $_SESSION['successmsg']= "Size Inserted successfully";
        header("Location: {$_SERVER['REQUEST_URI']}");
        exit();
    } else {
        echo "Not inserted";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "layout/header.php"; ?>
    <style type="text/css">
        .btn {
            cursor: pointer;
        }

        .row {
            padding-top: 12px;
        }

        .container-fluid {
            width: 100%;
            padding-right: 20px;
            padding-left: 20px;
            margin-right: auto;
            margin-left: auto;
        }
    </style>
</head>

<body class="fixed-nav sticky-footer bg-dark" id="page-top">

    <?php include "layout/menu.php"; ?>

    <script type="text/javascript">
        $("#inventory").addClass("active");
    </script>
    <div class="content-wrapper">

    <div class="container">
    <?php
    if (isset($_SESSION['successmsg'])) {
        echo '<div class="alert alert-success" role="alert">' . $_SESSION['successmsg'] . '</div>';
        unset($_SESSION['successmsg']);
    }
    ?>
            <form action="" method="POST" enctype="multipart/form-data">
            <div class="course-item" style="width: 100%;">
    <img src="image/<?=$photo?>" style="height: 250px;"  class="img-fluid" alt="...">
    <div class="course-content">
      <p class="ml-5"><b><?=$name?></b><br>
      </p>
    </div>
  </div>
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="">Size </label>
                        <input type="text" class="form-control" name="size" placeholder="Enter the dresses size" required="">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="">Price </label>
                        <input type="text" class="form-control" name="price" placeholder="Price" required="">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="">Sale Price </label>
                        <input type="text" class="form-control" name="sale" placeholder="Sale Price" required="">
                    </div>
                </div>
                <input type="submit" class="btn btn-primary m-3" value="Submit" name="btnSubmit">
            </form>
        </div>
    </div>
    <?php include "layout/footer.php"; ?>
</body>

</html>
