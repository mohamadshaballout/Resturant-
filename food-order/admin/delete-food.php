<?php 
//inculde constants page
include('../config/constants.php');
if(isset($_GET['id']) && isset($_GET['image_name'])){
    //proccess to delete 
    //get id and image name
    $id=$_GET['id'];
    $image_name=$_GET['iamge_name'];

    //remove the image if aviliable
    //check whther the image avaliabel and delete it if avliable
    if($image_name!=""){
        //it has image and need to remove from folder
        //get the image path
        $path="../images/food/".$image_name;
        //remove image file
        $remove=unlink($path);//check whether the image is removed or not
        if($remove==false){
            //dailed to remove
            $_SESSION['uppload']="<div class='error'>failed to remove the image</div>";
            //redirect to manage food
            header('location:'.SITEURL.'admin/manag-food.php');
            //stop the proccess 
            die();
        }else{

        }
    }
    //delete food from data base
    $sql="DELETE FROM tbl_food WHERE id=$id";
    //excute the query
    $res=mysqli_query($conn,$sql);
    //check whether the query excuted or notamd set the session message respectivly
    if($res==true){
        //food deleted
        $_SESSION['delete']="<div class='acces'>food deleted successfuly.</div>";
        header('location:'.SITEURL.'admin/manag-food.php');
    }else{
        $_SESSION['delete']="<div class='error'>food not deleted. </div>";
        header('location:'.SITEURL.'admin/manag-food.php');

    }
    //redirect to manage food with session msessage
}else{
    //redirect to manage food page
    $_SESSION['unauthoriz']="<div class='error'>acces denied.</div>";
    header('location:'.SITEURL.'admin/manag-food.php');
}
?>