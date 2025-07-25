<?php
session_start();          // Start the session
session_unset();          // Unset all session variables
session_destroy();        // Destroy the session

// Optional: Add a logout success message (if you want)
echo "<script>
    alert('You have been logged out successfully.');
    window.location.href = '../index.php';
</script>";
exit();
?>
