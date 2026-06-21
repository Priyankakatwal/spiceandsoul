<?php
include('../connection/connect.php');
?>
<?php
$id=$_GET['id'];
$del= "delete from admin_tbl where id=$id";
$res=mysqli_query($con,$del);
if($res==TRUE){
    $_SESSION['delete']="Admin deleted successfully";
    header('location:'.SITEURL.'admin/admin_page.php');
}
else{
    $_SESSION['delete']="Failed to delete admin";
    header('location'.SITEURL.'admin/admin_delete.php');
}
?>

