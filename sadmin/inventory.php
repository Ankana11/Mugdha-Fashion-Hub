<?php
include 'layout/sessioncheck.php';
include '../constant.php';
$successmsg = "";
$errormsg = "";
$uploadOk = 1;

$sql = "SELECT * FROM school";
$result = mysqli_query($conn, $sql);
$schools = array();

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $schools[] = $row;
    }
}

if (isset($_REQUEST['btnSubmit'])) {
    $gender = $_POST['gender'];
    $selectedSchool = $_POST['school'];
    $price = $_POST['price'];
    $sale = $_POST['sale'];
    $name = $_POST['name'];
    $desc = $_POST['desc'];
    $sku = $_POST['sku'];
    $schoolId = null;

    foreach ($schools as $school) {
        if ($school['schoolname'] === $selectedSchool) {
            $schoolId = $school['id'];
            break;
        }
    }

    $query = "INSERT INTO inventory (schoolid, gender, price, saleprice, name, description, sku)
              VALUES ('$schoolId', '$gender', '$price', '$sale', '$name', '$desc', '$sku')";

    if (mysqli_query($conn, $query)) {
        $lastinsert = mysqli_insert_id($conn);
        $_SESSION['successmsg'] = "Data inserted successfully";
        header("Location: image_upload.php?id=$lastinsert");
        exit();
    } else {
        $errormsg = "Error: " . mysqli_error($conn);
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
    if (!empty($errormsg)) {
        echo '<div class="alert alert-danger" role="alert">' . $errormsg . '</div>';
    }
    ?>
    <?php
    if (isset($_SESSION['successmsg'])) {
        echo '<div class="alert alert-success" role="alert">' . $_SESSION['successmsg'] . '</div>';
        unset($_SESSION['successmsg']);
    }
    ?>
            <form action="" method="POST" enctype="multipart/form-data">
                
                <div class="form-group">
                    <label class="mr-2">Gender</label>
                    <label class="radio-inline ml2">
                        <input type="radio" name="gender" value="male"> Boys
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="gender" value="female"> Girls
                    </label>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label for="">Dress Name </label>
                        <input type="text" class="form-control" name="name" placeholder="Name" required="">
                    </div>

                    <div class="form-group">
                    <label>School</label>
                    <select class="form-select form-control" aria-label="Default select example" name="school">
                        <option selected>Select School</option>
                        <?php foreach ($schools as $school) : ?>
                            <option><?= $school['schoolname'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                   
                    <div class="form-group col-md-6">
                        <label for="">Price </label>
                        <input type="text" class="form-control" name="price" placeholder="Price" required="">
                    </div>


                    <div class="form-group col-md-6">
                        <label for="">Sale Price </label>
                        <input type="text" class="form-control" name="sale" placeholder="Sale Price" required="">
                    </div>
                    <div class="form-group col-md-12">
                        <label for="">SKU </label>
                        <input type="text" class="form-control" name="sku" placeholder="SKU" required="">
                    </div>
                    <div class="form-group col-md-12">
                        <label for="">Description</label>
                        <input type="text" class="form-control" name="desc" placeholder="Enter Description of your products" required="">
                    </div>

                </div>
                <input type="submit" class="btn btn-primary m-3" value="Submit" name="btnSubmit">
            </form>
        </div>
    </div>
    <?php include "layout/footer.php"; ?>


    
</body>

</html>
