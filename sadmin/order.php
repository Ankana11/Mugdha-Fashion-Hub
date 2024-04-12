<?php
include 'layout/sessioncheck.php';
include '../constant.php';
$successmsg = "";
$errormsg = "";
$uploadOk = 1;

$sql = "SELECT * FROM orders";
$result = mysqli_query($conn, $sql);
$inventoryitems = [];

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
       
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
        $("#order").addClass("active");
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
                <table class="table">
                        <thead>
                            <tr>
                                <th>OrderId</th>
                                <th>Name</th>
                              
                                <th>Email</th>
                               
                                <th>Delivery Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($inventoryitems as $key => $item) : ?>
                                <tr>
                                
                                    <td><?= $item['id'] ?></td>
                                    <td><?= $item['customer_name'] ?></td>
                                    
                                    <td><?= $item['email'] ?></td>
                                 
                                    <td><?= $item['delivery_status'] ?></td>
                                    <td><a class="btn btn-primary btn-sm" href="items.php?id=<?= $item['id'] ?>">Details</a></td>
                                    
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <?php include "layout/footer.php"; ?>

</body>

</html>
