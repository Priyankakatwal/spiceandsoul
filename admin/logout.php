<?php
include('../connection/connect.php');
session_destroy();
header('location:'.SITEURL.'admin/food_login.php');
?>
