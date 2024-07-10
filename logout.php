<?php
session_start(); // Start the session

if (session_status() == PHP_SESSION_ACTIVE) {
    session_unset(); // Unset all session variables
    session_destroy(); // Destroy the session
}

header("Location: index.php"); // Redirect to the login page or home page
exit();
?>
