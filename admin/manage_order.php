<?php 
include('partials/menu.php');
?>

<div class="maincontent">
    <div class="wrapper-order">
        <h1>Manage Order</h1>

        <?php
        if (isset($_SESSION['update'])) {
            echo $_SESSION['update'];
            unset($_SESSION['update']);
        }

        if (isset($_SESSION['delete'])) {
            echo $_SESSION['delete'];
            unset($_SESSION['delete']);
        }
        ?>

        <table class="tbl_full">
            <tr>
                <th>S.N.</th>
                <th>Food</th>
                <th>Price</th>
                <th>Qty</th>
                <th>Total</th>
                <th>Order Date</th>
                <th>Delivery Date</th>
                <th>Status</th>
                <th>Payment Status</th>
                <th>Payment Method</th>
                <th>Customer Name</th>
                <th>Customer Phone</th>
                <th>Customer Address</th>
                <th>Actions</th>
            </tr>

            <?php
            $sn = 1;

            $select = "SELECT * FROM order_tbl ORDER BY id DESC";
            $res = mysqli_query($con, $select) or die("Selection error: " . mysqli_error($con));

            if (mysqli_num_rows($res) > 0) {
                while ($row = mysqli_fetch_assoc($res)) {
                    $id = $row['id'];
                    $food = $row['food'];
                    $price = $row['price'];
                    $qty = $row['qty'];
                    $total = $row['total'];
                    $orderdate = $row['order_date'];
                    $deliverydate = $row['delivery_date'];
                    $status = $row['status'];
                    $payment_status = $row['payment_status'];
                    $payment_method = $row['payment_method'];
                    $name = $row['c_name'];
                    $phone = $row['c_phone'];
                    $address = $row['c_address'];
            ?>
                    <tr>
                        <td><?php echo $sn++; ?></td>
                        <td><?php echo $food; ?></td>
                        <td><?php echo $price; ?></td>
                        <td><?php echo $qty; ?></td>
                        <td><?php echo $total; ?></td>
                        <td><?php echo $orderdate; ?></td>
                        <td><?php echo $deliverydate ?? '-'; ?></td>

                        <!-- Status -->
                        <td>
                            <?php
                            if ($status == "Ordered") {
                                echo "<span style='color: orange; font-weight: bold;'>Ordered</span>";
                            } elseif ($status == "Delivered") {
                                echo "<span style='color: green; font-weight: bold;'>Delivered</span>";
                            } else {
                                echo $status;
                            }
                            ?>
                        </td>

                        <!-- Payment Status -->
                        <td>
                            <?php
                            if ($payment_status == "Paid") {
                                echo "<span style='color: green; font-weight: bold;'>Paid</span>";
                            } elseif ($payment_status == "Yet to Pay") {
                                echo "<span style='color: brown; font-weight: bold;'>Yet to Pay</span>";
                            } else {
                                echo $payment_status;
                            }
                            ?>
                        </td>

                        <!-- Payment Method -->
                        <td>
                            <?php
                            if ($payment_method == "ESEWA") {
                                echo "<span style='color: green; font-weight: bold;'>eSewa</span>";
                            } else {
                                echo "<span style='color: brown; font-weight: bold;'>COD</span>";
                            }
                            ?>
                        </td>

                        <td><?php echo $name; ?></td>
                        <td><?php echo $phone; ?></td>
                        <td><?php echo $address; ?></td>

                        <td>
                            <div class="action-buttons">
                                <a href="<?php echo SITEURL; ?>admin/update-order.php?id=<?php echo $id; ?>" class="btn-update-order">Update</a>
                                <a href="<?php echo SITEURL; ?>admin/delete_order.php?id=<?php echo $id; ?>" class="btn-delete-order">Delete</a>
                            </div>
                        </td>
                    </tr>
            <?php
                }
            } else {
                echo "<tr><td colspan='14' style='text-align:center;'>Order not available</td></tr>";
            }
            ?>
        </table>
    </div>
</div>

<?php 
include('partials/footer.php');
?>
