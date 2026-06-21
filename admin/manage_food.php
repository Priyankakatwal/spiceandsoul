<?php 
include('partials/menu.php');
?>
    <div class="maincontent">
        <div class="wrapper-order">
            <h1>Manage Menu</h1>
           
            <?php
            if(isset($_SESSION['add']))
{
    echo $_SESSION['add'];
    unset($_SESSION['add']);
}

if(isset($_SESSION['delete']))
{
    echo $_SESSION['delete'];
    unset($_SESSION['delete']);
}

if(isset($_SESSION['update']))
{
    echo $_SESSION['update'];
    unset($_SESSION['update']);
}
if(isset($_SESSION['food-not-found']))
{
    echo $_SESSION['food-not-found'];
    unset($_SESSION['food-not-found']);
}
?>
 <br>
            <br>
            <a href="add-food.php" class="btn-add">Add Menu Item</a>
            <br><br>
            <table class="tbl_full">
                <tr>
                    <th>S.N.</th>
                    <th>Title</th>
                    <th>Price</th>
                    <th>Image</th>
                    <th>Actions</th>
                </tr>
                <?php
                $sn=1;
                $select= "select * from menu_tbl";
                $res=mysqli_query($con,$select) or die("Selection error");
                if(mysqli_num_rows($res)!=0){
                    while($rows=mysqli_fetch_assoc($res))
                    {
                        $id=$rows['id'];
                        $title=$rows['title'];
                        $price=$rows['price'];
                        $img=$rows['image_name'];
             

                ?>
                <tr>
                   
                    <td><?php echo $sn++;?></td>
                    <td><?php echo $title;?></td>
                    <td><?php echo $price;?></td>
                    <td><img src="<?php echo SITEURL; ?>images/category/<?php echo $img;?>" width="50px"></td>
                    <td><a href="<?php echo SITEURL;?>admin/update-food.php?id=<?php echo $id;?>" class="btn-update">Update Menu Item</a>
                    <a href="<?php echo SITEURL;?>admin/delete-food.php?id=<?php echo $id;?>& imgname=<?php echo $img?>" class="btn-delete"> Delete Menu Item</a></td>
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