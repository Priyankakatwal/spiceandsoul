<?php
include('../connection/connect.php');
?>
<?php
$id=$_GET['id'];
$del= "delete from users where id=$id";
$res=mysqli_query($con,$del);
if($res==TRUE){
    $_SESSION['delete']="User deleted successfully.";
    header('location:'.SITEURL.'admin/manage_user.php');
}
else{
    $_SESSION['delete']="Failed to delete user.";
    header('location'.SITEURL.'admin/manage_user.php');
}
?>
