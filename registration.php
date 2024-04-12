<?php
include "constant.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $mobile = $_POST["mobile"];
    $password = $_POST["pass"];
    $address = $_POST["address"];
    $pin = $_POST["pin"];
    $sqlcheck = "SELECT * FROM `user` WHERE  email='$email'";
    $result = mysqli_query($conn, $sqlcheck);
    if (mysqli_num_rows($result) > 0) {
        $response['message'] = "Sorry! You're already registerd";
       
    } else {
        $insertSql = "INSERT INTO `user` SET name='$name', email = '$email', mobile='$mobile', password = '$password', address='$address', pin='$pin'";
        $insertResult = mysqli_query($conn, $insertSql);

        if (!$insertResult) {
            $response['message'] = "Error: " . mysqli_error($conn);
            
        } else {
            $response['message'] = " Data Registerd successfully!";
      
            $response['message'] = " Data Registerd successfully!";
            header('Location: login.php');
        exit();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="zxx">
 <head>
 <?php include "layout/header.php";
?>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
 
  
 </head>
 <body>
 <div id="preloder">
        <div class="loader"></div>
    </div>
 <?php include "layout/menu.php";
?>
<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-section set-bg " style="background-blend-mode: darken; background: rgba(0, 0, 0, 0.7); background-repeat: no-repeat; background-size: cover;" data-setbg="img/reg.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Registration</h2>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->
<div class="container mt-4">
<div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0 m-3">
<form class="row g-3" method="post" action="">
  <div class="col-md-6 mt-2">
    <label for="inputEmail4" class="form-label">Name</label>
    <input type="text" name="name" class="form-control" id="name" required=""  onkeypress="return isNumberKey(event)">
  </div>
  <div class="col-md-6 mt-2">
    <label for="inputPassword4" class="form-label">Mobile</label>
    <input type="number" name="mobile" class="form-control" id="mobile" required="">
  </div>
  <div class="col-12 mt-2">
    <label for="inputAddress" class="form-label">Address</label>
    <input type="text" name="address" class="form-control" id="address" required="">
  </div>
  <div class="col-6 mt-2">
    <label for="inputAddress" class="form-label">Email</label>
    <input type="email" name="email" class="form-control" id="email" required="">
  </div>
  <div class="col-6 mt-2">
    <label for="inputAddress" class="form-label">Pin</label>
    <input type="number" name="pin" class="form-control" id="pin" required="">
  </div>

  <div class="col-6 mt-2">
    <label for="inputAddress2" class="form-label">Password</label>
    <input type="password" class="form-control" name="pass" id="pass" required="">
  </div>
  <div class="col-6 mt-2">
    <label for="inputAddress2" class="form-label">Confirm Password</label>
    <input type="password" class="form-control" name="cpass" id="cpass" required="">
  </div>
  
  <div class="col-12 mt-5 d-flex justify-content-center">
    <button type="submit" class="btn btn-primary" id="register_btn">Register</button>
  </div>
</form>

</div>
</div>
</div>

  
   
  <?php include "layout/footer.php";
?>
<script type="text/javascript">
  $(document).ready(function() {
    
      $(".reg").addClass("active");
});

        document.getElementById("mobile").addEventListener("input", function() {
        if (this.value.length > 10) {
            alert('Number must be 10 digit');
            this.value = this.value.slice(0, 10);
        }
    });
        $(function () {
            $("#register_btn").click(function (e) {
                const name = $("#name").val();
                const email = $("#email").val();
                const phone = $("#mobile").val();
                const password = $("#pass").val();
                const repeatPassword = $("#cpass").val();

                if (password !== repeatPassword) {

                   alert('Password and Repeat password do not match');
                   e.preventDefault();
                   
                } else {
                    if (!name || !phone) {
                        alert('Please fill the form');
                        e.preventDefault();
                    } else {
                        $("#regt_section").submit();
                    }
                }
            });
        });
        function isNumberKey(evt) {
        var keyCode = evt.which ? evt.which : evt.keyCode;
        if ((keyCode < 65 || keyCode > 90) && (keyCode < 97 || keyCode > 122) && keyCode != 32) {
            alert('Only Alphabets are allowed');
            return false;
        }
        return true;
    }
    
   
   </script>
 
 </body>
</html>


