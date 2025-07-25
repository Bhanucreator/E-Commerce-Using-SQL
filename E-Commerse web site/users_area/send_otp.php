<?php
session_start();
require('../includes/connect.php');
require('../PHPMailer/PHPMailer.php');
require('../PHPMailer/SMTP.php');
require('../PHPMailer/Exception.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if (isset($_POST['user_register'])) {
    $user_password = $_POST['user_password'];
    $conf_password = $_POST['conf_user_password'];

    // ✅ Password match check BEFORE sending OTP
    if ($user_password !== $conf_password) {
        echo "<script>alert('Passwords do not match.'); window.history.back();</script>";
        exit();
    }

    $otp = rand(100000, 999999);

    $_SESSION['otp'] = $otp;
    $_SESSION['user_data'] = $_POST;
    $_SESSION['user_file'] = $_FILES['user_image'];

    // Send OTP Email
    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'tech.pheonix03@gmail.com'; // your Gmail
        $mail->Password = 'vdoc ghoi tyrb csaq';          // app password
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        // ✅ Updated sender name to LocoNex
        $mail->setFrom('tech.pheonix03@gmail.com', 'LocoNeX');
        $mail->addAddress($_POST['user_email']);
        $mail->isHTML(true);
        $mail->Subject = 'Your OTP for Registration';
        $mail->Body = "Hi {$_POST['user_username']},<br><br>Your OTP is <strong>$otp</strong>.<br><br>Thanks!<br><strong>LocoNex Team</strong>";

        $mail->send();
        header('Location: verify_otp.php');
        exit();
    } catch (Exception $e) {
        echo "OTP Email Error: " . $mail->ErrorInfo;
    }
}
?>
