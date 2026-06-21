<?php
include('../connection/connect.php');
include('check-login.php');
?>
<html>
    <head>
    <title>Food Ordering Website</title>
    <link rel="stylesheet" href="../css/backend.css">
    </head>
    <body>
     <div class= "menu">
        
        <div class="wrapper">
            <ul>
                <li><a href="index.php">Dashboard</a></li>
                <li><a href="admin_page.php">Admin</a></li>
                <li><a href="manage_user.php">Users</a></li>
                <li><a href="manage_food.php">Menu</a></li>
                <li><a href="manage_category.php">Category</a></li>
                <li><a href="manage_order.php">Order</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </div>
        </div>