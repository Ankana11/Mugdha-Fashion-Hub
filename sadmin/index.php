<?php
include '../constant.php';

$error = "";

session_start();
session_destroy();

@session_start();

if (isset($_REQUEST['btnsubmit'])) {
    $username = $_REQUEST['username'];
    $password = $_REQUEST['password'];

    $selectquery = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM admin_user WHERE username='$username' AND password='$password'"));

    if (isset($selectquery)) {
        $_SESSION['adminusername'] = $username;
        $_SESSION['adminpassword'] = $password;
        $_SESSION['permission'] = $selectquery['permission'];
        $_SESSION['name'] = $selectquery['name'];
        header("Location:dashboard.php");
    } else {
        $error = "Wrong Username or Password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>MFH</title>

    <!-- Bootstrap core CSS -->
    <link href="../admincss/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template -->
    <link href="../admincss/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- Custom styles for this template -->
    <link href="../admincss/sb-admin.css" rel="stylesheet">

    <style type="text/css">
        .btn-primary {
            cursor: pointer;
        }
    </style>
</head>

<body class="bg-dark">
    <div class="container">
        <div class="card card-login mx-auto mt-5">
            <div class="card-header ">Login</div>
            <div class="card-body">
                <form action="" method="POST">
                    <div class="form-group">
                        <label>Username</label>
                        <input class="form-control" type="text" name="username" aria-describedby="emailHelp"
                            placeholder="Enter Username">
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input class="form-control" type="password" name="password" placeholder="Password">
                    </div>
                    <div class="form-group">
                        

                        <?php if ($error !== "") { ?>
                        <div class="alert alert-danger" role="alert">
                            <?= $error ?>
                        </div>
                        <?php } ?>
                    </div>
                    <input type="submit" value="Login" name="btnsubmit" class="btn btn-primary btn-block">
                </form>
                <!-- <div class="text-center">
                    <a class="d-block small" href="forgot-password.html">Forgot Password?</a>
                </div> -->
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript -->
    <script src="../adminjs/jquery.min.js"></script>
    <script src="../adminjs/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript -->
    <script src="../adminjs/jquery.easing.min.js"></script>
</body>

</html>
