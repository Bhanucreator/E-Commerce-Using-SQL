<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Super Admin Board</title>
  <!-- Bootstrap & FontAwesome -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" crossorigin="anonymous"/>

  <!-- Custom CSS -->
  <link rel="stylesheet" href="style1.css">
  <style>
    .admin_image {
      width: 100px;
      object-fit: contain;
      border-radius: 30px;
    }
    .btn {
      min-width: 150px;
    }
  </style>
</head>
<body class="d-flex flex-column min-vh-100">

  <div class="container-fluid p-0">
    <!-- Header -->
    <div class="bg-light">
      <h3 class="text-center p-2">Manage Platform Details</h3>
    </div>

    <!-- Sidebar + Buttons -->
    <div class="row">
      <div class="col-md-12 bg-secondary p-3 d-flex align-items-start gap-4 flex-wrap">
        <!-- Admin Image & Name -->
        <div class="text-center">
          <a href="#"><img src="removed_bg_-removebg-preview.png" alt="Admin" class="admin_image mb-2"></a>
          <p class="text-light mb-0">Loconex</p>
        </div>

        <!-- Menu Buttons -->
        <div class="d-flex flex-wrap gap-2">
          <a href="superadmin.php?insert_catogory" class="btn btn-info text-light">Insert Categories</a>
          <a href="#" class="btn btn-info text-light">View Categories</a>
          <a href="superadmin.php?insert_brand" class="btn btn-info text-light">Insert Brands</a>
          <a href="#" class="btn btn-info text-light">View Brands</a>
          <a href="#" class="btn btn-info text-light">All Payments</a>
          <a href="#" class="btn btn-info text-light">Verified Shops</a>
          <a href="#" class="btn btn-info text-light">Commission</a>
          <a href="#" class="btn btn-danger text-light">Logout</a>
        </div>
      </div>
    </div>

    <!-- Content Loader -->
    <div class="container my-3">
      <?php  
        if (isset($_GET['insert_catogory'])) {
          include('insert_catogories.php'); // ✅ exact filename match
        }
        if (isset($_GET['insert_brand'])) {
          include('insert_brands.php'); // ✅ exact filename match
        }
      ?>
    </div>
  </div>

  <!-- Footer -->
  <footer class="bg-info p-3 text-center mt-auto">
    <p class="mb-0">All rights reserved @-Designed by Bhanu-2025</p>
  </footer>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>
</html>
