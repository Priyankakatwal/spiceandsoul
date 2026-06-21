<?php include('partials-frontend/menu.php'); ?>
<section  class="foodsearch text-center">
        <div class="container">
            <?php
             $search= $_POST['search'];
            ?>
         <h1>Food searched: <a href="#"> <?php echo $search; ?></a></h1>
        </div>
    </section>
    <?php
if (isset($_POST['add_to_cart'])) {
    $food_id = $_POST['food_id'];
    $qty = $_POST['qty'];

    // Fetch food from database
    $sql = "SELECT * FROM menu_tbl WHERE id = $food_id";
    $res = mysqli_query($con, $sql);
    $row = mysqli_fetch_assoc($res);

    if ($row) {
        $item = [
            'id' => $row['id'],
            'title' => $row['title'],
            'price' => $row['price'],
            'qty' => $qty
        ];

        $_SESSION['cart'][] = $item; // Add to cart
        $_SESSION['order'] = '<p class="text-center" style="color:blue;">Item added to cart!</p>';
    } else {
        $_SESSION['order'] = "Food not found.";
    }

    header("Location: " . SITEURL. "food.php");
    exit;
}
?>
    <section class="foodmenu">
        <div class="container">
            <h1  class="text-center">Food Menu</h1>
    
            <?php

$select="select * from menu_tbl where title like '%$search%'";
$res= mysqli_query($con,$select);
$count= mysqli_num_rows($res);

if($count > 0){
    while ($rows=mysqli_fetch_assoc($res)){
        $id = $rows['id'];
        $title = $rows['title'];
        $price = $rows['price'];
        $imgname = $rows['image_name'];
?>

     <div class="foodmenu-box">
        <div class="foodmenu-img">
            <?php
            if($imgname == ""){
                echo "image not available.";
            }
            else{
            ?>
                <img src="<?php echo SITEURL;?>images/<?php echo $imgname;?>" alt="<?php echo $title; ?>" class="img-menu img-curve">
            <?php
            }
            ?>
        </div>

        <div class="fooddes">
            <h4><?php echo $title; ?></h4>
            <p class="foodprice"><?php echo $price; ?></p>
            <br>
            <form action="food.php" method="POST" style="display: flex; align-items: center; gap: 10px; flex-wrap: wrap; margin-top: 10px;">
    <input type="hidden" name="food_id" value="<?php echo $id; ?>">

    <label for="qty" style="margin: 0; font-weight: 500;">Qty:</label>
    <input 
        type="number" 
        name="qty" 
        id="qty" 
        value="1" 
        min="1" 
        required 
        style="width: 60px; padding: 5px; border: 1px solid #ccc; border-radius: 4px;">

    <input 
        type="submit" 
        name="add_to_cart" 
        value="Add to Cart" 
        class="btn btn-primary"
        style="padding: 5px 15px;">
</form>
        </div>
    </div>
<?php
    }
} else {
    echo "Menu not available";
}
?>
            
                <div class="clearfix"> 

                </div>
            </div>
         </section>
    <?php include('partials-frontend/footer.php'); ?>