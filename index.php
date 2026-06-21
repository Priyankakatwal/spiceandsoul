<?php include('partials-frontend/menu.php'); ?>
<section  class="foodsearch text-center">
        <div class="container">
            <?php
            if(isset($_SESSION['login'])){
                echo $_SESSION['login'];
                unset($_SESSION['login']);
            }
            ?>
           <form action="<?php echo SITEURL;?>food-search.php" method="POST">
            <input type="search" name="search" placeholder="Search food" required>
            <input type="submit" name="submit" value="search" class="btn btn-primary">
           </form>
        </div>
    </section>
   
    <section>
        <div class="main">
            <h1>Spice and Soul</h1>
            <h2>Best Quality Food</h2>
            <a href="food.php" class="btn btn-primary">Menu</a>
        </div>
    </section>
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Item Categories</h2>
            <?php
            $select="select * from categories_tbl ";
            $res= mysqli_query($con,$select);
            $count= mysqli_num_rows($res);

            if($count>0){
                while ($rows=mysqli_fetch_assoc($res)){
                    $id=$rows['id'];
                    $title=$rows['title'];
                    $imgname=$rows['image_name'];
                
                ?>
            
                <div class="box-3 float-container">
                    <?php
                    if($imgname==""){
                        echo "image not available.";
                    }
                    else{
                        ?>
                            <img src="<?php echo SITEURL;?>images/category/<?php echo $imgname;?>" alt="burger" class="img-categories img-curve">
                        <?php
                    }
                    ?>

               
                <h3 class="float-text"><?php echo $title;?></h3>
            </div>
    
                <?php
                }

            }
            else{
                 echo "Category not available";
            }
            ?>

        
            <div class="clearfix">

            </div>
        </div>
    </section>
    <?php include('partials-frontend/footer.php'); ?>

