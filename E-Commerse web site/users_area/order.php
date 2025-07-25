<?php
include('../includes/connect.php');
include('../functions/common_function.php');

if(isset($_GET['user_id'])){
    $user_id = $_GET['user_id'];
} else {
    // Handle case where user_id is not provided, maybe redirect or show an error
    echo "<script>alert('User ID not provided. Cannot process order.')</script>";
    echo "<script>window.open('index.php','_self')</script>";
    exit();
}

// Get the user's IP address
$get_ip_address = getIPAddress();

// Initialize subtotal and product count for the main order
$subtotal = 0;
$count_product = 0;

// Query to get product details and quantity from the cart for the current IP address
// Joining cart_details with products table to get product prices
$cart_query_items = "SELECT cd.product_id, cd.quantity, p.product_price FROM cart_details cd JOIN products p ON cd.product_id = p.product_id WHERE cd.ip_address='$get_ip_address'";
$result_cart_items = mysqli_query($con, $cart_query_items);

// Check for query execution errors
if (!$result_cart_items) {
    echo "<script>alert('Error fetching cart details for main order: " . mysqli_error($con) . "')</script>";
    echo "<script>window.open('checkout.php','_self')</script>";
    exit();
}

// Get the number of distinct products in the cart for the main order
$count_product = mysqli_num_rows($result_cart_items);

// Calculate the total subtotal based on product price and quantity
if ($count_product > 0) {
    // Reset result pointer to reuse for subtotal calculation
    mysqli_data_seek($result_cart_items, 0);
    while ($row_item = mysqli_fetch_array($result_cart_items)) {
        $product_price = $row_item['product_price'];
        $item_quantity = $row_item['quantity'];
        $subtotal += ($product_price * $item_quantity+1);
    }
} else {
    // If the cart is empty, inform the user and redirect
    echo "<script>alert('Your cart is empty. Please add items before placing an order.')</script>";
    echo "<script>window.open('index.php','_self')</script>";
    exit();
}

// Generate a random invoice number
$invoice_number = mt_rand();
// Define the order status as a string
$status = 'pending';

// Insert the order details into the user_orders table
// IMPORTANT: Ensure 'user_id' is the correct column name in your 'user_orders' table
// If 'order_id' is an auto-increment primary key, remove it from the column list.
$insert_orders = "INSERT INTO user_orders (user_id, amount_due, invoice_number, total_products, order_date, order_status) VALUES ($user_id, $subtotal, $invoice_number, $count_product, NOW(), '$status')";
$result_query = mysqli_query($con, $insert_orders);

// Check if the order insertion was successful
if($result_query){
    echo "<script>alert('Orders are submitted successfully')</script>";

    // --- Insert into order_pending table for each product ---
    // Reset result pointer again to iterate for pending orders
    mysqli_data_seek($result_cart_items, 0);
    while ($row_item_pending = mysqli_fetch_array($result_cart_items)) {
        $product_id_pending = $row_item_pending['product_id'];
        $quantity_pending = $row_item_pending['quantity'];

        $insert_pending_orders = "INSERT INTO order_pending (user_id, invoice_number, product_id, quantity, order_status) VALUES ($user_id, $invoice_number, $product_id_pending, $quantity_pending, '$status')";
        $result_pending_orders = mysqli_query($con, $insert_pending_orders);

        if (!$result_pending_orders) {
            echo "<script>alert('Error inserting into order_pending for product ID $product_id_pending: " . mysqli_error($con) . "')</script>";
            // You might want to log this error and decide if it should stop the entire process
            error_log("Order pending insertion failed for product ID $product_id_pending. Query: " . $insert_pending_orders . " Error: " . mysqli_error($con));
            // Do not exit here if you want to try inserting other pending items
        }
    }

    // After successful order and pending order insertions, clear the cart for the user's IP address
    $empty_cart_query = "DELETE FROM cart_details WHERE ip_address='$get_ip_address'";
    $result_empty_cart = mysqli_query($con, $empty_cart_query);

    if (!$result_empty_cart) {
        // Log an error if clearing the cart fails (this won't stop the order, but is good for debugging)
        error_log("Failed to clear cart for IP: $get_ip_address - " . mysqli_error($con));
    }

    echo "<script>window.open('profile.php','_self')</script>";
} else {
    // If main order insertion fails, display the MySQL error for debugging
    echo "<script>alert('Error submitting main order: " . mysqli_error($con) . "')</script>";
    // Optionally, log the full query for server-side debugging
    error_log("Main order insertion failed. Query: " . $insert_orders . " Error: " . mysqli_error($con));
    echo "<script>window.open('checkout.php','_self')</script>"; // Redirect back to checkout or an error page
}
?>
