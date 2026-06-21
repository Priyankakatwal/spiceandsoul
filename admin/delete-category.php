<?php
 include('../connection/connect.php');
 if(isset($_SESSION['delete'])){
    echo $_SESSION['delete'];
    unset($_SESSION['delete']);
}
if(isset($_GET['id']) AND isset($_GET['imgname'])){


$id=$_GET['id'];
$imgname=$_GET['imgname'];


$delete= "delete from categories_tbl where id=$id";
$execute=mysqli_query($con,$delete) or die("Deletion error");
if($execute==TRUE){
    $_SESSION['delete']="Category deleted successfully";
    header('location:'.SITEURL.'admin/manage_category.php');
}
else{
    $_SESSION['delete']="Failed to delete category.";
    header('location:'.SITEURL.'admin/delete-category.php');
}
}
else{
    header('location:'.SITEURL.'admin/manage_category.php');
}
?>
