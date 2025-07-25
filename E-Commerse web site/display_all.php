<?php 
include('includes/connect.php');
include('functions/common_function.php');
session_start(); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>E-commerce</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" crossorigin="anonymous" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
  <link rel="stylesheet" href="style.css">
</head>
<body>

<!-- Navbar -->
<div class="container-fluid p-0">
  <nav class="navbar navbar-expand-lg bg-info">
    <div class="container-fluid">
      <img src="images\removed_bg_-removebg-preview.png" alt="logo" class="logo">
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item"><a class="nav-link active" href="index.php">Home</a></li>
          <li class="nav-item"><a class="nav-link" href="display_all.php">Products</a></li>
          <li class="nav-item"><a class="nav-link" href="./users_area/user_registration.php">Register</a></li>
          <li class="nav-item"><a class="nav-link" href="#">Contact</a></li>
          <li class="nav-item"><a class="nav-link" href="cart.php"><i class="fa-solid fa-cart-shopping"></i><sup>
          <?php
            cart_item();
          ?>
          </sup></a></li>
          <li class="nav-item"><a class="nav-link" href="#">Total price: 
          <?php
          total_cart_price();
          ?>/-
          </a></li>
        </ul>
        <form class="d-flex" role="search" action="search_product.php" method="get">
          <input class="form-control me-2" type="search" placeholder="Search" name="search_data">
          <!--<button class="btn btn-outline-success" type="submit">Search</button>-->
          <input type="Submit" value="Search"class="btn btn-outline-success" name="search_data_product">
        </form>
      </div>
    </div>
  </nav>

  <!-- Top Welcome Bar -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-secondary">
    <ul class="navbar-nav me-auto">
       <?php
      if(!isset($_SESSION['username'])){
          echo"<li class='nav-item'>
          <a class='nav-link' href='#'>Welcome Guest</a>
        </li>";
      }else{
        echo "<li class='nav-item'>
        <a class='nav-link' href='.\users_area\profile.php'>Welcome  ".$_SESSION['username']."</a></li>";
      }
      if(!isset($_SESSION['username'])){
        echo"<li class='nav-item'>
        <a class='nav-link' href='./users_area/user_login.php'>Login</a>
      </li>";
      }else{
        echo "<li class='nav-item'>
        <a class='nav-link' href='./users_area/logout.php'>Logout</a>
        </li>";
      }
      ?>
    </ul>
  </nav>

  <!-- Header -->
  <div class="bg-light">
    <h3 class="text-center">Hidden Store</h3>
    <p class="text-center">Communication is at the heart of LOCONEX and community</p>
  </div>

  <!-- Main content and Sidebar -->
  <div class="container-fluid mt-3">
    <div class="row">
      
      <!-- Products Column -->
      <div class="col-md-10 order-1 order-md-0">
        <div class="row">
          <!--fetching products-->
          <?php
          get_all_products();
           get_unique_categories();
           get_unique_brands();
          ?>
        </div>
      </div>

      <!-- Sidebar Column (Brands + Categories) -->
      <div class="col-md-2 bg-secondary p-3 order-2 order-md-1 text-white">
        <!-- Brands -->
        <h5 class="text-center bg-info py-2">Shop Brands</h5>
        <ul class="navbar-nav text-center">
          <?php 
            getbrands();
          ?>
        </ul>

        <!-- Categories -->
        <h5 class="text-center bg-info py-2 mt-4">Categories</h5>
        <ul class="navbar-nav text-center">
          <?php 
            getcategories();
          ?>
        </ul>
      </div>

    </div>
  </div>

  <!-- Footer -->
  <div class="bg-info p-3 text-center mt-3">
    © 2025 LocoNeX. All rights reserved. |
      <a href="#">Terms of Service</a> |
      <a href="#">Privacy Notice</a>
      <p>
        Contact us: <a href="https://mail.google.com/mail/?view=cm&fs=1&to=tech.pheonix03@gmail.com&su=SUBJECT&body=BODY&tech.pheonix03@gmail.com" class="link">support@LocoNeX.com</a><br>
        <a href="https://chat.whatsapp.com/JifnVdOB7ZVCY8bqG81wyf" class="link">whatsapp</a>
       <a href="https://www.facebook.com/tech.pheonix03" class="link">facebook</a>
       <a href="https://www.instagram.com/tech.pheonix/profilecard/?igsh=OWg0OXo1Y3FtbGJ4" class="link">instagram</a>
       <a href="https://x.com/Tech_Pheonix3" class="link">twitter</a><br>
      </p>
  </div>
<script type="text/javascript">
      (function(d, t) {
      var v = d.createElement(t), s = d.getElementsByTagName(t)[0];
      v.onload = function() {
      window.voiceflow.chat.load({
      verify: { projectID: '68065c45d8f7eeeb59e78931' },
      url: 'https://general-runtime.voiceflow.com',
      versionID: 'production',
      voice: {
        url: "https://runtime-api.voiceflow.com"
      }
      });
      }
      v.src = "https://cdn.voiceflow.com/widget-next/bundle.mjs"; v.type = "text/javascript"; s.parentNode.insertBefore(v, s);
     })(document, 'script');
    </script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>
</html>
