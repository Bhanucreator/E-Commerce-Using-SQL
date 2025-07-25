<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
  <title>Verify OTP</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f4f7fa;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    .otp-box {
      max-width: 420px;
      margin: 100px auto;
      padding: 35px 30px;
      background-color: white;
      border-radius: 15px;
      box-shadow: 0 8px 24px rgba(0,0,0,0.08);
    }
    .otp-box h3 {
      font-weight: 600;
      color: #0d6efd;
    }
    .form-control {
      width: 75%;
      margin: 0 auto 15px auto;
      text-align: center;
      font-weight: bold;
      font-size: 1.3rem;
      border-radius: 8px;
      border: 2px solid #dee2e6;
      transition: border-color 0.3s, box-shadow 0.3s;
    }
    .form-control:focus {
      border-color: #0d6efd;
      box-shadow: 0 0 5px rgba(13, 110, 253, 0.3);
    }
    .btn-info {
      background-color: #0dcaf0;
      color: white;
      border-radius: 8px;
      font-weight: 600;
      font-size: 1rem;
    }
    .btn-info:hover {
      background-color: #31d2f2;
    }
    .resend-link {
      text-align: center;
      margin-top: 18px;
      font-size: 0.95rem;
    }
    .resend-link a {
      text-decoration: none;
      color: #0d6efd;
      font-weight: 500;
    }
    .resend-link a:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>
  <div class="otp-box">
    <h3 class="text-center mb-4">Email Verification</h3>
    <form method="post" action="process_registration.php">
      <label class="form-label text-center d-block mb-3">Enter the 6-digit OTP sent to your email</label>
      <input type="text" class="form-control" name="otp" maxlength="6" required>

      <button type="submit" class="btn btn-info mt-3 w-100">Verify & Register</button>

      <div class="resend-link">
        <p>Didn't receive the code? <a href="resend_otp.php">Resend OTP</a></p>
      </div>
    </form>
  </div>
</body>
</html>
