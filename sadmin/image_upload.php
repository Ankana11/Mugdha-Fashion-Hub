<?php
include 'layout/sessioncheck.php';
include '../constant.php';
$successmsg = "";
$errormsg = "";
$uploadOk = 1;

$product_id = isset($_GET['id']) ? $_GET['id'] : null;

if (isset($_POST['btnSubmit'])) {

   
    if (isset($_FILES["fileToUpload"])) {
        $target_dir = "image/";
        $filename = basename($_FILES["fileToUpload"]["name"]);

        $filenamearr = explode(".", $filename);
        $filename = time() . "." . $filenamearr[count($filenamearr) - 1];
        $target_file = $target_dir . $filename;
        $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);

        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            $photo = $filename;
        } else {
            $errormsg = "Error uploading main product image.";
        }
    }

   
    if (isset($_FILES['multiplefile']) && is_array($_FILES['multiplefile']['tmp_name'])) {
        $location = "product_images/";
        $uploaded_file_names = [];

        foreach ($_FILES['multiplefile']['tmp_name'] as $key => $tmp_name) {
            $file_name = $_FILES['multiplefile']['name'][$key];
            $target_path = $location . $file_name;
            if (move_uploaded_file($tmp_name, $target_path)) {
                $uploaded_file_names[] = $file_name;
            } else {
                $errormsg = "Error uploading additional product images.";
            }
        }

        $product_images = implode(",", $uploaded_file_names);
    }

    $query = "UPDATE inventory SET photo = '$photo', product_image = '$product_images' WHERE id = '$product_id'";

    if (mysqli_query($conn, $query)) {
        $_SESSION['successmsg'] = "Data and Image inserted successfully";
        header("Location: manageinventory.php");
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
            

                <div class="row">
                    
                    <div class="col-md-6">
                        <label for="formFile" class="form-label">Select Main Product Image</label>
                        <input class="form-control mb-2" type="file" id="formFile" name="fileToUpload" required="">
                    </div>
                    <div class="col-md-12">
                        <label for="formFile1" class="form-label">Select Additional Product Image</label>
                        <input class="form-control mb-2" type="file" id="formFile1" name="multiplefile[]" multiple required="">
                    </div>
                    

                </div>
                <input type="submit" class="btn btn-primary m-3" value="Submit" name="btnSubmit">
            </form>
        </div>
    </div>
    <?php include "layout/footer.php"; ?>

<script>
    $(document).ready(function() {
 
    $('#formFile').on('change', function() {
        var fileInput = this;
        var file = fileInput.files[0];

        if (file.size > 200 * 1024) {
            alert('Image size must be 200KB.');
            fileInput.value = '';
            return false;
        }

        if (!file.type.match('image/jpeg')) {
            alert('Image must be in JPEG format.');
            fileInput.value = '';
            return false;
        }

        var img = new Image();
        img.onload = function() {
            if (img.width !== img.height) {
                alert('Image width and height must be equal.');
                fileInput.value = '';
                return false;
            }
        };

        if (file) {
            img.src = URL.createObjectURL(file);
        }
    });

    $('#formFile1').on('change', function() {
        var fileInput = this;
        var files = fileInput.files;

        for (var i = 0; i < files.length; i++) {
            var file = files[i];

            if (file.size > 200 * 1024) {
                alert('Image size must be less than 200KB.');
                fileInput.value = '';
                return false;
            }

            if (!file.type.match('image/jpeg')) {
                alert('Image must be in JPEG format.');
                fileInput.value = '';
                return false;
            }

            var img = new Image();
            img.onload = function() {
                if (img.width !== img.height) {
                    alert('Image must be square. Equal width and height.');
                    fileInput.value = '';
                    return false;
                }
            };

            if (file) {
                img.src = URL.createObjectURL(file);
            }
        }
    });
});

</script>
    
</body>

</html> 
