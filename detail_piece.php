<?php
session_start();
include 'constant.php';
if(isset($_GET['id'])) {
  $id = $_GET['id'];
  $sql = "SELECT * FROM school WHERE id = $id";
  $result = mysqli_query($conn, $sql);
  if(mysqli_num_rows($result) > 0) {
      $school = mysqli_fetch_assoc($result);
  } else {
      echo "No record found with the provided ID.";
      exit; 
  }
} 

$qualities = [];
if(isset($school)) {
  $schoolId = $school['id'];
  $sql = "SELECT DISTINCT quality FROM inventory WHERE schoolid = $schoolId";
  $result = mysqli_query($conn, $sql);
  if(mysqli_num_rows($result) > 0) {
      while($row = mysqli_fetch_assoc($result)) {
          $qualities[] = $row['quality'];
      }
  }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (!isset($_SESSION['cart'])) {
      $_SESSION['cart'] = array();
  }
  $_SESSION['cart'][$id]['school'] = $school['schoolname'];
  $_SESSION['cart'][$id]['photo'] = $school['photo'];
  $_SESSION['cart'][$id]['schoolid'] = $id;
  $_SESSION['cart'][$id]['gender'] = $_POST['gender'];
  $_SESSION['cart'][$id]['age'] = $_POST['age'];
  $_SESSION['cart'][$id]['height'] = $_POST['height'];
  $_SESSION['cart'][$id]['weight'] = $_POST['weight'];
  $_SESSION['cart'][$id]['quality'] = $_POST['quality'];
  $_SESSION['cart'][$id]['size'] = $_POST['size'];
  $_SESSION['cart'][$id]['quantity'] = $_POST['quantity'];

  header("Location: cart.php");
  exit;
}
?>

<!DOCTYPE html>
<html lang="zxx">
 <head>
 <?php include "layout/header.php";
?>
  <!-- <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" />
  <style>
  .box
  {
   width:100%;
   margin:0 auto;
  }
  .active_tab1
  {
   background-color:#fff;
   color:#333;
   font-weight: 600;
  }
  .inactive_tab1
  {
   background-color: #f5f5f5;
   color: #333;
   cursor: not-allowed;
  }
  .has-error
  {
   border-color:#cc0000;
   background-color:#ffff99;
  }
  </style>
 </head>
 <body>
 <div id="preloder">
        <div class="loader"></div>
    </div>
 <?php include "layout/menu.php";
?>
  <!-- Breadcrumb Section Begin -->
  <section class="breadcrumb-section set-bg " style="background-blend-mode: darken; background: rgba(0, 0, 0, 0.7); background-repeat: no-repeat; background-size: cover;" data-setbg="img/try.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Dress Packages</h2>
                       
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->
      <!-- Product Details Section Begin -->
      <section class="product-details spad">
     <div class="container">
    
    <div class="row">
        
               
 <div class="col-lg-6 col-md-6">     
<div class="container box">
   <br />
   <form method="post" id="register_form">
    <div class="tab-content" style="margin-top:16px;">
     <div class="tab-pane active" id="login_details">
      <div class="panel panel-default">
       <div class="panel-heading">Gender Selection</div>
       <div class="panel-body">

       <div class="form-group">
         <label>Gender</label>
         <label class="radio-inline">
          <input type="radio" name="gender" value="male" > Boys
         </label>
         <label class="radio-inline">
          <input type="radio" name="gender" value="female"> Girls
         </label>
        </div>
        <input type="hidden" name="id" id="id" value="<?php echo $school['id']; ?>" />
        <br />
        <div align="center">
         <button type="button" name="btn_login_details" id="btn_login_details" class="btn btn-info btn-lg">Next</button>
        </div>
        <br />
       </div>
      </div>
     </div>
     <div class="tab-pane fade" id="personal_details">
      <div class="panel panel-default">
       <div class="panel-heading">Basic Details</div>
       <div class="panel-body">
        <div class="form-group">
         <label>Enter Your Age</label>
         <input type="text" name="age" id="age" class="form-control" required />
         <span id="error_first_name" class="text-danger"></span>
        </div>
        <div class="form-group">
         <label>Enter Your Height</label>
         
         <input type="text" name="height" id="height" class="form-control" required/>
         <span id="error_last_name" class="text-danger"></span>
        </div>
        <div class="form-group">
         <label>Enter Your Weight</label>
        
         <input type="text" name="weight" id="weight" class="form-control" required />
         <span id="error_last_name" class="text-danger"></span>
        </div>
        <br />
        <div align="center">
         <button type="button" name="previous_btn_personal_details" id="previous_btn_personal_details" class="btn btn-default btn-lg">Previous</button>
         <button type="button" name="btn_personal_details" id="btn_personal_details" class="btn btn-info btn-lg">Next</button>
        </div>
        <br />
       </div>
      </div>
     </div>
     <div class="tab-pane fade" id="contact_details">
      <div class="panel panel-default">
       <div class="panel-heading">Piece of dress details</div>
       <div class="panel-body">
       <div class="form-group">
    <label>Quality</label>
    <select class="form-select form-control mb-2" aria-label="Default select example" name="quality" id="quality">
        <option selected>Select Your Quality</option>
        <?php foreach ($qualities as $quality) : ?>
            <option><?= $quality ?></option>
        <?php endforeach; ?>
    </select>
    <span id="error_address" class="text-danger"></span>
</div>

        <div class="form-group mt-2">
         <label>Size of piece(meter)</label>
         <input type="text" name="size" id="size" class="form-control" required />
         <span id="error_address" class="text-danger"></span>
        </div>
        <div class="form-group">
         <label>Quantity</label><br>
         <div class="product__details__quantity">
                            <div class="quantity"  id="quantity">
                                <div class="pro-qty">
                                    <input type="text" value="1" name="quantity">
                                </div>
                            </div>
                        </div>
         <span id="error_mobile_no" class="text-danger"></span>
        </div>
        <br />
        <div align="center">
         <button type="button" name="previous_btn_contact_details" id="previous_btn_contact_details" class="btn btn-default btn-lg">Previous</button>
         <button type="button" name="btn_contact_details" id="btn_contact_details" class="btn btn-success btn-lg">Submit</button>
        </div>
        <br />
       </div>
      </div>
     </div>
    </div>
   </form>
 </div>
 </div>
 <div class="col-lg-6 col-md-6">
                <div class="product__details__pic">
                    <!-- <div class="product__details__pic__item">
                         -->
                        <img class="" src="sadmin/image/<?php echo $school['photo']; ?>" alt="dress image" height="400" width="400">
                        <h2 ><?php echo $school['schoolname']; ?></h2>
                    <!-- </div> -->
                </div>
            </div>
 </div>
 </div>
 </div>
</section>
  <?php include "layout/footer.php";
?>

  <script>
$(document).ready(function(){
 
 $('#btn_login_details').click(function(){

   $('#list_login_details').removeClass('active active_tab1');
   $('#list_login_details').removeAttr('href data-toggle');
   $('#login_details').removeClass('active');
   $('#list_login_details').addClass('inactive_tab1');
   $('#list_personal_details').removeClass('inactive_tab1');
   $('#list_personal_details').addClass('active_tab1 active');
   $('#list_personal_details').attr('href', '#personal_details');
   $('#list_personal_details').attr('data-toggle', 'tab');
   $('#personal_details').addClass('active in');

 });
 
 $('#previous_btn_personal_details').click(function(){
  
  $('#list_personal_details').removeClass('active active_tab1');
  $('#list_personal_details').removeAttr('href data-toggle');
  $('#personal_details').removeClass('active in');
  $('#list_personal_details').addClass('inactive_tab1');
  $('#list_login_details').removeClass('inactive_tab1');
  $('#list_login_details').addClass('active_tab1 active');
  $('#list_login_details').attr('href', '#login_details');
  $('#list_login_details').attr('data-toggle', 'tab');
  $('#login_details').addClass('active in');
  
 });
 
 $('#btn_personal_details').click(function(){
 
   $('#list_personal_details').removeClass('active active_tab1');
   $('#list_personal_details').removeAttr('href data-toggle');
   $('#personal_details').removeClass('active');
   $('#list_personal_details').addClass('inactive_tab1');
   $('#list_contact_details').removeClass('inactive_tab1');
   $('#list_contact_details').addClass('active_tab1 active');
   $('#list_contact_details').attr('href', '#contact_details');
   $('#list_contact_details').attr('data-toggle', 'tab');
   $('#contact_details').addClass('active in');

 });
 
 $('#previous_btn_contact_details').click(function(){
  $('#list_contact_details').removeClass('active active_tab1');
  $('#list_contact_details').removeAttr('href data-toggle');
  $('#contact_details').removeClass('active in');
  $('#list_contact_details').addClass('inactive_tab1');
  $('#list_personal_details').removeClass('inactive_tab1');
  $('#list_personal_details').addClass('active_tab1 active');
  $('#list_personal_details').attr('href', '#personal_details');
  $('#list_personal_details').attr('data-toggle', 'tab');
  $('#personal_details').addClass('active in');
 });
 
 $('#btn_contact_details').click(function(){

    var gender= $("input[name='gender']:checked").val();
   const age= $("#age").val();
   const height= $("#height").val();
   const weight= $("#weight").val();
   const size= $("#size").val();
   const quantity= $("#quantity").val();

   if(!size || !gender  || !age || !height || !weight){
    alert("please fill the requierd filed")
   }else{
    $('#btn_contact_details').attr("disabled", "disabled");
   $(document).css('cursor', 'prgress');
   $("#register_form").submit();
   }


  
});
 
});
</script>

 </body>
</html>


