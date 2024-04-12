<?php
session_start();
include 'constant.php';

$sql= "Select * from school";
$result= mysqli_query($conn, $sql);
$schools = array();

if(mysqli_num_rows($result)>0){
    while ($row = mysqli_fetch_assoc($result)) {
        $schools[] = $row;
    }
}

$_SESSION['location'] ='index.php';
     
// echo "<pre>";
// print_r($_SESSION);
// exit();
?>

<!DOCTYPE html>
<html lang="zxx">

<head>
<?php include "layout/header.php";
?>
<style>
   .schoollist ul{
        background-color:#eee;
        cursor:pointer;
    }
   .schoollist li{
        padding:5px;

    }
    .featured__item {
            margin-bottom: 30px;
            border: 3px solid #e5e5e5;
            border-radius: 10px;
            overflow: hidden;
            transition: all 0.3s ease;
        }
        .featured__item:hover {
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            transform: translateY(-5px);
        }
        .featured__item__pic {
            width: 100%;
            height: 200px; 
            background-size: cover;
            /* background-position: center; */
        }
        .featured__item__text {
            padding: 10px;
            text-align: center;
            background-color: #f9f9f9;
        }
        .featured__item__text h6 {
            font-size: 18px;
            margin-bottom: 10px;
            color: #333;
        }
        .featured__item__text h6 a {
            color: #333;
            text-decoration: none;
            transition: color 0.3s ease;
        }
        .featured__item__text h6 a:hover {
            color: #ff5722;
        }
</style>

</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>
 <?php include "layout/menu.php";
?>
    
    <!-- Hero Section Begin -->
    <section class="hero">
    <!-- <div class="container">
   <div class="hero__search">
    <div class="container">
    <input type="text" placeholder="Search by Your School Name" name="school" id="school" class="form-control col-md-6 mt-2">
    <div class="schoollist col-md-4 mt-2" style="margin-left: -14px;"></div>
    </div>
        <div class="hero__search__form">
            <form action="#">
                <div class="hero__search__categories d-none">
                    All Categories
                    <span class="arrow_carrot-down"></span>
                </div>
                <input type="text" placeholder="Search by Your School Name" name="school" id="school">
                <button type="submit" class="site-btn">SEARCH</button>
            </form>
            <div class="schoollist"></div>
        </div>
                       
                        <div class="hero__search__phone d-none">
                            <div class="hero__search__phone__icon">
                                <i class="fa fa-phone"></i>
                            </div>
                            <div class="hero__search__phone__text">
                                <h5>+65 11.188.888</h5>
                                <span>support 24/7 time</span>
                            </div>
                        </div>
                    
                    </div>
                    </div> -->
                    <div id="carouselIndicators" class="carousel slide" data-ride="carousel">
                      <ol class="carousel-indicators">
                        <li data-target="#carouselIndicators" data-slide-to="0" class="active"></li>
                        <li data-target="#carouselIndicators" data-slide-to="1"></li>
                        <!-- <li data-target="#carouselIndicators" data-slide-to="2"></li> -->
                      </ol>
                      <div class="carousel-inner">
                        <div class="carousel-item active">
                          <img class="d-block w-100" src="img/banner1.jpg" alt="First slide">
                        </div>
                        <div class="carousel-item">
                          <img class="d-block w-100" src="img/banner2.jpg" alt="Second slide">
                        </div>
                        <!-- <div class="carousel-item">
                          <img class="d-block w-100" src="..." alt="Third slide">
                        </div> -->
                      </div>
                      <a class="carousel-control-prev" href="#carouselIndicators" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                      </a>
                      <a class="carousel-control-next" href="#carouselIndicators" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                      </a>
                    </div>
                    <!-- <div class="breadcrumb-section set-bg" data-setbg="img/hero/banner.jpg">
                    <div class="container">
                        <div class="hero__text">
                            <span>Shop Now</span>
                            <h2>Buy Your <br />School Dress Online</h2>
                            <p>Free Delivery Available</p>
                            <a href="#" class="primary-btn d-none">SHOP NOW</a>
                        </div>
                    </div>
                </div> -->
            
    </section>
    <!-- Hero Section End -->

    
    <!-- Featured Section Begin -->
  <section class="featured spad" style="padding-top: 0px;">
    <div class="container">
        <div class="row">
            <div class="col-lg-9 offset-lg-3">
                <div class="hero__search">
                    <div class="hero__search__form">
                        <form action="#">
                            <input type="text" placeholder="Search by Your School Name" name="school" id="school">
                            <button type="submit" class="site-btn">SEARCH</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
   
        <div class="row">
            <div class="col-lg-9 offset-lg-3">
                <div class="container">
                    <div class="schoollist col-md-6 mb-1 mt-1" style="margin-left:-25px;"></div>
                </div>
            </div>
        </div>
        
                <div class="row featured__filter" style="margin-top: 20px;">
                <?php
            foreach ($schools as $school) {
                echo '<div class="col-lg-3 col-md-4 col-sm-6">
                <div class="featured__item">
                    <a href="detail.php?id=' . $school['id'] . '">
                        <div class="featured__item__pic set-bg" data-setbg="sadmin/image/' . $school['photo'] . '"></div>
                    </a>
                    <div class="featured__item__text">
                        <h6><a href="detail.php?id=' . $school['id'] . '">' . $school['schoolname'] . '</a></h6>
                    </div>
                </div>
            </div>';
              }
            ?>


            </div>
    </div>
</section>

    <!-- Banner Begin -->
    <div class="banner d-none">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="banner__pic">
                        <img src="img/banner/banner-1.jpg" alt="">
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="banner__pic">
                        <img src="img/banner/banner-2.jpg" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Banner End -->

   

    <!-- Blog Section Begin -->
    <section class="from-blog spad d-none">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title from-blog__title">
                        <h2>From The Blog</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="blog__item">
                        <div class="blog__item__pic">
                            <img src="img/blog/blog-1.jpg" alt="">
                        </div>
                        <div class="blog__item__text">
                            <ul>
                                <li><i class="fa fa-calendar-o"></i> May 4,2019</li>
                                <li><i class="fa fa-comment-o"></i> 5</li>
                            </ul>
                            <h5><a href="#">Cooking tips make cooking simple</a></h5>
                            <p>Sed quia non numquam modi tempora indunt ut labore et dolore magnam aliquam quaerat </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="blog__item">
                        <div class="blog__item__pic">
                            <img src="img/blog/blog-2.jpg" alt="">
                        </div>
                        <div class="blog__item__text">
                            <ul>
                                <li><i class="fa fa-calendar-o"></i> May 4,2019</li>
                                <li><i class="fa fa-comment-o"></i> 5</li>
                            </ul>
                            <h5><a href="#">6 ways to prepare breakfast for 30</a></h5>
                            <p>Sed quia non numquam modi tempora indunt ut labore et dolore magnam aliquam quaerat </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="blog__item">
                        <div class="blog__item__pic">
                            <img src="img/blog/blog-3.jpg" alt="">
                        </div>
                        <div class="blog__item__text">
                            <ul>
                                <li><i class="fa fa-calendar-o"></i> May 4,2019</li>
                                <li><i class="fa fa-comment-o"></i> 5</li>
                            </ul>
                            <h5><a href="#">Visit the clean farm in the US</a></h5>
                            <p>Sed quia non numquam modi tempora indunt ut labore et dolore magnam aliquam quaerat </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Blog Section End -->

 <section>
     <img src="img/bulk-banner.jpg" style="width: 100%;" id="bulkmodal">
 </section>
 
 <div class="modal" tabindex="-1" id="bulkbannermodal">
 <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Mugdha Fashion Hub</h5>
                <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
            </div>
            <div class="modal-body">
                <form id="form">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" required onkeypress="return isNumberKey(event)">
                    </div>
                    <div class="mb-3">
                        <label for="mobile" class="form-label">Contact Number</label>
                        <input type="number" class="form-control" id="mobile" name="mobile" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="saveuserinfo">Save</button>
            </div>
        </div>
    </div>
</div>
    <?php include "layout/footer.php";
?>

<script>
$(document).ready(function() {
    $('#school').keyup(function(){
        var query= $(this).val();
        if(query != '') {
            $.ajax({
                type: 'POST',
                url: 'ajax/getschool.php',
                data: { query: query },
                success: function (data) {
                    $('.schoollist').fadeIn();
                    $('.schoollist').html(data);
                }
            });
        }
        else {
            $('.schoollist').fadeOut();
            $('.schoollist').html("");
        }
    });
 
   $(document).on('click', '.schoollist li', function() {
        var schoolName = $(this).text().trim();
        $('#school').val(schoolName); 
        $('.schoollist').fadeOut();
    });

    $('form').submit(function(event) {
        event.preventDefault(); 
        var schoolName = $('#school').val().trim();
        var selectedSchoolId = null;

        <?php
        foreach ($schools as $school) {
            echo 'if ("' . $school['schoolname'] . '" === schoolName) {';
            echo 'selectedSchoolId = ' . $school['id'] . ';';
            echo '}';
        }
        ?>

        if (selectedSchoolId !== null) {
            window.location.href = 'detail.php?id=' + selectedSchoolId;
            $('#school').val('');
        } else {
            console.error('Selected school not found.');
        }
    });

    $(".shop").addClass("active");

    $('#bulkmodal').click(function() {
        $('#bulkbannermodal').modal('show');
    });

    $('#saveuserinfo').click(function() {
        var Name = $('#name').val();
        var Number = $('#mobile').val();

        const name = $("#name").val();
        const phone = $("#mobile").val();
        if (!name || !phone) {
            alert('Please fill the form');
        } else {
            $.ajax({
                type: 'POST',
                url: 'ajax/user.php', 
                data: { Name: Name, Number: Number },
                success: function (response) {
                    console.log(response);
                },
                error: function (xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });

            $('#bulkbannermodal').modal('hide');
            $('#name').val('');
            $('#mobile').val('');
        }
    });

    document.getElementById("mobile").addEventListener("input", function() {
        if (this.value.length > 10) {
            alert('Number must be 10 digits');
            this.value = this.value.slice(0, 10);
        }
    });
    function isNumberKey(evt) {
        var keyCode = evt.which ? evt.which : evt.keyCode;
        if ((keyCode < 65 || keyCode > 90) && (keyCode < 97 || keyCode > 122) && keyCode != 32) {
            alert('Only Alphabets are allowed');
            return false;
        }
        return true;
    }
});
</script>


</body>

</html>