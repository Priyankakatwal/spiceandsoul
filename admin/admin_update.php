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
         <h1>Update Admin</h1>
        <?php
         if(isset($_GET['id'])){
         $id=$_GET['id'];
         $select= "select * from admin_tbl where id=$id";
         $res= mysqli_query($con,$select) or die("selection error");
         if (mysqli_num_rows($res)!==0){
            while($rows=mysqli_fetch_assoc($res)){
                $full_name=$rows['full_name'];
                $uname=$rows['username'];
                $email= $rows['email'];
            }

         }
}
         else{
            header('location:'.SITEURL.'admin/admin_page.php');
         }
        ?>
        <form action="" method="POST" onsubmit="return validateEmail()">
            <table class="tbl-30">
                <tr>
                    <td>Fullname:</td>
                    <td><input type="text" name="fullname" value="<?php echo $full_name;?>"pattern="^[A-Za-z\s]+$" title="Only letters and spaces allowed" required></td>
                </tr>
                <tr>
                    <td>Username:</td>
                    <td><input type="text" name="uname" value="<?php echo $uname;?>" required></td>
                </tr>
                   <tr>
                    <td>Email:</td>
                    <td><input type="email" id="email" name="email" value="<?php echo $email;?>" required></td>
                </tr>


                <tr> <td colspan="2">
                    <input type="hidden" name="id" value="<?php echo $id;?>" required>
                    <input type="submit"  name="submit" value="Update" class="btn-update" name="update">
                </td></tr>
            </table>
        </form>
    </div>
  </div>
  <?php
  if (isset($_POST['submit'])){
    $fullname= $_POST['fullname'];
    $uname= $_POST['uname'];
    $email= $_POST['email'];
    $update="UPDATE admin_tbl set
    full_name= '$fullname',
    username='$uname',
    email ='$email'
    where id='$id'
    ";
    $result= mysqli_query($con,$update) or die("Update error");
    if($result==TRUE){
        $_SESSION['update']="Admin updated successfully";
        header('location:'.SITEURL.'admin/admin_page.php');
    }
    else{
        $_SESSION['update']="Failed to update Admin";
        header('location:'.SITEURL.'admin/admin_update.php');
    }
  }
  ?>