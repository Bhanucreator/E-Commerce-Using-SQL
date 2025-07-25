<?php 
include('includes/connect.php');
include('functions/common_function.php');
session_start(); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>My Cart</title>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" crossorigin="anonymous">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
  <link rel="stylesheet" href="style.css">

  <style>
    .table th, .table td { vertical-align: middle; }
    input[type="number"]::-webkit-inner-spin-button, 
    input[type="number"]::-webkit-outer-spin-button {
      -webkit-appearance: none; margin: 0;
    }
    .btn-light { background-color: #f8f9fa; border: 1px solid #dee2e6; }
    .btn-light:hover { background-color: #e2e6ea; }
    .logo { height: 50px; }
    footer { font-size: 0.9rem; }
  </style>
</head>

<body>
<div class="container-fluid p-0">
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg bg-info">
    <div class="container-fluid">
      <img src="images/removed_bg_-removebg-preview.png" alt="logo" class="logo">
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item"><a class="nav-link active" href="index.php">Home</a></li>
          <li class="nav-item"><a class="nav-link" href="display_all.php">Products</a></li>
          <li class="nav-item"><a class="nav-link" href="./users_area/user_registration.php">Register</a></li>
          <li class="nav-item"><a class="nav-link" href="#">Contact</a></li>
          <li class="nav-item"><a class="nav-link" href="cart.php"><i class="fa-solid fa-cart-shopping"></i><sup><?php cart_item(); ?></sup></a></li>
        </ul>
      </div>
    </div>
  </nav>

  <?php cart(); ?>

  <!-- Welcome Bar -->
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

  <!-- Cart Section -->
  <div class="container py-5">
    <h2 class="text-center mb-5">Shopping Cart</h2>
    <form action="cart.php" method="POST">
    <div class="row g-5">
      <!-- Cart Items -->
      <div class="col-lg-8">
        <table class="table align-middle">
          <thead class="table-light">
            <tr class="text-uppercase small text-muted">
              <th>Product</th>
              <th>Price</th>
              <th>Quantity</th>
              <th>Subtotal</th>
              <th>Remove</th>
            </tr>
          </thead>
          <tbody>
            <?php
              global $con;
              $ip = getIPAddress();
              $total = 0;
              $cart_query = "SELECT * FROM cart_details WHERE ip_address='$ip'";
              $result = mysqli_query($con, $cart_query);
              $num_cart_items = mysqli_num_rows($result);

              if ($num_cart_items === 0) {
                echo "<tr><td colspan='5' class='text-center text-muted py-5 fs-4'>Your cart is empty 😞</td></tr>";
              } else {
                while($row = mysqli_fetch_assoc($result)){
                  $product_id = $row['product_id'];
                  $quantity = (int)$row['quantity'];

                  $product_query = "SELECT * FROM products WHERE product_id='$product_id'";
                  $product_result = mysqli_query($con, $product_query);
                  $product = mysqli_fetch_assoc($product_result);

                  $product_title = $product['product_title'];
                  $product_price = (float)$product['product_price'];
                  $product_image1 = $product['product_image1'];
                  $subtotal = $product_price * $quantity;
                  $total += $subtotal;
            ?>
            <tr class="border-bottom">
              <td class="d-flex align-items-center">
                <img src="./admin-bord/product_images/<?php echo $product_image1 ?>" alt="Product" class="me-3" width="80">
                <div>
                  <div class="fw-bold"><?php echo $product_title ?></div>
                </div>
              </td>
              <td class="fw-bold"><i class="fa-solid fa-indian-rupee-sign"></i><?php echo number_format($product_price, 2) ?></td>
              <td>
                <div class="d-flex align-items-center">
                  <button type="button" class="btn btn-light btn-sm quantity-decrease">-</button>
                  <input type="number" class="form-control text-center mx-2 quantity-input" 
                         style="width: 60px;" 
                         value="<?php echo $quantity ?>" 
                         min="1" 
                         name="qty[<?php echo $product_id ?>]">
                  <button type="button" class="btn btn-light btn-sm quantity-increase">+</button>
                </div>
              </td>
              <td class="fw-bold"><i class="fa-solid fa-indian-rupee-sign"></i><?php echo number_format($subtotal, 2) ?></td>
              <td><input type="checkbox" name="remove_item[]" value="<?php echo $product_id ?>"></td>
            </tr>
            <?php } } ?>
          </tbody>
        </table>

        <?php if ($num_cart_items > 0): ?>
        <div class="d-flex justify-content-between mt-4">
          <div class="d-flex">
            <input type="text" class="form-control" placeholder="Coupon Code" style="max-width: 250px;">
            <button class="btn btn-secondary ms-2">Apply Coupon</button>
          </div>
          <input class="btn btn-info" type="submit" value="Update Cart" name="update_cart">
          <input class="btn btn-danger" type="submit" value="Remove Selected" name="remove_cart">
        </div>
        <?php endif; ?>
      </div>

      <!-- Totals -->
      <?php if ($num_cart_items > 0): ?>
      <div class="col-lg-4">
        <div class="border p-4">
          <h5 class="mb-4">Cart Totals</h5>
          <div class="d-flex justify-content-between mb-2">
            <span class="text-muted">Subtotal</span>
            <span><i class="fa-solid fa-indian-rupee-sign"></i><?php echo number_format($total, 2) ?></span>
          </div>
          <hr>
          <div class="mb-3">
            <span class="d-block mb-2 fw-bold">Shipping To</span>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" id="free_shipping">
              <label class="form-check-label" for="free_shipping">Free shipping</label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" id="flat_rate">
              <label class="form-check-label" for="flat_rate">Flat rate: ₹49</label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" id="local_pickup">
              <label class="form-check-label" for="local_pickup">Local pickup: ₹8</label>
            </div>
          </div>
          <hr>
          <div class="d-flex justify-content-between mb-2">
            <span class="text-muted">Platform fee</span>
            <span>₹1</span>
          </div>
          <div class="d-flex justify-content-between fw-bold mb-4">
            <span>Total</span>
            <span><i class="fa-solid fa-indian-rupee-sign"></i><?php echo number_format($total + 1, 2) ?></span>
          </div>
          <a href="./users_area/checkout.php" class="btn btn-info w-100">Proceed to Checkout</a>
        </div>
      </div>
      <?php endif; ?>
    </div>
    </form>
  </div>

  <!-- Remove Items Handler -->
  <?php
  if(isset($_POST['remove_cart'])){
    if(isset($_POST['remove_item'])){
      foreach($_POST['remove_item'] as $remove_id){
        $delete_query = "DELETE FROM cart_details WHERE product_id=$remove_id AND ip_address='$ip'";
        mysqli_query($con, $delete_query);
      }
      echo "<script>window.open('cart.php','_self')</script>";
    }
  }

  if(isset($_POST['update_cart'])){
    foreach($_POST['qty'] as $product_id => $qty){
      $qty = intval($qty);
      if($qty < 1) $qty = 1;
      $update = "UPDATE cart_details SET quantity=$qty WHERE ip_address='$ip' AND product_id=$product_id";
      mysqli_query($con, $update);
    }
    echo "<script>window.location.href='cart.php';</script>";
  }
  ?>

  <!-- Footer -->
  <footer class="bg-info text-center p-3 mt-4">
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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    const increaseBtns = document.querySelectorAll('.quantity-increase');
    const decreaseBtns = document.querySelectorAll('.quantity-decrease');

    increaseBtns.forEach(button => {
      button.addEventListener('click', function() {
        const input = this.parentElement.querySelector('.quantity-input');
        input.value = parseInt(input.value) + 1;
      });
    });

    decreaseBtns.forEach(button => {
      button.addEventListener('click', function() {
        const input = this.parentElement.querySelector('.quantity-input');
        if (parseInt(input.value) > 1) {
          input.value = parseInt(input.value) - 1;
        }
      });
    });
  });
</script>

</body>
</html>
