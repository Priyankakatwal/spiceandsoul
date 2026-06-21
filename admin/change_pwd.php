<?php
include('partials/menu.php');
?>
<div class="maincontent">
    <div class="wrapper">
        <h1>Change password</h1>
        <?php if(isset($_SESSION['pwd-not-match'])){
                echo $_SESSION['pwd-not-match'];
                unset($_SESSION['pwd-not-match']);
            }
        
        if(isset($_GET['id'])){
            $id=$_GET['id'];
        }
        ?>
        <form action="" method="POST">
            <table class="tbl-30">
            <tr>
                <td>Current password:</td>
                <td><input type="password" name="cur" required pattern=".{8,}" 
                     title="Password must be at least 8 characters long"></td>
            </tr>
            <tr>
                <td>New password:</td>
                <td><input type="password" name="new" required pattern=".{8,}" 
                     title="Password must be at least 8 characters long"></td>
            </tr>
            <tr>
                <td>Confirm password:</td>
                <td><input type="password" name="confirm" required pattern=".{8,}" 
                     title="Password must be at least 8 characters long"></td>
            </tr>
            <tr>
                <td colspan="2">
                    <input type="hidden" name="id" value="<?php echo $id;?>">
                    <input type="submit" class="btn-pwd" name="change" value="Change"></td>
            </tr>
            </table>
        </form>
    </div>
</div>
<?php
if(isset($_POST['change']))
{
    $id=$_POST['id'];
    $cur=md5($_POST['cur']);
    $new=md5($_POST['new']);
    $confirm=md5($_POST['confirm']);

$select="select * from admin_tbl where id=$id and password='$cur'";
$res= mysqli_query($con,$select) or die("selection error");
if($res==TRUE){
    $count=mysqli_num_rows($res);
    if($count==1){
        if($new==$confirm){
            $update="update admin_tbl set password='$new' where id=$id";
            $result=mysqli_query($con,$update) or die("update error");
            if($result==TRUE)
            {
                $_SESSION['pwd-change']="Password Changed";
                header('location:'.SITEURL.'admin/admin_page.php');
            }
            else{
                $_SESSION['pwd-change']="Failed to change password";
                header('location:'.SITEURL.'admin/admin_page.php');
            }

        }
        else{
            $_SESSION['pwd-not-match']="Password didnot match";
            header('location:'.SITEURL.'admin/change_pwd.php');
        }
    }
else{
    $_SESSION['user-not-found']="User not found";
    header('location:'.SITEURL.'admin/admin_page.php');
}
}
}
?>
<?php
include('partials/footer.php');
?>