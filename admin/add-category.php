<?php
include('partials/menu.php');
?>
<div class='maincontent'>
    <div class='wrapper'>
<h1>Add Category</h1>
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
<table>
    <tr>
        <td>Title:</td>
        <td><input type="text" name="title" required pattern="^[A-Za-z\s]+$" title="Only letters and spaces allowed"></td>
    </tr>
    <br>
    <tr>
        <td>Image:</td>
        <td><input type="file" name="img" required></td>
    </tr>
    <tr colspan="2">
        <td> <input type="submit" name="submit"  value="ADD" class="btn-add"></td>
    </tr>
</table>
</form>
    </div>
</div>
<?php
if(isset($_POST['submit'])){
    $title=$_POST['title'];
       if(isset($_FILES['img']['name'])){
        $imgname=$_FILES['img']['name'];
        $source=$_FILES['img']['tmp_name'];
        $destination="../images/category/".$imgname;
        $upload= move_uploaded_file($source,$destination);

        if($upload==FALSE){
            $_SESSION['upload']="Failed to upload image.";
            header('location:'.SITEURL.'admin/add-category.php');
            die();
        }
       }
       else{
              $imgname="";
       }
  
    $insert="insert into categories_tbl(title,image_name)values ('$title','$imgname')";
    $res=mysqli_query($con,$insert) or die("Insertion error");
    if($res==TRUE){
        $_SESSION['add']="Category Added Successfully";
        header('location:'.SITEURL.'admin/manage_category.php');
    }
    else{
        $_SESSION['add']="Failed to add category";
        header('location:'.SITEURL.'admin/add-category.php');
    }
}
?>

<?php
include('partials/footer.php');
?>