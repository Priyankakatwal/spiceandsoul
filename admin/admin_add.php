<?php
include('partials/menu.php');
?>
<script>
function validateEmail() {
  email = document.getElementById('email').value;
  if (email.includes("@") && email.includes(".")) {
    return true;
  } else {
    alert("Please enter a valid email with a domain like .com");
    return false;
  }
}
</script>
<div class="maincontent">
    <div class="wrapper">
        <h1>Add admin</h1>
        <br>
        <?php if(isset($_SESSION['add'])){
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }
            ?>
        <form action="" method="POST" onsubmit="return validateEmail()">
            <table>
                <tr>
                    <td>Fullname:</td>
                    <td><input type="text" name="fullname" pattern="^[A-Za-z\s]+$" title="Only letters and spaces allowed"required></td>
                </tr>
                  <tr>
                    <td>Email:</td>
                    <td><input type="email" id= "email" name="email" required></td>
                </tr>
                <tr>
                    <td>Username:</td>
                    <td><input type="text" name="username" required></td>
                </tr>
                <tr>
                    <td>Password:</td>
                    <td><input type="password" name="pwd" required  pattern=".{8,}" 
                     title="Password must be at least 8 characters long"></td>
                </tr>
                <tr>
                    <td><input type="submit"  class= "btn-add" name="submit" value="Add Admin"></td>
                </tr>
                
            </table>
        </form>
    </div>
</div>


<?php
include('partials/footer.php');
?>
<?php
if (isset($_POST['submit']))
{
     $fullname=$_POST['fullname'];
     $uname= $_POST['username'];
     $pwd= md5($_POST['pwd']);
    $email= $_POST['email'];

$insert="insert into admin_tbl(full_name,username,password,email) values ('$fullname','$uname','$pwd','$email')";
$res= mysqli_query($con,$insert) or die ("insertion error");

if($res==TRUE)
{
   $_SESSION['add']="Admin added successfully";
   header("location:".SITEURL.'admin/admin_page.php');
}
 else
{
    $_SESSION['add']="Failed to add admin";
    header("location:".SITEURL.'admin/admin_page/admin_add.php');
}
}

?>