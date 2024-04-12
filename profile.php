<?php
@session_start();
include 'constant.php';
if (!isset($_SESSION['user']) || !isset($_SESSION['user']['email'])) {
    header("Location: login.php");
    exit();
}
$email = $_SESSION['user']['email'];

$sql = "SELECT * FROM user WHERE email = '$email'";
$result = mysqli_query($conn, $sql);

if ($result) {
    $row = mysqli_fetch_assoc($result);
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $address = $_POST['address'];
    $name = $_POST['name'];
    $pin = $_POST['pin'];
    $update_sql = "UPDATE user SET address = '$address', name = '$name', pin = '$pin' WHERE email = '$email'";
    if (mysqli_query($conn, $update_sql)) {
        $_SESSION['success_msg'] = "Your information has been updated successfully!";
        header("Location: profile.php");
        exit();
    } else {
        echo "Error updating record: " . mysqli_error($conn);
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
    <section class="breadcrumb-section set-bg " style="background-blend-mode: darken; background: rgba(0, 0, 0, 0.7); background-repeat: no-repeat; background-size: cover;" data-setbg="img/order.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>My Profile</h2>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->
    <div class="container mt-4">
        <div class="card o-hidden border-0 shadow-lg my-5">
        <?php if(isset($_SESSION['success_msg'])): ?>
                <div class="alert alert-success" role="alert">
                    <?php echo $_SESSION['success_msg']; ?>
                </div>
                <?php unset($_SESSION['success_msg']); ?>
                <?php endif; ?>

            <h4 class="text-center mt-4">Here Is Your Profile Information</h4>
            <p class="text-center">You Can Update Your Information</p>
            <hr>
            <div class="card-body p-0 m-2">
               <div class="container m-2">
            <form class="row g-3" method="post" action="">
                
            <div class="col-md-4 mt-2 offset-md-2">
                <p><b>Email: </b> <?php echo $row['email']?></p>
            </div>
            <div class="col-md-4 mt-2 offset-md-1">
            <p><b>Mobile: </b> <?php echo $row['mobile']?></p>
            </div>
            <div class="col-11 mt-2 ml-md-4">
                <label for="inputAddress" class="form-label">Name</label>
                <input type="text" name="name" class="form-control" id="name" value="<?php echo $row['name']?>">
            </div>
            <div class="col-11 mt-2 ml-md-4">
                <label for="inputAddress" class="form-label">Address</label>
                <input type="text" name="address" class="form-control" id="address" value="<?php echo $row['address']?>">
            </div>
      
            <div class="col-8 mt-2 ml-md-4">
                <label for="inputAddress" class="form-label">Pin</label>
                <input type="number" name="pin" class="form-control" id="pin" value="<?php echo $row['pin']?>">
            </div>
            
             <div class="col-md-2 mt-3">
            <select class="form-select mt-4 col-8">
                <option selected>India</option>
            </select>
            </div>

            <div class="col-12 mt-5 d-flex justify-content-center">
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
           
            </form>
            </div>          
            </div>
            </div>
        </div>
    </div>
    <?php include "layout/footer.php"; ?>
    
<script type="text/javascript">
  $(document).ready(function() {
    
      $(".profile").addClass("active");
});
   
   </script>
</body>
</html>
