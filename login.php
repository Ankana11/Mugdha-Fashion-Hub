<?php
@session_start();
include 'constant.php';
$errormsg = ""; 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"]; 
    $password = $_POST["pass"];

    $sql = "SELECT * FROM `user` WHERE email='$email' AND password='$password'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {
        
        $_SESSION['user'] = isset($_SESSION['user']) ? $_SESSION['user'] : array();
        $_SESSION['user']['email'] = $email;

        header('Location: '.$_SESSION['location']); 
        exit();
    } else {
       $errormsg="Invalid email or password. Please try again.";
    }
} 
?>

<!DOCTYPE html>
<html lang="zxx">
<head>
    <?php include "layout/header.php"; ?>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>
    <div id="preloder">
        <div class="loader"></div>
    </div>
    <?php include "layout/menu.php"; ?>
    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg " style="background-blend-mode: darken; background: rgba(0, 0, 0, 0.7); background-repeat: no-repeat; background-size: cover;" data-setbg="img/reg.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Login</h2>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->
    <div class="container mt-4">
    <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0 m-2">
            <form class="g-3 " method="post" action="">
            <?php if ($errormsg !== ""): ?>
    <div class="alert alert-danger text-center mb-3"><?php echo $errormsg; ?></div>
    <?php endif; ?>
    </div>
    <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-6 mt-3">
                        <label for="inputEmail4" class="form-label">Email</label>
                        <input type="email" name="email" id="email" class="form-control" >
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-6 mt-3">
                        <label for="inputPassword4" class="form-label">Password</label>
                        <input type="password" name="pass" id="id" class="form-control">
                    </div>
                </div>
                <div class="col-12 mt-5 d-flex justify-content-center">
                   
                        <button type="submit" class="btn btn-primary">Login</button>
                  
                </div>
            </form>
            <div class="text-center mb-5">
                <a class="text-dark" href="registration.php">Don't have an account? Register!</a>
            </div>
        </div>
        </div>
    </div>
    </div>
   
    <?php include "layout/footer.php"; ?>
    <script type="text/javascript">
  $(document).ready(function() {
    
      $(".login").addClass("active");
});
   
   </script>
</body>
</html>
