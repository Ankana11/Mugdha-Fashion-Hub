<?php
include 'layout/sessioncheck.php';
include '../constant.php';
// session_start();

?>
<!DOCTYPE html>
<html>
<head>
	<title>Manage Courses</title>
	<?php
        include "layout/header.php";
      ?>
       <link rel="stylesheet" type="text/css" href="admincss/datatables.min.css">
</head>
<body class="fixed-nav sticky-footer bg-dark" id="page-top">

    <?php
        include "layout/menu.php";
      ?>

<script type="text/javascript">
  $("#manage_coursespromotion").addClass("active");
</script>
  <div class="content-wrapper">
    <div class="container-fluid">
      <div class="container aos-init aos-animate" data-aos="fade-up">
        <div class="row aos-init aos-animate" data-aos="zoom-in" data-aos-delay="100">

         <!-- -----------print primum courses ------------ -->

         <?php

$query= mysqli_query($conn,"SELECT * from school");
while ($row=mysqli_fetch_assoc($query)) {
  $photo=$row['photo'];
 $name=$row['schoolname'];
  $id=$row['id'];
?>

<!-- <div class="col-lg-4 col-md-6 d-flex align-items-stretch border border-1 m-2 pb-3"> -->
<div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-2">
  <div class="course-item" style="width: 100%;">
    <img src="image/<?=$photo?>" style="height: 250px;"  class="img-fluid" alt="...">
    <div class="course-content">
      <p><b><?=$name?></b><br>
      </p>
     <div>
       <a href="school.php?id=<?=$id?>" class="btn btn-outline-success">Edit</a>
     </div>
    </div>
  </div>
</div> <!-- End Course Item-->

<?php
}?>
        

          
        </div>  
      </div>  
    </div>
  </div>


      <?php
        include "layout/footer.php";
      ?>
      <script type="text/javascript" src="adminjs/datatables.min.js"></script>
          <script type="text/javascript">
            $('.tablename').DataTable();
          </script>
</body>

</html>