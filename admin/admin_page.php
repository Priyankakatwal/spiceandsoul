<?php 
include('partials/menu.php');
?>
    <div class="maincontent">
        <div class="wrapper-order">
            <h1>Manage Admin</h1>
            
           <?php 
           if(isset($_SESSION['add'])){
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }
            if(isset($_SESSION['delete'])){
                echo $_SESSION['delete'];
                unset($_SESSION['delete']);
            }
            if(isset($_SESSION['update'])){
                echo $_SESSION['update'];
                unset($_SESSION['update']);
            }
            if(isset($_SESSION['user-not-found'])){
                echo $_SESSION['user-not-found'];
                unset($_SESSION['user-not-found']);
            }
           
            if(isset($_SESSION['pwd-change'])){
                echo $_SESSION['pwd-change'];
                unset($_SESSION['pwd-change']);
            }
           
            if(isset($_SESSION['login'])){
                echo $_SESSION['login'];
                unset($_SESSION['login']);
            }
        
            ?>
            <br>
            <br>
            <a href="admin_add.php" class="btn-add">Add Admin</a>
            <br><br>
            <table class="tbl_full">
                <tr>
                    <th>S.N.</th>
                    <th>Fullname</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Actions</th>
                </tr>
                <?php
                $select= "select * from admin_tbl";
                $res=mysqli_query($con,$select) or die("selection error");
                $sn=1;
                if(mysqli_num_rows($res)!=0){
                    while($rows=mysqli_fetch_assoc($res)){
                        $fullname=$rows['full_name'];
                        $email= $rows['email'];
                        $uname=$rows['username'];
                        $id= $rows['id'];
             
                ?>

                <tr>
                    <td><?php echo $sn++; ?></td>
                    <td><?php echo $fullname;?></td>
                    <td><?php echo $uname;?></td>
                   <td><?php echo $email;?></td>
                    <td><a href="<?php echo SITEURL;?>admin/admin_update.php?id=<?php echo $id; ?>"  class="btn-update">Update Admin</a>
                    <a href="<?php echo SITEURL; ?>admin/admin_delete.php?id=<?php echo $id; ?>" class="btn-delete"> Delete Admin</a>
                    <a href="<?php echo SITEURL; ?>admin/change_pwd.php?id=<?php echo $id; ?>" class="btn-pwd"> Change password</a></td>
                </tr>
                <?php
            }
        }
        ?>
            </table>

        </div>

    </div>
<?php 
include('partials/footer.php');
?>