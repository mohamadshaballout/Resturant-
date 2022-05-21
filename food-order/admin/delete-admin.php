<?php
//include contsants here
include('../config/constants.php');
//1- get the id of the admon to be deleted
echo $id = $_GET['id'];


//2-crreate sql query to delete admin
$sql ="DELETE FROM tbl_admin WHERE id=$id";
//excute the query 
$res =mysqli_query($conn,$sql);
//check wehether query excuted succefully
if($res==TRUE){
//query excuted succesfuuly and admin deleted 
   // echo "admin deleted";
   //creat session variablr to display message
   $_SESSION['delete']="<div class='succes' >admin delete successfuly.</div>";
   //redirect to manage Admin page
   header('location:'.SITEURL.'admin/manag-admin.php');
}else{
    //failed to delete the admin
    $_SESSION['delete']="<div class='error'>failed to delete admin try agian.</div>";
    header('location'.SITEURL.'admin/manag-admin.php');
}


//3- redirect to manage admin page with message(succes/error)





?>