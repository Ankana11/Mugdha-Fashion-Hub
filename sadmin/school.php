<?php
include 'layout/sessioncheck.php';
include '../constant.php';

$uploadOk = 1;
$successmsg = "";
$errormsg = "";
$institute = "";
$id="";

if (isset($_REQUEST['btnSubmit'])) {
    $institute = $_REQUEST['institute'];
    $id = $_REQUEST['id'];
    if ($institute != "") {
        
        if (isset($_FILES["fileToUpload"])) {
            $target_dir = "image/";
            $filename = basename($_FILES["fileToUpload"]["name"]);

            $filenamearr = explode(".", $filename);
            $filename = time() . "." . $filenamearr[count($filenamearr) - 1];
            $target_file = $target_dir . $filename;
            $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);

            if (file_exists($target_file)) {
                $errormsg = "Sorry, file already exists.";
                $uploadOk = 0;
            }

            if ($_FILES["fileToUpload"]["size"] > 204800) {
                $errormsg = "Please upload a file less than 200KB.";
                $uploadOk = 0;
            }

            if (strtolower($imageFileType) != "jpg") {
                $errormsg = "Sorry, only JPG files are allowed.";
                $uploadOk = 0;
            }

            if ($uploadOk == 0) {
               
            } else {
                if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                    $query = mysqli_query($conn, "INSERT INTO  school SET photo='$filename', schoolname='$institute'");
                    $successmsg = "School name inserted successfully";
                } 
            }
        }else {
                   
                    $query = mysqli_query($conn, "UPDATE school SET schoolname='$institute' WHERE id='$id'");
                    $successmsg = "School name updated successfully";
                }
            }
            else{
              $errormsg="Plse fillup all fields.";
            }
            }

if (isset($_REQUEST['id'])) {
    $id = $_REQUEST['id'];
    if ($id != "") {
        $courses_selectquery = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `school` WHERE id='$id'"));
        $photo = $courses_selectquery['photo'];
        $institute = $courses_selectquery['schoolname'];
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
        $("#coursespromotion").addClass("active");
    </script>
    <div class="content-wrapper">

        <div class="container-fluid">
        <?php
    if ($errormsg!="") {
      ?>
      <div class="alert alert-danger" role="alert">
        <?=$errormsg?>
      </div>
    <?php
    }if ($successmsg!="") {
      ?>
      <div class="alert alert-success" role="alert">
        <?=$successmsg?>
      </div>
    <?php
    }
    ?>
            <form action="" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?=$id?>">
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="">School Name</label>
                        <input type="text" class="form-control" name="institute" value="<?=$institute?>" placeholder="Enter Your School Name" required="">
                    </div>
                </div>
                <?php
  if ($id=="") {
    ?>
    <div class="col-md-6">
    <label for="formFile" class="form-label">Select your School image</label>
    <input class="form-control mb-2" type="file" id="formFile" name="fileToUpload" required="">
</div>
           
                <?php
  }
                ?>
                <input type="submit" class="btn btn-primary m-3" value="Submit" name="btnSubmit">
            </form>
        </div>
    </div>
    <?php include "layout/footer.php"; ?>

</body>

</html>
