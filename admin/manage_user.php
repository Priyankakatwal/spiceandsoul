<?php 
include('partials/menu.php');
?>
    <div class="maincontent">
        <div class="wrapper-order">
            <h1>Registered Users</h1>
          <?php
            if(isset($_SESSION['delete']))
{
    echo $_SESSION['delete'];
    unset($_SESSION['delete']);
}
?>
            
            <table class="tbl_full">
                <tr>
                    <th>S.N.</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Action</th>
                </tr>
                <?php
                $select= "select * from users";
                $res=mysqli_query($con,$select) or die("selection error");
                $sn=1;
                if(mysqli_num_rows($res)!=0){
                    while($rows=mysqli_fetch_assoc($res)){
                        $uname=$rows['username'];
                        $email=$rows['email'];
                        $id= $rows['id'];
             
                ?>

                <tr>
                    <td><?php echo $sn++; ?></td>
                    <td><?php echo $uname;?></td>
                    <td><?php echo $email;?></td>
                    <td><a href="<?php echo SITEURL; ?>admin/delete_user.php?id=<?php echo $id; ?>" class="btn-delete"> Delete User</a></td>
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