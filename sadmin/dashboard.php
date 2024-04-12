<?php
include 'layout/sessioncheck.php';
include '../constant.php';
// session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>My Admin</title>
    <?php include "layout/header.php"; ?>
    <link rel="stylesheet" type="text/css" href="admincss/datatables.min.css">
</head>

<body class="fixed-nav sticky-footer bg-dark" id="page-top">

    <?php include "layout/menu.php"; ?>

    <div class="content-wrapper align-items-center justify-content-center">
        <div class="container">
            <div class="card mb-3" >
                <div class="card-header bg-primary text-white">
                    <h4 class="card-title">Dashboard</h4>
                </div>
                <div class="card-body">
                    <h4 class="card-title">Welcome, <?= $_SESSION['name'] ?></h4>
                </div>
            </div>
        </div>
    </div>

    <?php include "layout/footer.php"; ?>

    <script type="text/javascript" src="adminjs/datatables.min.js"></script>
    <script type="text/javascript">
        $('.tablename').DataTable({
            "ordering": false
        });
    </script>
</body>

</html>
