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

if (isset($_GET['id'])) {
    $dress_id = $_GET['id'];
    
    
    $sql1 = "SELECT * FROM inventory WHERE id = $dress_id";
    $run = mysqli_query($conn, $sql1);
    
 
    if ($run && mysqli_num_rows($run) > 0) {
        $row1 = mysqli_fetch_assoc($run); 
    } else {
        
    }
}

$varient_query = "SELECT * FROM varient WHERE product_id = $dress_id";
$varient_result = mysqli_query($conn, $varient_query);

if (isset($_REQUEST['btnSubmit'])) {
    $gender = $_POST['gender'];
    $selectedSchool = $_POST['school'];
    $price = $_POST['price'];
    $sale = $_POST['sale'];
    $name = $_POST['name'];
    $sku = $_POST['sku'];
   
    $desc = $_POST['desc'];
    $schoolId = null;

    foreach ($schools as $school) {
        if ($school['schoolname'] === $selectedSchool) {
            $schoolId = $school['id'];
            break;
        }
    }

    $query = "UPDATE inventory SET schoolid = '$schoolId', gender = '$gender', price = '$price',saleprice = '$sale', name = '$name',description = '$desc', sku = '$sku' WHERE id = $dress_id";

    
    if (mysqli_query($conn, $query)) {
        $_SESSION['successmsg'] = "Data updated successfully";
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
           
            if (isset($_SESSION['successmsg'])) {
                echo '<div class="alert alert-success" role="alert">' . $_SESSION['successmsg'] . '</div>';
              
                unset($_SESSION['successmsg']);
            }
            ?>
            <form action="" method="POST" enctype="multipart/form-data">
                           
                <div class="form-group">
                    <label class="mr-2">Gender</label>
                    <label class="radio-inline ml2">
                        <input type="radio" name="gender" value="male" <?php echo ($row1['gender'] == 'male') ? 'checked' : ''; ?>> Boys
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="gender" value="female" <?php echo ($row1['gender'] == 'female') ? 'checked' : ''; ?>> Girls
                    </label>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <label for="">Dress Name </label>
                     
                        <input type="text" class="form-control" name="name" placeholder="Name" value="<?php echo $row1['name']?>">
                    </div>
                    <div class="form-group">
                    <label>School</label>
                    <select class="form-select form-control" aria-label="Default select example" name="school">
                        <option selected>Select School</option>
                        <?php foreach ($schools as $school) : ?>
                            <option <?php echo ($row1['schoolid'] == $school['id']) ? 'selected' : ''; ?>><?php echo $school['schoolname']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                    

                    <div class="form-group col-md-6">
                        <label for="">Price </label>
                        <input type="text" class="form-control" name="price" placeholder="Price" value="<?php echo $row1['price']?>">
                    </div>


                    <div class="form-group col-md-6">
                        <label for="">Sale Price </label>
                        <input type="text" class="form-control" name="sale" placeholder="Sale Price" value="<?php echo $row1['saleprice']?>">
                    </div>
                    <div class="form-group col-md-12">
                        <label for="">SKU </label>
                        <input type="text" class="form-control" name="sku" placeholder="SKU" value="<?php echo $row1['sku']?>">
                    </div>
                    <div class="form-group col-md-12">
                        <label for="">Description</label>
                        <input type="text" class="form-control" name="desc" placeholder="Enter Description of your products" value="<?php echo $row1['description']?>">
                    </div>

                </div>
                <input type="submit" class="btn btn-primary m-3" value="Update" name="btnSubmit">
            </form>

            <table class="table">
    <thead>
        <tr>
            <th>Size</th>
            <th>Price</th>
            <th>Sale Price</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($varient_result as $row): ?>
            <tr>
                <td><?php echo $row['size']; ?></td>
                <td><?php echo $row['price']; ?></td>
                <td><?php echo $row['saleprice']; ?></td>
            </tr>
        <?php endforeach; ?>
       
    </tbody>
</table>
<div class="mt-2 mb-3">
<a href="varient.php?id=<?php echo $dress_id; ?>" class="btn btn-primary">View</a>

</div>
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
        }
    });
});

</script>


</body>

</html>
