<?php
include 'layout/sessioncheck.php';
include '../constant.php';
$successmsg = "";
$errormsg = "";
$uploadOk = 1;

$sql = "SELECT * FROM bulk";
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
        $("#bulk").addClass("active");
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
                                
                                <th>Name</th>
                              
                                <th>Contact</th>
                               
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($inventoryitems as $key => $item) : ?>
                                <tr>
                                
                                   
                                    <td><?= $item['name'] ?></td>
                                    
                                    <td><?= $item['mobile'] ?></td>
                                 
                                    <td><?= $item['date'] ?></td>
                                   
                                    
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
