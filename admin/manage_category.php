<?php 
include('partials/menu.php');
?>
    <div class="maincontent">
        <div class="wrapper-order">
            <h1>Manage Category</h1>
        
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

if(isset($_SESSION['upload']))
{
    echo $_SESSION['upload'];
    unset($_SESSION['upload']);
}
if(isset($_SESSION['category-not-found']))
{
    echo $_SESSION['category-not-found'];
    unset($_SESSION['category-not-found']);
}


?>
    <br>
            <br>
            <a href="add-category.php" class="btn-add">Add Category</a>
            <br><br>
            <table class="tbl_full">
                <tr>
                    <th>S.N.</th>
                    <th>Title</th>
                    <th>Image</th>
                    <th>Actions</th>
                </tr>
                <?php
                $select= "select * from categories_tbl";
                $res=mysqli_query($con,$select) or die("Selection error");
                $sn=1;
                if(mysqli_num_rows($res)!=0)
                {
                    while($rows=mysqli_fetch_assoc($res))
                    {
                        $id=$rows['id'];
                        $title=$rows['title'];
                        $imgname=$rows['image_name'];
                   
                
                ?>
                <tr>
                    <td><?php echo $sn++;?></td>
                    <td><?php echo $title;?></td>
                    <td>
                       <?php if($imgname!=''){
                          ?>
                        <img src="<?php echo SITEURL; ?>images/category/<?php echo $imgname;?>" width="50px">
                        <?php
                       }
                       else{
                        echo "image not added.";
                       }
                     ?>
                    </td>
                
                    <td><a href="<?php echo SITEURL;?>admin/update-category.php?id=<?php echo $id;?>" class="btn-update">Update Category</a>
                    <a href="<?php echo SITEURL;?>admin/delete-category.php?id=<?php echo $id;?>& imgname=<?php echo $imgname?>" class="btn-delete"> Delete Category</a></td>
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