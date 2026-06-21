<?php 
include('partials/menu.php');
?>
        <div class="maincontent">
        <div class="wrapper">
          <h1>DASHBOARD</h1>
        
            <div class="dash">
                <?php
                $select="select * from menu_tbl";
                $res= mysqli_query($con,$select);
                $count= mysqli_num_rows($res);
                ?>
                <h1><?php echo $count; ?></h1>
                <p>Menu Items</p>
            </div>
            <div class="dash">
                <?php
                $select2="select * from categories_tbl";
                $res2= mysqli_query($con,$select2);
                $count2= mysqli_num_rows($res2);
                ?>
                <h1><?php echo $count2; ?></h1>
                <p>Food Categories</p>
            </div>
            <div class="dash">
            <?php
                $select3="select * from order_tbl";
                $res3= mysqli_query($con,$select3);
                $count3= mysqli_num_rows($res3);
                ?>
                <h1><?php echo $count3; ?></h1>
                <p>Total Orders</p>
            </div>
            <div class="dash">
            <?php
                $select5="select * from users";
                $res5= mysqli_query($con,$select5);
                $count5= mysqli_num_rows($res5);
                ?>
                <h1><?php echo $count5; ?></h1>
                <p>Total Registered Users</p>
            </div>
            <div class="dash">
                <?php
                $select4= "select sum(total) as Total from order_tbl where status='delivered'";
                $res4= mysqli_query($con,$select4);
                $rows= mysqli_fetch_assoc($res4);
                $totalrevenue= $rows['Total'];
                ?>
                <h1> Rs.<?php echo $totalrevenue; ?></h1>
                <p>Revenue generated
                </p>
            </div>
            <div class="clearfix"></div>
        </div>
      
        </div>
<?php 
include('partials/footer.php');
?>