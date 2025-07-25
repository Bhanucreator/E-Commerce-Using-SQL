<?php
session_start();
require('../includes/connect.php');
require('../functions/common_function.php');

if (!isset($_POST['otp']) || !isset($_SESSION['otp']) || !isset($_SESSION['user_data'])) {
    echo "<script>alert('Invalid access.'); window.location.href='register.php';</script>";
    exit();
}

$submitted_otp = trim($_POST['otp']);
$stored_otp = $_SESSION['otp'];

if ($submitted_otp != $stored_otp) {
    echo "<script>alert('Invalid OTP!'); window.location.href='verify_otp.php';</script>";
    exit();
}

// Get user data from session
$data = $_SESSION['user_data'];
$file = $_SESSION['user_file'];

$username = $data['user_username'];
$email = $data['user_email'];
$password_raw = $data['user_password'];
$conf_password = $data['conf_user_password'];
$address = $data['user_address'];
$contact = $data['user_contact'];
$user_ip = getIPAddress();

// Defensive check again
if ($password_raw !== $conf_password) {
    echo "<script>alert('Passwords do not match'); window.location.href='register.php';</script>";
    exit();
}

$hashed_password = password_hash($password_raw, PASSWORD_BCRYPT);
$image_name = $file['name'];
$image_tmp = $file['tmp_name'];
move_uploaded_file($image_tmp, "./user_images/$image_name");

// Insert into database
$query = "INSERT INTO user_table (user_name, user_email, user_password, user_image, user_ip, user_address, user_mobile)
          VALUES ('$username', '$email', '$hashed_password', '$image_name', '$user_ip', '$address', '$contact')";

$result = mysqli_query($con, $query);

if ($result) {
    // Clean up
    unset($_SESSION['otp']);
    unset($_SESSION['user_data']);
    unset($_SESSION['user_file']);

    echo "<script>alert('Registration successful!'); window.location.href='user_login.php';</script>";
} else {
    echo "Error: " . mysqli_error($con);
}
?>
