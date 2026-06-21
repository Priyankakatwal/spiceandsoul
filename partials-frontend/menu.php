<?php
include('connection/connect.php');
include('userlogincheck.php');

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
                    <li><a href="<?php echo SITEURL?>">Home</a></li>
                    <li><a href="<?php echo SITEURL?>about.php">About</a></li>
                    <li><a href="<?php echo SITEURL?>food.php">Foods</a></li>
                    <li><a href="<?php echo SITEURL?>contact.php">ContactUs</a></li>
                    <li><a href="<?php echo SITEURL?>userlogout.php">Logout</a></li>
                       <li><a href="<?php echo SITEURL?>cart.php">
                        <img src="<?php echo SITEURL;?>images/cart.png" width="24px" alt="cart">
                     </a></li>
                </ul>
        </div>
        <div class="clearfix">

        </div>
        </div>
    </section>