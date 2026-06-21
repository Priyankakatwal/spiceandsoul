<?php
session_start();
include('connection/connect.php');
include('partials-frontend/menu.php');
?>

<div class="container cart-wrapper">
<h2 class="cart-title">Your Cart</h2>
<a href="cart.php?clear=true" class="btn btn-danger">Clear Cart</a><br><br>

<?php
if(isset($_GET['clear']) && $_GET['clear']=="true"){
    unset($_SESSION['cart']);
    echo "<script>alert('Cart cleared'); window.location='cart.php';</script>";
    exit();
}

if(!empty($_SESSION['cart'])){
    $total = 0;
?>
<form method="POST" action="checkout.php">
<table border="1" cellpadding="10" class="cart-table">
<tr>
<th>Food</th>
<th>Price</th>
<th>Qty</th>
<th>Subtotal</th>
</tr>

<?php foreach($_SESSION['cart'] as $item):
    $subtotal = $item['price'] * $item['qty'];
    $total += $subtotal;
?>
<tr>
<td><?php echo $item['title']; ?></td>
<td>Rs.<?php echo $item['price']; ?></td>
<td><?php echo $item['qty']; ?></td>
<td>Rs.<?php echo $subtotal; ?></td>
</tr>
<?php endforeach; ?>

<tr>
<td colspan="3"><strong>Total</strong></td>
<td><strong>Rs.<?php echo $total; ?></strong></td>
</tr>
</table>
<br>

<p>Enter your details:</p>

<?php $loggedInUser = isset($_SESSION['user']) ? $_SESSION['user'] : "Guest"; ?>
<label>Username: <b><?php echo $loggedInUser; ?></b></label>
<input type="hidden" name="c_name" value="<?php echo $loggedInUser; ?>"><br><br>

<label>Phone: <input type="text" name="c_phone" pattern="\d{10}" required></label><br><br>

<label>Delivery Date: <input type="datetime-local" name="date" required></label><br><br>

<label>Address: <textarea name="c_address" required></textarea></label><br><br>

<p>Payment Method:</p>
<label><input type="radio" name="payment_method" value="COD" required> Cash on Delivery</label><br>
<label><input type="radio" name="payment_method" value="ESEWA" required> Pay with eSewa</label><br><br>

<input type="submit" name="checkout" value="Checkout" class="btn btn-primary">
</form>

<?php
}else{
    echo "<p>Your cart is empty</p>";
}
?>

</div>
<?php include('partials-frontend/footer.php'); ?>
