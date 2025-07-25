<?php
session_start();
require('../PHPMailer/PHPMailer.php');
require('../PHPMailer/SMTP.php');
require('../PHPMailer/Exception.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if (!isset($_SESSION['user_data'])) {
    echo "<script>alert('No session data found. Please register again.'); window.location.href='register.php';</script>";
    exit();
}

$data = $_SESSION['user_data'];
$new_otp = rand(100000, 999999);
$_SESSION['otp'] = $new_otp;

$mail = new PHPMailer(true);
try {
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'tech.pheonix03@gmail.com';
    $mail->Password = 'vdoc ghoi tyrb csaq';//mail password
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;

    $mail->setFrom('tech.pheonix03@gmail.com', 'LocoNeX');
    $mail->addAddress($data['user_email']);
    $mail->isHTML(true);
    $mail->Subject = 'Resent OTP for Registration';
    $mail->Body = "Hi {$data['user_username']},<br><br>Your new OTP is <strong>$new_otp</strong>.<br><br>Thanks!<br><strong>LocoNex Team</strong>";

    $mail->send();
    echo "<script>alert('OTP resent successfully!'); window.location.href='verify_otp.php';</script>";
} catch (Exception $e) {
    echo "Resend OTP Error: " . $mail->ErrorInfo;
}
?>
