<?php include('partial-front/menu.php');?>
    <?php 
        //check whether id is passed or not 
        if(isset($_GET['id'])){
            //category id is set and get the id
            $category_id=$_GET['category_id'];
            //GET THE CATEGORY TITLE BASED ON CATEGORY ID
            $sql="SELECT title FROM tbl_catagories WHERE id=$category_id";
            $res=mysqli_query($conn,$sql);
            //get the value from data base
            $row =mysqli_fetch_assoc($res);
            //get the title
            $category_title=$row['title'];

        } else{
            //category not passed
            //redirect to home page
            header('location:'.SITEURL);
        }
    ?>
    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <h2>Foods on <a href="#" class="text-white"><?php echo $category_title;?></a></h2>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>
            <?php 
                //creat sql query to get foods bassed on selected category
                $sql1="SELECT * FROM tbl_food WHERE catagories_id=$category_id";
                //excute the query
                $res1=mysqli_query($conn,$sql1);
                //count the rows
                $count2=mysqli_num_rows($res1);
                //check whether food is availiable
                if($count2>0){
                    while($row1=mysqli_fetch_assoc($res)){
                        $id=$row['id'];
                        $title=$row['title'];
                        $price=$row['price'];
                        $description=$row['description'];
                        $image_name=$row['image_name'];
                        ?>
                            <div class="food-menu-box">
                                            <div class="food-menu-img">
                                                <?php 
                                                    if($image_name==""){
                                                        //image not available
                                                        echo "<div class='error'>imagenot available</div>";
                                                    }else{
                                                        //image available
                                                        ?>
                                                        <img src="<?php echo SITEURL;?>image/food/<?php echo $image_name;?>"  class="img-responsive img-curve">
                                                        <?php
                                                    }
                                                ?>
                                                
                                            </div>

                                            <div class="food-menu-desc">
                                                <h4><?php echo $title;?></h4>
                                                <p class="food-price"><?php echo $price; ?></p>
                                                <p class="food-detail">
                                                  <?php echo $description; 
                                                  ?>
                                                </p>
                                                <br>

                                                <a href="<?php echo SITEURL;?>order.php?food_id=<?php echo $id;?>" class="btn btn-primary">Order Now</a>
                                            </div>
                                        </div>
                        <?php
                    } 
                }else{
                    //food not available
                    echo "<div class='error'>food not available</div>";
                }
            ?>
          


            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

   <?php include('partial-front/footer.php');?>