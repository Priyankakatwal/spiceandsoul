<?php
include('partials/menu.php');
?>
<div class='maincontent'>
    <div class="wrapper">
        <h1>Update Category</h1>
      <?php 
       if(isset($_GET['id'])){
            $id=$_GET['id'];
            $select="select * from categories_tbl where id=$id";
            $res=mysqli_query($con,$select);
            if(mysqli_num_rows($res)!=0){
                while($rows=mysqli_fetch_assoc($res)){
                    $title=$rows['title'];
                    $curimg=$rows['image_name'];
                }
            }
            else{
                $_SESSION['category-not-found']="Category not found.";
                header('location:'.SITEURL.'admin/manage_category.php');
            }
        }
        ?>
        <form action="" class="tbl-30" method="POST" enctype="multipart/form-data">
            <table>
                <tr>
                    <td>Title:</td>
                    <td><input type="text" name="title" value="<?php echo $title;?>" pattern="^[A-Za-z\s]+$" title="Only letters and spaces allowed" required></td>
                </tr>
                <tr>
                    <td>Current Image:</td>
                    <td><?php 
                    if($curimg!='')
                    {
                    ?>
                    <img src="<?php echo SITEURL;?>images/category/<?php echo $curimg;?>"  width="100px">
               <?php
               }
             else{
                echo "image not added";
             }
               ?>
               </td>
                </tr>
                <tr>
                    <td>New Image:</td>
                    <td><input type="file" name="newimg" required></td>
                </tr>
                <tr>
                <td><input type="hidden" name="curimg" value="<?php echo $curimg;?>"></td>
                <td><input type="hidden" name="id" value="<?php echo $id;?>"> </td>
                    <td><input type="submit" name="submit" value="Update Category" class="btn-update"></td>
                   
                </tr>
            </table>
        </form>
    </div>
</div>
<?php
if(isset($_POST['submit']))
{
$id=$_POST['id'];
$title=$_POST['title'];
$curimg=$_POST['curimg'];

if(isset($_FILES['newimg']['name'])){

    $imgname=$_FILES['newimg']['name'];

    if($imgname!='')
    {
    $source=$_FILES['newimg']['tmp_name'];
    $destination="../images/category/".$imgname;
    $upload= move_uploaded_file($source,$destination);

    if($upload==FALSE){
        $_SESSION['upload']="Failed to upload image.";
        header('location:'.SITEURL.'admin/update-category.php');
        die();
    }
   }
   else{
          $imgname=$curimg;
   }
}
else{
    $imgname=$curimg;
}

$update="Update categories_tbl set
title='$title',
image_name= '$imgname' 
where id=$id";

$res= mysqli_query($con,$update) or die("Update error");
if($res==true){
    $_SESSION['update']="Category Updated Successfully.";
    header('location:'.SITEURL.'admin/manage_category.php');
}
else{
    $_SESSION['update']="Failed to update category.";
    header('location:'.SITEURL.'admin/update-category.php');
}
}
?>
<?php
include('partials/footer.php');
?>