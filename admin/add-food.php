<?php include('partials/menu.php'); ?>
<div class="maincontent">
    <div class="wrapper">
        <h1>Add food item</h1>
        <?php
if(isset($_SESSION['add']))
{
    echo $_SESSION['add'];
    unset($_SESSION['add']);
}
if(isset($_SESSION['upload'])){
    echo $_SESSION['upload'];
    unset($_SESSION['upload']);
}
        ?>
<form action="" method="POST" enctype="multipart/form-data">
    <table  class="tbl_full">
        <tr>
            <td>Title:</td>
            <td><input type="text" name="title" required pattern="^[A-Za-z\s]+$" title="Only letters and spaces allowed"></td>
        </tr>
        <tr>
            <td>Price:</td>
            <td><input type="number" name="price" required min="0" step="any"></td>
        </tr>
        <tr>
            <td>Image:</td>
            <td><input type="file" name="img" required ></td>
        </tr>
        <tr>
           
            <td><input type="submit" name="submit" class="btn-add" value="Add food"></td>
        </tr>
    </table>
</form>
</div>
</div>
<?php
if(isset($_POST['submit'])){
    $title=$_POST['title'];
    $price=$_POST['price'];
    if(isset($_FILES['img']['name'])){
        $imgname=$_FILES['img']['name'];
        $source=$_FILES['img']['tmp_name'];
        $destination="../images/category/".$imgname;
        $upload= move_uploaded_file($source,$destination);

        if($upload==FALSE){
            $_SESSION['upload']="Failed to upload image.";
            header('location:'.SITEURL.'admin/add-food.php');
            die();
        }
       }
       else{
              $imgname="";
       }
  
    $insert="insert into menu_tbl(title,price,image_name)values ('$title',$price,'$imgname')";
    $res=mysqli_query($con,$insert) or die("Insertion error");
    if($res==TRUE){
        $_SESSION['add']="Fooditem Added Successfully";
        header('location:'.SITEURL.'admin/manage_food.php');
    }
    else{
        $_SESSION['add']="Failed to add fooditem";
        header('location:'.SITEURL.'admin/add-food.php');
    }
}
?>
<?php include('partials/footer.php'); ?>