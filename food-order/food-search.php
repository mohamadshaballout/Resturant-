<?php include('partial-front/menu.php');?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
        <?php
                //get the source keyword
                $search= $_POST['search'];
                
                ?>
            <h2>Foods on Your Search <a href="#" class="text-white"><?php echo $search; ?></a></h2>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
           
            <h2 class="text-center">Food Menu</h2>
            <?php 
                
                //creat sql query to get foods base on search keyword
                $sql="SELECT * FROM tbl_food WHERE title LIKE '%$search%' OR description like '%$search%'";
                //excute the query
                $res =mysqli_query($conn,$sql);
                //count rows
                $count = mysqli_num_rows($res);
                //checck food available or not
                if($count>0){
                    while($row=mysqli_fetch_assoc($res)){
                        //get the details
                        $id=$row['id'];
                        $title=$row['title'];
                        $price=$row['price'];
                        $description=$row['description'];
                        $image_name=$row['image_name'];
                        ?>
                                    <div class="food-menu-box">
                                            <div class="food-menu-img">
                                                <?php 
                                                    //check whether image name is available or not
                                                    if($image_name==""){
                                                        //image not available
                                                        echo "<div class='error'>image not available</>";
                                                    }else{
                                                        //image available
                                                        ?>
                                                             <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name;?>"  class="img-responsive img-curve">
                                                        <?php
                                                    }
                                                    ?>
                                               
                                            </div>

                                            <div class="food-menu-desc">
                                                <h4><?php echo $title;?></h4>
                                                <p class="food-price">TL<?php echo $price; ?></p>
                                                <p class="food-detail">
                                                    <?php echo $description;?>
                                                </p>
                                                <br>
 
                                                <a href="#" class="btn btn-primary">Order Now</a>
                                            </div>
                                        </div>
                        <?php
                    }
                }else{
                    //food not found
                    echo "<div class='error'>food not found</>";
                }
                ?>
          

            


            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

    <?php
  include('partial-front/footer.php');
  ?>