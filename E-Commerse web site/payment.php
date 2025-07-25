<?php 
include('includes/connect.php');
include('functions/common_function.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" crossorigin="anonymous" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <title>Payment</title>
    <style>
        img {
            width: 50%;
            display: block;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <?php
   // Get user's IP address and fetch user ID
    $user_ip = getIPAddress();
    $get_user = "SELECT * FROM user_table WHERE user_ip='$user_ip'";
    $result = mysqli_query($con, $get_user);

    if ($result && mysqli_num_rows($result) > 0) {
        $run_query = mysqli_fetch_assoc($result);
        $user_id = $run_query['user_id'];
    } else {
        $user_id = 0; // default if not found
    }
    ?>

    <div class="container">
        <h2 class="text-center text-info mt-4">Payment Options</h2>

        <div class="row justify-content-center my-4">
            <div class="col-md-6 text-center">
                <a href="https://www.paypal.com" target="_blank">
                    <img src="../images/payment1.png" alt="PayPal">
                </a>
            </div>
        </div>

        <div class="row justify-content-center mb-4">
            <div class="col-md-6 text-center">
                <a href="order.php?user_id=<?php echo $user_id; ?>">
                    <h2 class="text-success">Cash On Delivery</h2>
                </a>
            </div>
        </div>
    </div>
</body>
</html>
