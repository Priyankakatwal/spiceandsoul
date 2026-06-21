<?php
session_start();
include('connection/connect.php');

if(isset($_POST['checkout'])){
    // Customer details
    $c_name = $_POST['c_name'];
    $c_phone = $_POST['c_phone'];
    $c_address = $_POST['c_address'];
    $delivery_date = $_POST['date'];

   $selectedDate = strtotime($delivery_date);
    $currentTime = time();
    $maxDate = strtotime("+2 days");

    if ($selectedDate < $currentTime) {
        echo "<script>alert('Delivery date cannot be in the past'); window.location='cart.php';</script>";
        exit();
    }

    if ($selectedDate > $maxDate) {
        echo "<script>alert('Delivery date must be within 2 days'); window.location='cart.php';</script>";
        exit();
    }

    // Calculate total
    $total_amount = 0;
    foreach($_SESSION['cart'] as $item){
        $total_amount += $item['price'] * $item['qty'];
    }
    $order_date = date("Y-m-d H:i:s");

    // COD Orders
    if($_POST['payment_method'] == "COD"){
        $status = "Ordered"; 
        $payment_status = "Yet to Pay";

        foreach($_SESSION['cart'] as $item){
            $food = $item['title'];
            $price = $item['price'];
            $qty = $item['qty'];
            $subtotal = $price * $qty;

            mysqli_query($con, "INSERT INTO order_tbl
                (food, price, qty, total, order_date, delivery_date, status, c_name, c_phone, c_address, payment_method, payment_status)
                VALUES
                ('$food','$price','$qty','$subtotal','$order_date','$delivery_date','$status','$c_name','$c_phone','$c_address','COD','$payment_status')") 
                or die(mysqli_error($con));
        }

        unset($_SESSION['cart']);
        echo "<script>alert('Order placed successfully with COD!'); window.location='index.php';</script>";
        exit();
    } 
    // eSewa Orders
else {
    $status = "Ordered"; 
    $payment_status = "Paid"; 

    // Save cart and customer info in session for success page
    $_SESSION['esewa_cart'] = $_SESSION['cart'];
    $_SESSION['esewa_total'] = $total_amount;
    $_SESSION['esewa_order_date'] = $order_date;
    $_SESSION['esewa_delivery_date'] = $delivery_date;
    $_SESSION['esewa_customer'] = [
        'name' => $c_name,
        'phone' => $c_phone,
        'address' => $c_address
    ];

    unset($_SESSION['cart']); // empty main cart

    // Redirect to esewa_pay.php via POST
    echo '
    <form id="esewaForm" action="esewa_pay.php" method="POST">
        <input type="hidden" name="total_amount" value="'.$total_amount.'">
    </form>
    <script>document.getElementById("esewaForm").submit();</script>
    ';
    exit();
}
}
?>
