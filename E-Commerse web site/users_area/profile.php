<?php
include('../includes/connect.php');
include('../functions/common_function.php');
session_start();

// Ensure user_id and username are set for the profile section if logged in
$user_id = null;
$username = 'Guest';
$user_details = null; // Initialize user_details

if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    // Assuming user_id is also stored in session upon login
    if (isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id'];
        // Function to get user details (assuming it's in common_function.php or defined here)
        function getUserDetails($con, $user_id) {
            $query = "SELECT * FROM user_table WHERE user_id = $user_id"; // Assuming 'user_table' holds user details
            $result = mysqli_query($con, $query);
            if ($result && mysqli_num_rows($result) > 0) {
                return mysqli_fetch_assoc($result);
            }
            return null;
        }
        $user_details = getUserDetails($con, $user_id);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LocoNeX E-commerce</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome CDN for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Google Font: Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color:white; 
        }
        .logo {
            height: 40px; 
            width: auto;
            border-radius: 8px; 
        }
        .sidebar-link {
            transition: all 0.2s ease-in-out;
        }
        .sidebar-link:hover {
            background-color: white; 
            transform: translateX(5px);
        }
        .active-link {
            background-color:#00D4FF; 
            color: white;
            font-weight: 600;
        }
        .active-link:hover {
            background-color:white; 
        }
        /* Custom styles for the search input to match the design */
        .search-input {
            border-radius: 0.5rem; 
            border: 1px solid white;
            padding: 0.5rem 0.75rem;
            outline: none;
            transition: all 0.2s ease-in-out;
        }
        .search-input:focus {
            border-color: #00D4FF; 
            box-shadow: #00D4FF; 
        }
        .btn-custom-blue {
        background-color: #00D4FF !important;
        color: white;
    }
    </style>
</head>
<body class="min-h-screen flex flex-col">

    <!-- Navbar -->
    <nav class="btn btn-custom-blue  p-4">
        <div class="container mx-auto flex flex-wrap justify-between items-center">
            <!-- Logo -->
            <a href="../index.php" class="flex items-center space-x-2">
                <img src="../images/removed_bg_-removebg-preview.png" alt="LocoNeX Logo" class="logo">
               
            </a>

            <!-- Navbar Toggler for mobile (hidden on desktop) -->
            <button class="lg:hidden text-white focus:outline-none" type="button" onclick="document.getElementById('navbarSupportedContent').classList.toggle('hidden')">
                <i class="fas fa-bars text-xl"></i>
            </button>

            <!-- Navbar Content -->
            <div class="hidden lg:flex flex-grow items-center justify-between mt-4 lg:mt-0" id="navbarSupportedContent">
                <ul class="flex flex-col lg:flex-row lg:space-x-6 space-y-2 lg:space-y-0 text-lg">
                    <li class="nav-item text-dark"><a class="" href="../index.php">Home</a></li>
                    <li class="nav-item bg-info"><a class="nav-link hover:text-blue-200 transition duration-200" href="../display_all.php">Products</a></li>
                    <li class="nav-item"><a class="nav-link hover:text-blue-200 transition duration-200" href="profile.php">Account</a></li>
                    <li class="nav-item"><a class="nav-link hover:text-blue-200 transition duration-200" href="#">Contact</a></li>
                    <li class="nav-item">
                        <a class="nav-link relative hover:text-blue-200 transition duration-200" href="../cart.php">
                            <i class="fa-solid fa-cart-shopping"></i>
                            <span class="absolute -top-1 -right-2 bg-red-500 text-white text-xs font-bold rounded-full h-5 w-5 flex items-center justify-center">
                                <?php cart_item(); ?>
                            </span>
                        </a>
                    </li>
                    <li class="nav-item"><a class="nav-link hover:text-blue-200 transition duration-200" href="#">Total: ₹<?php total_cart_price(); ?>/-</a></li>
                </ul>

                <!-- Search Form -->
                <form class="flex items-center mt-4 lg:mt-0 lg:ml-auto" action="../search_product.php" method="get">
                    <input class="search-input mr-2 text-gray-800" type="search" placeholder="Search products..." name="search_data">
                    <button type="submit" class="bg-blue-700 hover:bg-blue-800 text-white px-4 py-2 rounded-md shadow-md transition duration-200" name="search_data_product">
                        Search
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <!-- Calling cart function (if applicable, ensure it's defined in common_function.php) -->
    <?php cart(); ?>

   
    

    <!-- Main Content Area: Flex container for sidebar and main content -->
    <div class="flex flex-grow container mx-auto mt-8 mb-8 p-4 bg-white rounded-lg shadow-xl">

        <!-- Sidebar (Left Column) -->
        <aside class="w-1/4 bg-gradient-to-br from-blue-600 to-blue-800 p-6 rounded-l-lg shadow-inner flex flex-col justify-between">
            <div>
                <!-- Profile Header -->
                <div class="text-center mb-8">
                    <?php
                    $display_username = isset($username) ? htmlspecialchars($username) : 'Guest User';
                    $user_initial = strtoupper(substr($display_username, 0, 1));
                    $user_image_url = "https://placehold.co/150x150/a78bfa/ffffff?text=" . $user_initial;
                    ?>
                    <img src="<?php echo $user_image_url; ?>" alt="<?php echo $display_username; ?>'s Profile"
                         class="w-28 h-28 rounded-full object-cover mx-auto mb-4 border-4 border-blue-200 shadow-lg">
                    <h2 class="text-2xl font-bold text-white mb-1"><?php echo $display_username; ?></h2>
                    <?php if ($user_details && isset($user_details['user_email'])): ?>
                        <p class="text-sm text-blue-200"><?php echo htmlspecialchars($user_details['user_email']); ?></p>
                    <?php endif; ?>
                </div>

                <!-- Navigation Links -->
                <nav>
                    <ul class="space-y-2">
                        <li class="nav-item">
                            <a href="profile.php?my_orders" class="sidebar-link flex items-center p-3 rounded-md text-blue-100 hover:text-white hover:bg-blue-700
                               <?php echo (!isset($_GET['edit_account']) && !isset($_GET['pending_orders']) && !isset($_GET['delete_account']) && !isset($_GET['my_wishlist']) && !isset($_GET['logout']) && !isset($_GET['recommendations'])) ? 'active-link' : ''; ?>">
                                <i class="fas fa-box mr-3 text-lg"></i> My Orders
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="profile.php?pending_orders" class="sidebar-link flex items-center p-3 rounded-md text-blue-100 hover:text-white hover:bg-blue-700
                               <?php echo (isset($_GET['pending_orders'])) ? 'active-link' : ''; ?>">
                                <i class="fas fa-hourglass-half mr-3 text-lg"></i> Pending Orders
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="profile.php?recommendations" class="sidebar-link flex items-center p-3 rounded-md text-blue-100 hover:text-white hover:bg-blue-700
                               <?php echo (isset($_GET['recommendations'])) ? 'active-link' : ''; ?>">
                                <i class="fas fa-magic mr-3 text-lg"></i> ✨ Product Recommendations
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="profile.php?edit_account" class="sidebar-link flex items-center p-3 rounded-md text-blue-100 hover:text-white hover:bg-blue-700
                               <?php echo (isset($_GET['edit_account'])) ? 'active-link' : ''; ?>">
                                <i class="fas fa-user-edit mr-3 text-lg"></i> Edit Account
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="profile.php?my_wishlist" class="sidebar-link flex items-center p-3 rounded-md text-blue-100 hover:text-white hover:bg-blue-700
                               <?php echo (isset($_GET['my_wishlist'])) ? 'active-link' : ''; ?>">
                                <i class="fas fa-heart mr-3 text-lg"></i> My Wishlist
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="profile.php?delete_account" class="sidebar-link flex items-center p-3 rounded-md text-blue-100 hover:text-white hover:bg-red-600
                               <?php echo (isset($_GET['delete_account'])) ? 'active-link' : ''; ?>">
                                <i class="fas fa-trash-alt mr-3 text-lg"></i> Delete Account
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
            <!-- Logout Button at the bottom of the sidebar -->
            <div class="mt-8">
                <a href="logout.php" class="sidebar-link flex items-center justify-center p-3 rounded-md bg-white text-red-600 font-semibold shadow-md hover:bg-red-100 hover:text-red-700">
                    <i class="fas fa-sign-out-alt mr-2"></i> Logout
                </a>
            </div>
        </aside>

        <!-- Main Content Area (Right Column) -->
        <section class="w-3/4 p-8 bg-white rounded-r-lg">
            <!-- This area will dynamically load content based on sidebar selection -->
            <?php
            // Corrected conditional includes for profile sections
            if (isset($_GET['my_orders'])) {
                include('user_orders.php');
            } elseif (isset($_GET['pending_orders'])) {
                include('pending_orders.php');
            } elseif (isset($_GET['recommendations'])) {
                include('product_recommendations.php'); // New file for product recommendations
            } elseif (isset($_GET['edit_account'])) {
                include('edit_account.php');
            } elseif (isset($_GET['my_wishlist'])) {
                echo "<h3 class='text-2xl font-semibold mb-4 text-gray-800'>My Wishlist</h3>";
                echo "<p class='text-gray-600'>Your wishlist will appear here.</p>";
                // You would typically include a file like include('my_wishlist.php'); here
            } elseif (isset($_GET['delete_account'])) {
                include('delete_account.php');
            } else {
                // Default view when no specific parameter is set
                include('user_orders.php');
            }
            ?>
        </section>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-800 text-gray-300 p-6 text-center text-sm">
        <p>&copy; <?php echo date('Y'); ?> LocoNeX. All rights reserved. |
            <a href="#" class="text-blue-400 hover:underline">Terms of Service</a> |
            <a href="#" class="text-blue-400 hover:underline">Privacy Notice</a>
        </p>
        <p class="mt-2">
            Contact us: <a href="https://mail.google.com/mail/?view=cm&fs=1&to=tech.pheonix03@gmail.com&su=SUBJECT&body=BODY" class="text-blue-400 hover:underline">support@LocoNeX.com</a><br>
            <a href="https://chat.whatsapp.com/JifnVdOB7ZVCY8bqG81wyf" class="text-blue-400 hover:underline">WhatsApp</a> |
            <a href="https://www.facebook.com/tech.pheonix03" class="text-blue-400 hover:underline">Facebook</a> |
            <a href="https://www.instagram.com/tech.pheonix/profilecard/?igsh=OWg0OXo1Y3FtbGJ4" class="text-blue-400 hover:underline">Instagram</a> |
            <a href="https://x.com/Tech_Pheonix3" class="text-blue-400 hover:underline">X (Twitter)</a>
        </p>
    </footer>

    <!-- Voiceflow Chat Widget Script -->
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

</body>
</html>
