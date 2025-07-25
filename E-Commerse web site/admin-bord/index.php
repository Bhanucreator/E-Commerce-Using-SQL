<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Board</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    <link rel="stylesheet" href="style1.css" class="css" >
    <style>
.footer{
    position:absolute;
    bottom:0;
    
}
.admin_image {
  width: 100px;
  object-fit: contain;
  border-radius: 8px;
}
.btn {
  min-width: 150px;
}

 </style>
</head>
<body>
  <div class="container-fluid p-0">
    <nav class="navbar navbar-expand-lg navbar-light bg-info">
        <div class="container-fluid">
            <img src="removed_bg_-removebg-preview.png" alt=""class="logo">
            <nav class="navbar navbar-expand-lg">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a href="" class="nav-link"><h4>Welcome To LocoNeX Community</h4></a>
                    </li>
                </ul>
            </nav>
        </div>
    </nav>

    <!--second child-->
    <div class="bg-light">
        <h3 class="text-center p-2">Manage Details</h3>
    </div>

    <!--third child-->
    <div class="row">
  <div class="col-md-12 bg-secondary p-3 d-flex align-items-start gap-4 flex-wrap">
    
    <!-- Admin Image & Name -->
    <div class="text-center">
      <a href="#"><img src="shops.webp" alt="Admin" class="admin_image mb-2" style="width: 100px;"></a>
      <p class="text-light mb-0">Amruth K A</p>
    </div>

    <!-- Buttons -->
    <div class="d-flex flex-wrap gap-2">
      <a href="insert_product.php" class="btn btn-info text-light">Insert Products</a>
      <a href="#" class="btn btn-info text-light">View Products</a>
     <!-- <a href="index.php?insert_catogory" class="btn btn-info text-light">Insert Categories</a>-->
      <!--<a href="#" class="btn btn-info text-light">View Categories</a>-->
      <!--<a href="index.php?insert_brand" class="btn btn-info text-light">Insert Brands</a>-->
      <!--<a href="#" class="btn btn-info text-light">View Brands</a>-->
      <a href="#" class="btn btn-info text-light">All Orders</a>
      <a href="#" class="btn btn-info text-light">All Payments</a>
      <a href="#" class="btn btn-info text-light">List Users</a>
      <a href="#" class="btn btn-danger text-light">Logout</a>
    </div>

  </div>
</div>


    <div class="bg-info p-3 text-center footer">
    <p>All right reserved @-Desined by Bhanu-2025</p>
</div>
  </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
</body>
</html>