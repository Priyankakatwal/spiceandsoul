<?php
include('partials/menu.php');
?>
<div class='maincontent'>
    <div class="wrapper">
        <h1>Update Order</h1>
        <br>

      <?php 
       if(isset($_GET['id'])){
            $id=$_GET['id'];
            $select="select * from order_tbl where id=$id";
            $res=mysqli_query($con,$select);
            if(mysqli_num_rows($res)!=0){
                while($rows=mysqli_fetch_assoc($res)){
                    $food=$rows['food']; 
                    $price=$rows['price'];
                    $qty=$rows['qty'];
                    $status= $rows['status'];
                    $name= $rows['c_name'];
                    $phone= $rows['c_phone'];        
                
                    $address= $rows['c_address'];
                }
            }
            else{
               
                header('location:'.SITEURL.'admin/manage_order.php');
            }
        }
        ?>
        <form action="" method="POST" >
            <table  class="tbl-30">
                <tr>
                    <td>Food Name:</td>
                    <td><b><?php echo $food; ?> </b></td>
                </tr>
                <tr>
                    <td>Price:</td>
                    <td><b><?php echo $price;?></b></td>
                </tr>
                <tr>
                    <td>Qty:</td>
                    <td><input type="number" name="qty" value="<?php echo $qty; ?>" min ="1" required></td>
                </tr>

                <tr>
                   <td>Status:</td>
                   <td><select name="status">
                    <option <?php if($status=='Ordered')echo "selected"; ?> value="Ordered">Ordered</option>
                   
                    <option <?php if($status=='Delivered')echo "selected"; ?> value="Delivered">Delivered</option>
                   
                   </select>
                </td>
                </tr>

                <tr>
                    <td>Customer Name:</td>
                    <td><input type="text" name="name" required value="<?php echo $name;?>"></td>
                </tr>

                
                <tr>
                    <td>Phone number:</td>
                    <td><input type="text" name="phn" value="<?php echo $phone;?>"  
    pattern="\d{10}" 
    title="Phone number must be exactly 10 digits" required></td>
    </tr>

                
                <tr>
                    <td>Address</td>
                    <td><textarea name="address" cols="30" rows="5" required><?php echo  $address; ?> </textarea> </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id;?>">
                        <input type="hidden" name="price" value="<?php echo $price;?>">
                    <input type="submit" name="submit" value="Update order" class="btn-update">
                    </td>
                </tr>
            
            </table>
        </form>
    </div>
</div>
<?php
if(isset($_POST['submit']))
{
$id=$_POST['id'];
$qty=$_POST['qty'];
$price=$_POST['price'];
$total= $price * $qty;
$status= $_POST['status'];
$name= $_POST['name'];
$phn= $_POST['phn'];

$address= $_POST['address'];

$update="Update order_tbl set
qty= $qty,
total=$total,
status= '$status',
c_name= '$name',
c_phone= '$phn',
c_address= '$address'
where id=$id";

$res= mysqli_query($con,$update) or die("Update error");
if($res==true){
    $_SESSION['update']="Order Updated Successfully.";
    header('location:'.SITEURL.'admin/manage_order.php');
}
else{
    $_SESSION['update']="Failed to update order.";
    header('location:'.SITEURL.'admin/manage_order.php');
}
}
?>
<?php
include('partials/footer.php');
?>