<?php
include('connection/connect.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Food Ordering Website</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <section class="navbar">
        <div class="container">
            <div class="logo">
                <img src="images/logo1.png" alt="logo" class="logoimg">
            </div>
            <div class="menu text-right">
                <ul>
                    <li><a href="<?php echo SITEURL?>home.php">Home</a></li>
                    <li><a class="btnlogin" href="<?php echo SITEURL?>login.php">Login</a></li>
                </ul>
        </div>
        <div class="clearfix">

        </div>
        </div>
    </section>