<?php 
//include constants file
include('../config/constants.php');
  //check whther the id and image_name is set or not
  if(isset($_GET['id']) AND isset($_GET['image_name'])){
        //get the valiue and delete
        $id=$_GET['id'];
        $image_name=$_GET['image_name'];
        //remve the physiical image file if avliable 
        if($image_name!=""){
            $path ="../images/category/".$image_name;
            //remove the image
            $remove=unlink($path);
            //if fail to remove image rhen add an error message and stop process

            if($remove==false){
                //set the session message then to redirect to manage category and stop procces
                $_SESSION['remove']="<div class='error'>failed to remove image.</div>";
                header('location:'.SITEURL.'admin/manag-category.php');
                
                die();

            }
        }
        //delete the data from database
        //sql query delete data from data base
        $sql="DELETE FROM tbl_catagories WHERE id=$id";
        //excute the query
        $res=mysqli_query($conn,$sql);
        //check the data is delete or not
        if($res==true){
            //set succes message and redirect
            $_SESSION['delete']="<div class='succes'>category deleted successfuly.</div>";
            //redirect to manage categorey
            header('location:'.SITEURL.'admin/manag-category.php');

        }else {
            //set fail message and redirect
            $_SESSION['delete']="<div class='error'>failed to delete successfully.</div>";
            //redirect to manage categorey
            header('location:'.SITEURL.'admin/manag-category.php');

        }

        //redirect to manage category page with message
  }else{
      //redirect to manage category page
      header('location:'.SITEURL.'admin/manag-category.php');
  }

?>