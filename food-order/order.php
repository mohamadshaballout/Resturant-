<?php include('partial-front/menu.php');?>
<?php 
//check whether food id is set or not
if(isset($_GET['food_id'])){
    //get the food id and details of the selected food
    $food_id=$_GET['food_id'];
    //get the deatails of the seleccted food
    $sql="SELECT * FROM tbl_food WHERE id=$food_id";
    $res=mysqli_query($conn,$sql);
    $conut=mysqli_num_rows($res);
    if($conut==1){
        //we have data
        //GET THE DATA FROM DATA BASE
        $row=mysqli_fetch_assoc($res);
        $title=$row['title'];
        $price=$row['price'];
        $image_name=$row['image_name'];
       
    }else{
        //food not availabel 
        //redirect to home page
        header('location:'.SITEURL);
    }
}else{
    //redirect to hmepage
    header('location:'.SITEURL);
}
?>
    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search">
        <div class="container">
            
            <h2 class="text-center text-white">Fill this form to confirm your order.</h2>

            <form action="" method="POST" class="order">
                <fieldset>
                    <legend>Selected Food</legend>

                    <div class="food-menu-img">
                        <?php 
                            //check whether the iamge is available or not
                            if($image_name==""){
                                //image not available
                                echo "<dive calss='error'>image not avaliable.</div>";

                            } else{
                                //image  available
                                ?>
                                 <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name;?>" class="img-responsive img-curve">
                                <?php
                                }
                        ?>
                       
                    </div>
    
                    <div class="food-menu-desc">
                        <h3><?php echo $title;?></h3>
                        <input type="hidden" name="food" value="<?php echo $title; ?>">
                        <p class="food-price">TL<?php echo $price; ?></p>
                        <input type="hidden" name="price" value="<?php echo $price;?>">
                        <div class="order-label">Quantity</div>
                        <input type="number" name="qty" class="input-responsive" value="1" required>
                        
                    </div>

                </fieldset>
                
                <fieldset>
                    <legend>Delivery Details</legend>
                    <div class="order-label">Full Name</div>
                    <input type="text" name="full-name" placeholder="E.g. mohmad" class="input-responsive" required>

                    <div class="order-label">Phone Number</div>
                    <input type="tel" name="contact" placeholder="E.g. 553xxxxxx" class="input-responsive" required>

                    <div class="order-label">Email</div>
                    <input type="email" name="email" placeholder="E.g. md@gmail.com" class="input-responsive" required>

                    <div class="order-label">Address</div>
                    <textarea name="address" rows="10" placeholder="E.g. Street, City, Country" class="input-responsive" required></textarea>

                    <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
                </fieldset>

            </form>
        <?php  
        //check whether button is clicked or not
        if(isset($_POST['submit'])){
            //get all deatials
            $food=$_POST['food'];
            $price=$_POST['price'];
            $qty=$_POST['qty'];
            $total=$price * $qty;
            $order_date=date("Y-m-d h:i:sa");//order date 
            $status = "ordered"; //
            $customer_name=$_POST['full-name'];
            $customer_contact=$_POST['contact'];
            $customer_email=$_POST['email'];
            $customer_address=$_POST['address'];
            //save the order in data base
            //creat sql to save the data
            $sql2="INSERT INTO tbl_order SET 
                food='$food',
                price=$price,
                qty=$qty,
                total=$total,
                order_date='$order_date',
                status = '$status',
                customer_name='$customer_name',
                customer_contact='$customer_contact',
                customer_email='$customer_email',
                customer_address='$customer_address'

            ";
            echo $sql2;die();
            //excute the query
            $res2=mysqli_query($conn,$sql2);
            //check whether query excuted successfuly
            if($res2==true){
                $_SESSION['order']="<div class='succes'>food ordered successfuly.</div>";
                header('location:'.SITEURL);
            }else{
                $_SESSION['order']="<div class='error'>food not ordered  .</div>";
                header('location:'.SITEURL);
            }
           
        }
        ?>
        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->
    <?php include('partial-front/footer.php');?>