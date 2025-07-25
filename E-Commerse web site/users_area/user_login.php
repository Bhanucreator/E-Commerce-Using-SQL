<?php
session_start();
include('../includes/connect.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>User Login</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" crossorigin="anonymous" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous" />
  <style>
    body {
      background: linear-gradient(to right, #e2e2e2, #c9d6ff);
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      font-family: 'Montserrat', sans-serif;
    }
    .container {
      background-color: #fff;
      border-radius: 20px;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
      padding: 40px 30px;
      max-width: 700px;
      width: 100%;
    }
    h2.text-center {
      font-weight: 600;
      margin-bottom: 30px;
      color:#00D8FF;
    }
    .form-label {
      font-weight: 500;
    }
    .form-control {
      border-radius: 8px;
      background-color: #f1f1f1;
      border: 1px solid #ccc;
    }
    .form-control:focus {
      border-color:#00D8FF;
      box-shadow: 0 0 0 0.2rem rgba(81, 45, 168, 0.2);
    }
    .btn-info {
      background-color: #00D8FF;
      color: white;
      font-weight: 600;
      letter-spacing: 0.5px;
      border-radius: 8px;
      width: 100%;
      transition: background-color 0.3s;
    }
    .btn-info:hover {
      background-color: #00D8FF;
    }
    .text-danger {
      text-decoration: none;
    }
    .text-danger:hover {
      text-decoration: underline;
    }
    .fw-bold {
      text-align: center;
    }
    @media (max-width: 768px) {
      .container {
        padding: 25px 20px;
      }
    }
  </style>
</head>
<body>

<div class="container">
  <h2 class="text-center">User Login</h2>
  <form action="" method="post" enctype="multipart/form-data">
    <!-- Username -->
    <div class="form-outline mb-3">
      <label for="user_username" class="form-label">Username</label>
      <input type="text" id="user_username" class="form-control" placeholder="Enter Your Name" autocomplete="off" required name="user_username"/>
    </div>
    <!-- Password -->
    <div class="form-outline mb-3">
      <label for="user_password" class="form-label">Password</label>
      <input type="password" id="user_password" class="form-control" placeholder="Enter Your Password" autocomplete="off" required name="user_password"/>
    </div>
    <!-- Submit Button -->
    <div class="pt-2">
      <input type="submit" value="Login" class="btn btn-info py-2" name="user_login">
      <p class="small fw-bold mt-3 mb-0">Don't have an account? <a href="user_registration.php" class="text-danger">Register</a></p>
    </div>
  </form>
</div>

<?php
if (isset($_POST['user_login'])) {
    $user_username = mysqli_real_escape_string($con, $_POST['user_username']);
    $user_password = $_POST['user_password'];

    $select_query = "SELECT * FROM user_table WHERE user_name='$user_username'";
    $result = mysqli_query($con, $select_query);
    $row_count = mysqli_num_rows($result);

    if ($row_count > 0) {
        $row_data = mysqli_fetch_assoc($result);
        if (password_verify($user_password, $row_data['user_password'])) {
            // Set session after login success
            $_SESSION['username'] = $user_username;
            echo "<script>alert('Login Successful');</script>";
            echo "<script>window.location.href = '../index.php';</script>";
            exit();
        } else {
            echo "<script>alert('Invalid Credentials');</script>";
        }
    } else {
        echo "<script>alert('Invalid Credentials');</script>";
    }
}
?>

</body>
</html>
