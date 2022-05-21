<?php
include('partial/menu.php');?>
<div class="main-content">
    <div class="wrapper">
        <h1>update category</h1><br><br>
        <?php
           //check whether the id is set or not
           if(isset($_GET['id'])){
              //get the id to all other details  
              $id=$_GET['id'];
              //creat sql query to get all other deatails
              $sql="SELECT * FROM tbl_catagories WHERE id=$id";
              //excute the queury
              $res=mysqli_query($conn,$sql);
              //count the rows to check whether the id or not
              $count =mysqli_num_rows($res);
              if($count==1){
                  //got all data
                  $row =mysqli_fetch_assoc($res);
                  $title=$row['title'];
                  $current_image=$row['image_name'];
                  $featured=$row['featured'];
                  $active=$row['active'];
                  

              }  else{
                  //reredirect to manag category with session message
                  $_SESSION['no-catagory-found']="<div class='error'>category not found.</div";
                  header('location:'.SITEURL.'admin/manag-category.php');
              }
           }else{
               //redirect to manage category
               header('location:'.SITEURL.'admin/manag-category.php');

           }
        
        ?>
        <form action="" method="POST" enctype="multipart/form-data">
                    <table class="tbl-30">
                        <tr>
                            <td>title</td>
                            <td><input type="text" name="title" value="<?php echo $title; ?>"></td>
            </tr>
            <tr>    
                <td>current image</td>
                <td><?php
                  if($current_image != ""){
                      //display the image 
                      ?>
                     <img src="<?php echo SITEURL; ?>images/category/<?php echo $current_image; ?>" width="100px">
                      <?php

                  }else{
                      //dispaly message
                      echo "<div class='error'>image not added.</div>";
                  }
                ?></td>
            </tr>
            <tr>
                <td>new image</td>
                <td><input type="file" name="image"></td>
            </tr>
            <tr>
                <td>featured</td>
                <td><input <?php if($featured=="yes"){echo "checked";} ?> type="radio" name="featured" value="yes">yes
                    <input  <?php if($featured=="no"){echo "checked";} ?>type="radio" name="featured" value="no"> No      
            </td>
            </tr>
            <tr><td>active</td>
                <td>
                    <input <?php if($active=="yes"){echo "checked";} ?>  type="radio" name="active" value="yes">yes
                    <input <?php if($active=="no"){echo "checked";} ?>  type="radio" name="active" value="no">No
                </td>
            </tr>
            <tr><td>
            <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">    
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <input type="submit" name="submit" value="update category" class="btn-secondry"></td></tr>
                    </table>
                
         </form>
         <?php 
            if(isset($_POST['submit'])){
                //get all value from our form
                $id = $_POST['id'];
                $title=$_POST['title'];
                $current_image=$_POST['current_image'];
                $featured=$_POST['featured'];
                $active=$_POST['active'];
                //updating new image if selected 
                //check the image is selcected or not
                if(isset($_FILES['image']['name'])){
                    //get the image detials
                    $image_name=$_FILES['image']['name'];
                    //check wether the image is avliable or not
                    if($image_name!= ""){
                        //image available
                        //upload the new image 
                           //auto rename our image
                    //get extension of our image e.g "food1.jpg"
                    $ext =end(explode('.',$image_name));//get the last value jpg
                    
                    //rename the image 
                    $image_name="food_category_".rand(000,999).'.'.$ext;//food_category_841.jpg//تغيير اسم الصورة 
                    
                    $source_path= $_FILES['image']['tmp_name'];
                    $destination_path ="../images/category/".$image_name;
                    //upload the image
                    $upload=move_uploaded_file($source_path, $destination_path);
                    //check that image upload or not 
                    //and if image not uploaaded we will stop process and redirect 
                    if($upload==FALSE)
                    {
                        $_SESSION['upload'] = "<div class='error'>failed to upload image.</div>";
                        header('location:'.SITEURL.'admin/manag-catagory.php');
                        //stop the process
                        die();
            } 

                        //remove the current image if availible
                        if($current_image!=""){
                            $remove_path ="../images/category/".$current_image;
                        $remove= unlink($remove_path);
                        //check whether is removed or not if failed to remove then display process
                        if($remove==false){
                            //failed to remove image
                            $_SESSION['failed remove']="<div class='error'>failed to remove the image.</div>";
                            header('location:'.SITEURL.'admin/manage-category.php');
                            die();//stop the procces
                        }
                        }
                        

                    }
                    else{
                        $image_name=$current_image;  
                    }}
                    else{
                    $image_name=$current_image;    
                }
               
               //updtae the database 
               $sql2="UPDATE tbl_catagories SET title ='$title',
                                            image_name='$image_name',
                                            featured='$featured',
                                            active='$active'
                                        WHERE id=$id";
                //excute the query
                $res2=mysqli_query($conn,$sql2);
                //redirect to manage category with message
                //check whether excuted or not
                if($res2==true){
                     //category updated
                     $_SESSION['update']="<div class='succes'>categorey updated successfuly</div>";
                     header('location:'.SITEURL.'admin/manag-category.php');

                    }else{
                        //failed to update caegory
                        $_SESSION['update']="<div class='error'>categorey failed to update successfuly</div>";
                        header('location:'.SITEURL.'admin/manag-category.php');
                    }
                
            }
         ?>
    </div>
</div>



<?php
  include('partial/footer.php');

?>