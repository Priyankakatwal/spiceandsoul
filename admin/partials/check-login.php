<?php
if(!isset($_SESSION['user']))
{
$_SESSION['nologin']= "Please login to access ";
header('location:'.SITEURL.'admin/food_login.php');
}
?>