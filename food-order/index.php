<?php include('partial-front/menu.php');  ?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <form action="<?php echo SITEURL; ?>food-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Food.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->
<?php
    if(isset($_SESSION['order'])){
        echo $_SESSION['order'];
        unset($_SESSION['order']);
    }
?>
    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>
            <?php
                    //CREAT SQL QUERY TO DISPLAY CATEGORY FROM DATA BASE
                        $sql="SELECT * FROM tbl_catagories WHERE active='yes' AND featured='yes' LIMIT 3";
                        //excute the query
                        $res=mysqli_query($conn,$sql);
                        //count rows to check category is aviliable or not
                        $count=mysqli_num_rows($res);
                        if($count>0){
                            //categoreis avliable
                            while($row=mysqli_fetch_assoc($res)){
                                //get the values like title id image name
                                $id=$row['id'];
                                $title=$row['title'];
                                $image_name=$row['image_name'];?>
                                                    <a href="<?php echo SITEURL; ?>category-foods.php?category_id=<?php echo $id;?>">
                                <div class="box-3 float-container">
                                    <?php 
                                    //check image availiable or not
                                        if($image_name==""){
                                            //dispaly meassge
                                            echo "<div class='error'>Image not availiable</div>";

                                        }else{
                                            ?>
                                                  <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" alt="Pizza" class="img-responsive img-curve">
                                            <?php
                                        }
                                        ?>
                                  

                                    <h3 class="float-text text-white"><?php echo $title; ?></h3>
                                </div>
                                
                                <?php
                            }
                        }else{
                            //categoreis not aviliable
                            echo "<div class='error'>categories not added</div>;";
                        }

                    ?>
        <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->

    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>
            <?php
                //getting food from database that area cive and featured
                $sql3="SELECT * FROM tbl_food WHERE active='yes' AND featured='yes' ";
                //excute the query
                $res3 = mysqli_query($conn,$sql3);
                //conut rows
                $count22 =mysqli_num_rows($res3);
                //check whether  food available or not
                if($count22>0){
                    //food available
                    while($row= mysqli_fetch_assoc($res3)){
                        //get all the value
                        $id=$row['id'];
                        $title=$row['title'];
                        $price=$row['price'];
                        $description=$row['description'];
                        $image_name=$row['image_name'];
                        ?>
                        <div class="food-menu-box">
                            <div class="food-menu-img"> 
                        <?php
                    //check wehther image available or not
                        if($image_name==""){
                            //image not availiable
                            echo "<div class='error'>image not availiable.</div>";
                        }else{
                            //image founded
                            ?>
                                 <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>"  class="img-responsive img-curve">
                            <?php}?></div>
                            <div class="food-menu-desc">
                    <h4><?php echo $title; ?></h4>
                    <p class="food-price"><?php echo $price; ?>TL</p>
                    <p class="food-detail">
                        <?php echo $description;  ?>
                    </p>
                    <br>

                    <a href="<?php echo SITEURL;?>order.php?food_id=<?php echo $id;?>" class="btn btn-primary">Order Now</a>
                </div>
            </div>
                    <?php
               } }else{
                    //food not available
                    echo "<div class='error'>food not available.</div>";
                }
            ?>
          <div class="clearfix"></div></div>
            <p class="text-center">
            <a href="#">See All Foods</a>
        </p>
    </section>
    <!-- fOOD Menu Section Ends Here -->

  <?php
  include('partial-front/footer.php');
  ?>