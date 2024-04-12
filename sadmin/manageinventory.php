<?php
include 'layout/sessioncheck.php';
include '../constant.php';
$successmsg = "";
$errormsg = "";
$uploadOk = 1;

$sql = "SELECT * FROM inventory where active=0";
$result = mysqli_query($conn, $sql);
$inventoryitems = [];

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $row['product_images'] = explode(",", $row['product_image']);
        
        $inventoryitems[] = $row;
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
            <div class="row">
                <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                              
                                <th>Photo</th>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Sale Price</th>
                                <th>Description</th>
                                <th>Product Images</th>
                              
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($inventoryitems as $key => $item) : ?>
                                <tr>
                                  
                                    <td><img src="image/<?= $item['photo'] ?>" alt="<?= $item['name'] ?>" style="width: 100px;"></td>
                                    <td><?= $item['name'] ?></td>
                                    <td><?= $item['price'] ?></td>
                                    <td><?= $item['saleprice'] ?></td>
                                    <td><?= $item['description'] ?></td>
                                    <td>
                                        <?php foreach ($item['product_images'] as $image) : ?>
                                            <img src="product_images/<?= $image ?>" alt="<?= $image ?>" style="width: 50px;">
                                        <?php endforeach; ?>
                                    </td>
                                    
                                    <td style="display: flex; justify-content: space-between;">
                                <a class="btn btn-primary btn-sm mr-2" href="image_upload.php?id=<?= $item['id'] ?>">Photo</a>
                                <a class="btn btn-success btn-sm mr-2" href="updateinventory.php?id=<?= $item['id'] ?>">Edit</a>
                                <a class="btn btn-secondary btn-sm mr-2" href="varient.php?id=<?= $item['id'] ?>">Varient</a>
                                <button class="btn btn-danger btn-sm deactivate-btn" data-id="<?= $item['id'] ?>">Deactivate</button>
                              </td>
                                    
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                </div>
            </div>
        </div>
    </div>
    <?php include "layout/footer.php"; ?>
    <script>
$(document).ready(function() {
    $(".deactivate-btn").click(function() {
        var itemId = $(this).data("id");
        $.ajax({
            type: "POST",
            url: "ajax/deactive.php",
            data: { id: itemId },
            success: function(response) {
               
                alert("Item deactivated successfully");
              
                location.reload();
            },
            error: function(xhr, status, error) {
               
                console.error(xhr.responseText);
            }
        });
    });
});
</script>

</body>

</html>
