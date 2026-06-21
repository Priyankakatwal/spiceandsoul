<?php
include('connection/connect.php');
session_destroy();
header('location:'.SITEURL.'login.php');
?>
