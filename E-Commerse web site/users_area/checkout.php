<?php 
include('../includes/connect.php');
session_start(); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Checkout</title>

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" crossorigin="anonymous" />
  
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous" />
  
  <!-- Custom CSS -->
  <link rel="stylesheet" href="style.css" />

  <style>
    /* Reset spacing to remove unwanted gaps */
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    html, body {
      width: 100%;
      font-family: Arial, sans-serif;
    }

    .logo {
      width: 60px;
      height: auto;
    }

    .navbar {
      margin-bottom: 0;
    }

    .header-text h3,
    .header-text p {
      margin: 0;
      padding: 0.3rem 0;
    }

    footer {
      position: relative;
      bottom: 0;
      width: 100%;
    }
  </style>
</head>

<body>

<div class="container-fluid p-0">

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg bg-info">
    <div class="container-fluid">
      <a class="navbar-brand" href="../index.php">
        <img src="../images/removed_bg_-removebg-preview.png" alt="Store Logo" class="logo" />
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item"><a class="nav-link active" href="../index.php">Home</a></li>
          <li class="nav-item"><a class="nav-link" href="../display_all.php">Products</a></li>
          <li class="nav-item"><a class="nav-link" href="./users_area/user_registration.php">Register</a></li>
          <li class="nav-item"><a class="nav-link" href="#">Contact</a></li>
        </ul>
        <form class="d-flex" role="search" action="search_product.php" method="get">
          <input class="form-control me-2" type="search" placeholder="Search" name="search_data" required />
          <input type="submit" value="Search" class="btn btn-outline-success" name="search_data_product" />
        </form>
      </div>
    </div>
  </nav>

  <!-- Welcome Bar -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-secondary">
    <ul class="navbar-nav me-auto">
      <!--<li class="nav-item"><a class="nav-link" href="#">Welcome Guest</a></li>
      <li class="nav-item"><a class="nav-link" href="users_area/user_login.php">Login</a></li>-->
      <?php
      if(!isset($_SESSION['username'])){
          echo"<li class='nav-item'>
          <a class='nav-link' href='#'>Welcome Guest</a>
        </li>";
      }else{
        echo "<li class='nav-item'>
        <a class='nav-link' href='#'>Welcome  ".$_SESSION['username']."</a></li>";
      }
      if(!isset($_SESSION['username'])){
        echo"<li class='nav-item'>
        <a class='nav-link' href='./users_area/user_login.php'>Login</a>
      </li>";
      }else{
        echo "<li class='nav-item'>
        <a class='nav-link' href='logout.php'>Logout</a>
        </li>";
      }
      ?>
    </ul>
  </nav>

  <!-- Page Header -->
  <div class="bg-light text-center header-text py-2">
    <h3>Hidden Store</h3>
    <p>Communication is at the heart of LOCONEX and community</p>
  </div>

  <!-- Main Content -->
  <div class="container my-4">
    <div class="row">
      <div class="col-md-10 mx-auto">
        <?php
          if (!isset($_SESSION['username'])) {
            include('user_login.php');
          } else {
            include('../payment.php');
          }
        ?>
      </div>
    </div>
  </div>

  <!-- Footer -->
  <footer class="bg-info text-white text-center py-3 mt-auto">
    © 2025 LocoNeX. All rights reserved. |
      <a href="#">Terms of Service </a>|
      <a href="#">Privacy Notice</a>
      <p>
        Contact us: <a href="https://mail.google.com/mail/?view=cm&fs=1&to=tech.pheonix03@gmail.com&su=SUBJECT&body=BODY&tech.pheonix03@gmail.com" class="link">support@LocoNeX.com</a><br>
        <a href="https://chat.whatsapp.com/JifnVdOB7ZVCY8bqG81wyf" class="link">whatsapp</a>
       <a href="https://www.facebook.com/tech.pheonix03" class="link">facebook</a>
       <a href="https://www.instagram.com/tech.pheonix/profilecard/?igsh=OWg0OXo1Y3FtbGJ4" class="link">instagram</a>
       <a href="https://x.com/Tech_Pheonix3" class="link" >X twitter</a><br>
      </p>
  </footer>

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
<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>

</body>
</html>
