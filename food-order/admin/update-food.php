<?php 
include('partial/menu.php');
?>
<?php 
    //check whether id is set or not 
    if(isset($_GET['id'])){
        //get all the details
        $id=$_GET['id'];
        //sql query to get selected food
        $sql2="SELECT * FROM tbl_food WHERE id=$id";
        //excute the qurey
        $res2=mysqli_query($conn,$sql2);
        //get the value base on query excuted
        $row2=mysqli_fetch_assoc($res2);
        //got the individal value of selected food
        $title=$row2['title'];
        $description=$row2['description'];
        $price =$row2['price'];
        $current_image=$row2['image_name'];
        $current_category=$row2['catagories_id'];
        $featured=$row2['featured'];
        $active=$row2['active'];
    }else{
        //redirect to manage food
        header('location:'.SITEURL.'admin/manag-food.php');
        
    }
?>
<div class="main-content">
    <div class="wrapper">
        <h1>update food</h1>
        <br><br>
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-50">
                <tr>
                    <td>title</td>
                    <td><input type="text" name="title" value="<?php echo $title;?>" ></td>
                </tr>
                <tr>
                    <td>description</td>
                    <td><textarea name="description" cols="5" rows="5" value="<?php echo $description;?>"></textarea></td>
                </tr>
                <tr>
                    <td>price</td>
                    <td><input type="number" name="price" value="<?php echo $price;?>"></td>
                </tr>
                <tr><td>current image</td>
            <td>display the image</td></tr>
            <tr>  
                <td>
                    <?php
                        if($current_image==""){
                            //image not avilable
                            echo "<div class='error'>image not availiable</div>";
                        }else{
                            //image availiable
                            ?>
                            <img src="<?php echo SITEURL; ?>images/food/<?php echo $current_image; ?>" width='150px'>
                            <?php
                        }
                    ?>
                </td>
                <td><input type="file" name="image" ></td>
            </tr>
            <tr><td>category:</td>
            <td><select name="category" >
                <?php 
                    $sql="SELECT * FROM tbl_food WHERE active='yes'";
                    //excute the query
                    $res=mysqli_query($conn,$sql);
                    $count=mysqli_num_rows($res);
                    //check whether caetgory availble or not
                    if($count>0){
                        //category avliable
                        while($row=mysqli_fetch_assoc($res)){
                            $categore_title=$row['title'];
                            $categore_id=$row['id'];
                           // echo "<option value='$categore_id'>$category_title</option>";
                            ?>  
                                <option <?php if($current_category==$categore_id){echo "selected"; } ?> value="<?php echo $categore_id; ?>"><?php echo $categore_title; ?></option>
                            <?php
                        }
                    }else{
                          //category not availible
                          echo "<option value='0'>category not available.</option>";

                    }
                ?>
                <option value="0">test category</option>
            </select></td></tr>
            <tr>
                <td>featured</td>
                <td><input <?php 
                                if($featured=="yes"){
                                    echo "checked";
                                }
                                    ?> type="radio" name="featured" value="yes">yes
                    <input <?php 
                                if($featured=="no"){
                                    echo "checked";
                                }
                                    ?> type="radio" name="featured" value="no">no    
            </td>
            </tr>
            <tr>
                <td>active</td>
                <td><input 
                <?php 
                                if($active=="yes"){
                                    echo "checked";
                                }
                                    ?>  
                          type="radio" name="active" value="yes">yes
                    <input  
                    <?php 
                                if($active=="no"){
                                    echo "checked";
                                }
                                    ?>
                        
                        type="radio" name="active" value="no">no    
            </td>
            </tr>
            <tr>
                <td> 
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                    <input type="submit" name="submit" value="update food" class="btn-secondry">
                </td>
            </tr>

            </table>
        </form>
         <?php
            if(isset($_POST['submit'])){
              //  echo "button clicked";
              //1-get all the details from the form 
              $id=$_POST['id'];
              $title=$_POST['title'];
              $description=$_POST['description'];
              $price=$_POST['price'];
              $current_image=$_POST['current_iamge'];
              $category=$_POST['category'];
              $featured=$_POST['featured'];
              $active=$_POST['active'];
              //2- upload the image if selected
               //check whether upload button is clicked or not
               if(isset($_FILES['image']['name'])){
                   $image_name=$_FILES['image']['name'];//new image name
                   if($image_name!=""){
                       //image is avliable
                       //uploading new image

                       //rename the image
                       $ext=end(explode('.',$image_name));

                       $image_name="food-name".rand(0000,9999).'.'.$ext;
                        //get the source path and distination path
                        $src_path=$_FILES['image']['tmp_name'];
                        $dest_path="../images/food/".$image_name;
                        //upload the image
                        $upload=move_uploaded_file($src_path,$dest_path);
                        //check whetther the image is uploaded or not
                        if($upload==false){
                            $_SESSION['upload']="<div class='error'>failed to upload new image.</div>";
                            //redirect to manage food
                            header('location:'.SITEURL.'admin/maang-food.php');
                            die();
                    
                        }
                        //3-remove the image if the new image isuploaded and current image exists
                        //remove current image avilaible
                        if($current_image!=""){
                            //current image availiable
                            //remove the image
                            $remove_path="../images/food/".$current_image;
                            $remove=unlink($remove_path);
                            //check whether the image is removed or not
                            if($remove==false){
                                //faile to remove the current image
                                $_SESSION['remove-failed']="<div class='error'>failed to remove current image.</div>";
                                //redirect to manage food
                                header('location:'.SITEURL.'admin/manag-food.php');
                                die();
                            }
                        }
                   
                    }else{
                        $image_name=$current_image;
                    }
               }else{
                   $image_name=$current_image;
               }
              
              //4-update the food in data base
              $sql3="UPDATE tbl_food SET 
                    title='$title',
                    description='description',
                    price=$price,
                    image_name='$image_name',
                    catagories_id='$category',
                    featured='$featured',
                    active='$active' 
                    WHERE id=$id
                    ";
               //excute query
               $res3=mysqli_query($conn,$sql3);
               if($res3==true){
                   //query excuted the query and food updated
                   $_SESSION['update']="<div class='succes'>food updated successfuly.</div>";
                   header('location:'.SITEURL.'admin/manag-food.php');

               } else{
                $_SESSION['update']="<div class='error'>failed to update food successfuly.</div>";
                header('location:'.SITEURL.'admin/manag-food.php');
               }
              //redreicet to manage food with session message

            }
            ?>                       
    </div>
</div>
<?php include('partial/footer.php');?>