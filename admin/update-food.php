<?php
include('partials/menu.php');
?>
<div class='maincontent'>
    <div class="wrapper">
        <h1>Update Food</h1>
        <br>
        <?php
        if(isset($_SESSION['upload']))
{
    echo $_SESSION['upload'];
    unset($_SESSION['upload']);
}

?>
      <?php 
       if(isset($_GET['id'])){
            $id=$_GET['id'];
            $select="select * from menu_tbl where id=$id";
            $res=mysqli_query($con,$select);
            if(mysqli_num_rows($res)!=0){
                while($rows=mysqli_fetch_assoc($res)){
                    $title=$rows['title'];
                    $price= $rows['price'];
                    $curimg=$rows['image_name'];
                }
            }
            else{
                $_SESSION['food-not-found']="Fooditem not found.";
                header('location:'.SITEURL.'admin/manage_food.php');
            }
        }
        ?>
        <form action="" class="tbl-30" method="POST" enctype="multipart/form-data">
            <table>
                <tr>
                    <td>Title:</td>
                    <td><input type="text" name="title" pattern="^[A-Za-z\s]+$" title="Only letters and spaces allowed" value="<?php echo $title;?>" required></td>
                </tr>
                <tr>
                    <td>Price:</td>
                    <td><input type="title" name="price" value="<?php echo $price;?>" min="0" step="any" required></td>
                </tr>
                <tr>
                    <td>Current Image:</td>
                    <td><?php 
                    if($curimg!='')
                    {
                    ?>
                    <img src="<?php echo SITEURL;?>images/category/<?php echo $curimg;?>" width="100px">
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
                    <td><input type="submit" name="submit" value="Update food" class="btn-update"></td>
                   
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
$price=$_POST['price'];
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
        header('location:'.SITEURL.'admin/update-food.php');
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

$update="Update menu_tbl set
title='$title',
price='$price',
image_name= '$imgname' 
where id=$id";

$res= mysqli_query($con,$update) or die("Update error");
if($res==true){
    $_SESSION['update']="Food Updated Successfully.";
    header('location:'.SITEURL.'admin/manage_food.php');
}
else{
    $_SESSION['update']="Failed to update food.";
    header('location:'.SITEURL.'admin/manage_food.php');
}
}
?>
<?php
include('partials/footer.php');
?>