<?php
// Only start session if not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Only define SITEURL if not already defined
if (!defined('SITEURL')) {
    define('SITEURL', 'http://localhost/food/');
}

// Database connection
$con = mysqli_connect('localhost', 'root', '', 'food');

// Check connection
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
