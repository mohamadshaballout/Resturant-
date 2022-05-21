<?php  
include('partial/menu.php');?>
<div class="main-content">
<div class='wrapper' >
    <h1>add food</h1>
    <br><br>
    <?php
        if(isset($_SESSION['uplaod'])){
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        } ?>
    <form action="" method="POST" enctype="multipart/form-data">
        <table class="tbl-30">
            <tr><td>title</td>
        <td><input type="text" name="title" placeholder="add your title please"></td></tr>
        <tr><td>description</td><td><textarea name="description" clos="30" rows="5" placeholder="description of the food"></textarea></td></tr>
        <tr><td>price</td><td><input type="number" name="price"></td></tr>
        <tr><td>select image:</td><td>
    <input type="file" name="image"></td></tr> 
    <tr><td>category:</td><td><select name="category" >
                        <?php
                            //creat code to dsiplay category from database
                            //1- creat sql to get sql all active category from database
                            $sql="SELECT * FROM tbl_catagories WHERE active='yes'";
                            $res=mysqli_query($conn,$sql);

                            //count row to check whether we have caegories or not
                            $count=mysqli_num_rows($res);
                            //if count greater than 0 else we dont have caegory
                            if($count>0){
                                //we have category
                               while($row=mysqli_fetch_assoc($res)){
                                   //get the details of category 
                                   $id=$row['id'];
                                   $title=$row['title'];?>
                                <option value="<?php echo $id; ?>"><?php echo $title; ?></option>    
                                   <?php
                               }     
                            }else{
                                //we don't have category
                                ?>
                                <option value="0">no caegory found</option>
                                <?php
                            }

                            
                            //2display on dropdwon
                            ?>
                         
                            </select>   </td></tr> 
                            <tr><td>featured:</td><td>
                                <input type="radio" name="featured" value="yes">yes
                                <input type="radio" name="featured" value="no">no                               
                            </td></tr> 
                            <tr><td>Active</td>
                        <td>
                        <input type="radio" name="active" value="yes">yes
                                <input type="radio" name="active" value="no">no  
                        </td></tr>
                        <tr><td colspan="2">
                            <input type="submit" name="submit" value="add food" class=btn-secondry>
                        </td></tr>
    </table>
    </form>
    <?php
    //check whether the botton if click or not
    if(isset($_POST['submit'])){
        //add the food successfuly
        //1- get the data from form 
        $title=$_POST['title'];
        $description=$_POST['description'];
        $price=$_POST['price'];
        $category=$_POST['category'];
        //check radio botton for featured and active are checked or npot
        if(isset($_POST['featured'])){
            $featured=$_POST['featured'];
        }else{
            $featured="no";
        }
        if(isset($_POST['active'])){
            $active =$_POST['active'];

        }else{
            $active="no";
        }
        //upload the image if selected
        //check whether the select image is clicked or not and upload the image only the image is selected
        if(isset($_FILES['image']['name'])){
            // get the detials of the selected image
            $image_name=$_FILES['image']['name'];
            //check whther the image is selected or not and upload image only if selected
            if($image_name!=""){
                //image is selected
                //1-rename the image 
                //get the extenstion of selected image(jpg,png,..)
                $ext=end(explode('.',$image_name));
                //crate new name
                $image_name="food-name".rand(0000,9999).".".$ext;//new image name"food name"
                //upload the image
                //get the source path and destination path
                //source path is the current location of tje image
                $src=$_FILES['image']['tmp_name'];
                //destination path of the image to be uploaded
                $dst="../images/food/".$image_name;
                //uplaod the food image
                $upload=move_uploaded_file($src,$dst);
                //check whther the image uploaded or not
                if($upload==false){
                    //failed to uplaod the image
                    //redirect to add food image with the error message
                    $_SESSION['upload']="<div class='error'>failed to uplaod the iamge.</div>";
                    header('location:'.SITEURL.'addmin/add-food.php');
                    //stop the procces;
                    die();
                }

            }

        }else{
            $image_name="";//setting defult value as blank
        }
        //2- insert the data into data base
        //craeat sqlquery to save pr add food
        $sql2="INSERT INTO tbl_food SET
               title='$title',
               description='$description',
               price=$price,
               image_name='$image_name',
               catagories_id= $category,
               featured='$featured', 
               active='$active'         
            ";
            //excute the query
            $res2 = mysqli_query($conn,$sql2);
              //3- redirect with message to manage food page

            //check the data inseted or not
            if($res2 == true){
                //data inserted successfuly
                $_SESSION['add']="<div class='succes'>food added successful.</div>";
                header('location:'.SITEURL.'admin/manag-food.php');
            }else{
                $_SESSION['add']="<div class='error'>faild to add food  successfuly.</div>";
                header('location:'.SITEURL.'admin/manag-food.php');
            }
      
    }    
    ?>
</div>

</div>






<?php include('partial/footer.php');
?>