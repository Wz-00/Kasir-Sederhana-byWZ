<?php
session_start();

require 'function.php';
if (isset($_COOKIE['remember_token'])) {
    $token = $_COOKIE['remember_token'];

    // Delete the token from the database
    $query = "UPDATE `login` SET `token`='', `expiry`=0 WHERE `token`='$token'";
    $conn->query($query);

    // Delete the remember me cookie
    setcookie("remember_token", "", time() - 3600);
}

// Clear session variables
session_unset();
session_destroy();

// Redirect to login.php
header("Location: login.php");
exit;
?>