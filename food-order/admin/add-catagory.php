<?php
include('partial/menu.php');?>
<div class="main-content">
    <div class="wrapper">
    <h1>add catagory</h1>
    <br><br>
    <?php  
    if(isset($_SESSION['add'])){
        echo $_SESSION['add'];
        unset($_SESSION['add']);
    }  
    if(isset($_SESSION['upload'])){
        echo $_SESSION['upload'];
        unset($_SESSION['upload']);
    }  
    ?><br><br>
   
    <!-- add catogory form start--> 
    <form action="" method="POST" enctype="multipart/form-data">
        <table class="tbl-30">
            <tr>
                <td>title name</td>
                <td><input type="text" name="title" placeholder="category title"></td>
            </tr>
            <tr>
                <td >select image</td>
                <td><input type="file" name="image"></td>
            </tr>
            <tr><td>feature</td>
        <td>
            <input type="radio" name="featured" value="yes">yes
            <input type="radio" name="featured" value="no">No
        </td></tr>
        <tr><td>
            active:
        </td><td><input type="radio" name="active" value="yes">yes
        <input type="radio" name="active" value="no">no        
    </td></tr>
    <tr>
        <td colspan="2">
            <input type="submit" name="submit" value="add category" class="btn-secondry">
            
        </td>
    </tr>

        </table>
    </form>
    <!-- add catogory form ends-->  
    <?php
    //check subimt botton is clicked or not
    if(isset($_POST['submit'])){
        //get value from our form 
        $title=$_POST['title'];
        // for radio input tyoe we need to check whether botton is selected or not
        if(isset($_POST['featured'])){
            //get the value from the form 
            $featured=$_POST['featured'];

        }else{
            //set defualt value
            $featured="no";
        }
        if(isset($_POST['active'])){
            $active=$_POST['active'];
        }else{
            $active="no";
        }
        //check whether the imagem is elected or not and set value for image name accordingly
        print_r($_FILES['image']);
        
        if(isset($_FILES['image']['name'])){
            //upload the image
            //to upload image we need imagem name and sourcce path and distention path
            $image_name= $_FILES['image']['name'];
            //upload image only if image selected
            if($image_name!=""){

                
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
                        header('location:'.SITEURL.'admin/add-catagory.php');
                        //stop the process
                        die();
            } }
        }else{
            //don't upload image and set the image value as blank
            $image_name="";
        }
        //creat sql query to insert into data base
        $sql="INSERT INTO tbl_catagories SET
         title='$title',
        image_name='$image_name',
        featured='$featured',
        active='$active' 
        ";
    //3 excute the query and save in data base
    $res=mysqli_query($conn,$sql);
    //4. check whether the query excuted or not
    if($res==true){
        //query excuted and category added
        $_SESSION['add']="<div class='succes'>category added successfuly.</div>";
        //redirect to manage category page
        header('location:'.SITEURL.'admin/manag-category.php');
    }else{
        //failed to add category
        $_SESSION['add']="<div class='error'>category failed to add successfuly.</div>";
        //redirect to manage category page
        header('location:'.SITEURL.'admin/add-category.php');
    }

    }
    
    
    ?>    
    </div>            
    </div>
<?php include('partial/footer.php');?>

