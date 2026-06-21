<?php
 include('../connection/connect.php');
if(isset($_GET['id'])){


$id=$_GET['id'];


$delete= "delete from order_tbl where id=$id";
$execute=mysqli_query($con,$delete) or die("Deletion error");
if($execute==TRUE){
    $_SESSION['delete']="Order deleted successfully";
    header('location:'.SITEURL.'admin/manage_order.php');
}
else{
    $_SESSION['delete']="Failed to delete order.";
    header('location:'.SITEURL.'admin/delete_order.php');
}
}
else{
    header('location:'.SITEURL.'admin/manage_order.php');
}
?>
