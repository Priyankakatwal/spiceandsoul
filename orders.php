<?php
include('connection/connect.php');
include('partials-frontend/menu.php');

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if(!isset($_SESSION['user'])) {
    echo "<script>alert('Login first to see your orders!'); window.location.href='login.php';</script>";
    exit();
}

$user = $_SESSION['user'];
?>

<div class="container">
    <h2>Your Orders</h2>

    <?php
    $sql = "SELECT * FROM order_tbl WHERE c_name = '$user' ORDER BY order_date DESC";
    $res = mysqli_query($con, $sql);

    if(mysqli_num_rows($res) > 0) {
        echo "<table border='1' cellpadding='10'>
                <tr>
                    <th>Food</th>
                    <th>Qty</th>
                    <th>Total</th>
                    <th>Order Date</th>
                    <th>Delivery Date</th>
                    <th>Status</th>
                </tr>";
        while($row = mysqli_fetch_assoc($res)) {
            echo "<tr>
                    <td>{$row['food']}</td>
                    <td>{$row['qty']}</td>
                    <td>Rs.{$row['total']}</td>
                    <td>{$row['order_date']}</td>
                    <td>{$row['delivery_date']}</td>
                    <td>{$row['status']}</td>
                  </tr>";
        }
        echo "</table>";
    } else {
        echo "<p>No orders found.</p>";
    }
    ?>
</div>

<?php include('partials-frontend/footer.php'); ?>
