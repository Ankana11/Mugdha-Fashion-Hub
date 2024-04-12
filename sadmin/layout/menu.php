<?php
// session_start();  
$teachername = $_SESSION['name'];
?>

<!-- Navigation-->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
  <img class="img-profile rounded-circle img" src="image/images (1).jpg" style="width: 20px; height: 20px; margin: 9px;">
  <a class="navbar-brand" href="dashboard.php"><?= $teachername ?></a>
  <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarResponsive">
    <ul class="navbar-nav navbar-sidenav bg-dark navbar--white" id="Accordion">
      
      <li class="nav-item" id="coursespromotion" data-toggle="tooltip" data-placement="right" title="" data-original-title="Menu Levels">
        <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#enterSchoolCollapse" data-parent="#Accordion" aria-expanded="false">
          <i class="fa fa-fw fa-dashboard"></i>
          <span class="nav-link-text">
          Enter School
          </span>
        </a>
        <ul class="sidenav-second-level collapse" id="enterSchoolCollapse" style="">
          <li id="addsubscription">
            <a href="school.php">Create School Dress</a>
          </li>
          <li id="managesubscription">
            <a href="manageschool.php">Manage School Dress</a>
          </li>
        </ul>
      </li>

      <li class="nav-item" id="inventory" data-toggle="tooltip" data-placement="right" title="" data-original-title="Menu Levels">
        <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#inventoryCollapse" data-parent="#Accordion" aria-expanded="false">
          <i class="fa fa-fw fa-dashboard"></i>
          <span class="nav-link-text">
          Inventory
          </span>
        </a>
        <ul class="sidenav-second-level collapse" id="inventoryCollapse" style="">
          <li id="addinventory">
            <a href="inventory.php">Create Inventory</a>
          </li>
          <li id="manageinventory">
            <a href="manageinventory.php">Manage Inventory</a>
          </li>
        </ul>
      </li>
      <li class="nav-item" data-toggle="tooltip" id="order" data-placement="right" title="coursespromotion">
          <a class="nav-link" href="order.php">
          <i class="fa fa-shopping-cart"></i>
            <span class="nav-link-text">Orders</span>
          </a>
      </li>
      <li class="nav-item" data-toggle="tooltip" id="bulk" data-placement="right" title="coursespromotion">
          <a class="nav-link" href="bulk.php">
          <i class="fa fa-shopping-cart"></i>
            <span class="nav-link-text">Bulk Order</span>
          </a>
      </li>
    </ul>

    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link" data-toggle="modal" data-target="#exampleModal">
          <i class="fa fa-fw fa-sign-out"></i>Logout</a>
      </li>
    </ul>
  </div>
</nav>
