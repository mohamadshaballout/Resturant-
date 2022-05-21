<?php include('partial-front/menu.php');  ?>
    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>
            <?php 
                //dispaly all categories that are active
                $sql="SELECT * FROM tbl_catagories WHERE active='yes'";
                //excute the query 
                $res=mysqli_query($conn,$sql);
                $count =mysqli_num_rows($res);
                if($count>0){
                    //categorey avliable
                    while($row=mysqli_fetch_assoc($res)){
                        //get the value
                        $id=$row['id'];
                        $title=$row['title'];
                        $image_name=$row['image_name'];
                        ?>
                                            <a href="<?php echo SITEURL; ?>category-foods.php?category_id=<?php echo $id;?>">
                            <div class="box-3 float-container">
                                <?php 
                                    if($image_name==""){
                                        //image not aviliable
                                        echo "<div class='error'>image not found.</div>";
                                    }else{
                                        ?>
                                         <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name;?>" alt="" class="img-responsive img-curve" >
                                        <?php
                                    }
                                ?>
                                <h3 class="float-text text-white"><?php echo $title;?></h3>
                            </div>
                            </a>
                        <?php
                    }

                }else{
                    //category not availaibe
                    echo "<div class='error'>category not found.</div>";
                }
            ?>
            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->

    <?php
  include('partial-front/footer.php');
  ?>