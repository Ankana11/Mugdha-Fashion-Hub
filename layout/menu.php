<!-- Humberger Begin -->
<div class="humberger__menu__overlay"></div>
    <div class="humberger__menu__wrapper">
        <div class="humberger__menu__logo">
            <a href="#"><img src="img/logo.png" alt=""></a>
        </div>
        <div class="humberger__menu__cart">
            <ul>
               
                <li><a href="cart.php"><i class="fa fa-shopping-bag"></i></a></li>
            </ul>
            
        </div>
        <nav class="humberger__menu__nav mobile-menu">
            <ul>
                <li class="shop"><a href="./index.php">Shop</a></li>
                
                <?php
                if(isset($_SESSION['user']['email'])) {
                    echo '<li class="profile"><a href="./profile.php">Profile</a></li>';
                    echo '<li class="order"><a href="./order.php">Orders</a></li>';
                    echo '<li><a href="./logout.php">Logout</a></li>';
                } else {
                    echo '<li class="login"><a href="./login.php">Login</a></li>';
                    echo '<li class="reg"><a href="./registration.php">Register</a></li>';
                }
                ?>
            </ul>
        </nav>
        <div id="mobile-menu-wrap"></div>
    </div>
    <!-- Humberger End -->

<!-- Header Section Begin -->
<header class="header">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="header__logo">
                    <a href="./index.php"><img src="img/logo.png" alt="MFH" style="max-width: 120px;"></a>
                </div>
            </div>
            <div class="col-lg-6 d-flex justify-content-center">
                <nav class="header__menu">
                    <ul>
                        <li class="shop"><a href="./index.php">Shop</a></li>
                       
                        <?php
                        if(isset($_SESSION['user']['email'])) {
                            echo '<li class="profile"><a href="./profile.php">Profile</a></li>';
                            echo '<li class="order"><a href="./order.php">Orders</a></li>';
                            echo '<li><a href="./logout.php">Logout</a></li>';
                        } else {
                            echo '<li class="login"><a href="./login.php">Login</a></li>';
                            echo '<li class="reg"><a href="./registration.php">Register</a></li>';
                        }
                        ?>
                        <li><a href="cart.php"><i class="fa fa-shopping-bag"></i> </a></li>
                    </ul>
                </nav>
            </div>
            <div class="humberger__open">
                <i class="fa fa-bars"></i>
            </div>
        </div>
    </div>
</header>
<!-- Header Section End -->
