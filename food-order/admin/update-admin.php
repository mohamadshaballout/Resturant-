<?php 
include('partial/menu.php');?>
    <div class="wrapper">
    <h1>update admin</h1>
    <br><br>
    <?php
        //get the id of selected admin
        $id=$_GET['id'];
        //creat sql query to get the details
        $sql ="SELECT * FROM tbl_admin  WHERE id=$id";
        //excute the query
        $res =mysqli_query($conn,$sql);
        //check wether the query is excuted or not
        if($res==TRUE){
            //check the whether the data is avliable or not
            $count=mysqli_num_rows($res);
            //check wether we have admin data or not 
            if($count==1){
                //get the details 
                //echo "admin avaliable";
                $row=mysqli_fetch_assoc($res);
                $fullname=$row['full_name'];
                $username=$row['username'];
            }else{
                //redirect to manage page
                header('location'.SITEURL.'admin/manage-admin.php');
            }
        }
    ?>
    <form action="" method="POST">
        <table class="tbl-30">
            <tr>
                <td>FULL NAME</td>
                 <td><input type="text" name="full_name" value="<?php echo $fullname;?>"></td>   
                 </tr><tr><td>username: </td>
            <td><input type=" text" name="username" value=" <?php echo $username?>"></td>
        </tr>
           <tr>
                <td colspan="2">
                    <input type="hidden" name="id" value="<?php echo$id ?>">
                    <input type="submit" name="submit" value="update Admin" class="btn-secondry">
                </td>

           </tr>



        </table>


    </form>    
    
</div>

<?php   
       //check wether the submit botton is clicked or not
       if(isset($_POST['submit'])) {
         //get all the values from form to update
         $id=$_POST['id'];
         $fullname=$_POST['full_name'];
         $username=$_POST{'username'};
       
        //creat sql query to update admin
        $sql ="UPDATE tbl_admin SET full_name='$fullname',
        username='$username' WHERE id='$id'";
        //excute the query
        $res =mysqli_query($conn,$sql);
        //check whether the query excuted or not
        if($res==true){
            //query excuted and admin updated
            $_SESSION['update']="<div class='succes'>admin updated successfuly.</div>";
            header('location:'.SITEURL."admin/manag-admin.php");
        }else{
            //failed to update admin
            $_SESSION['update']="<div class='error'> failed to update admin.</div>";
            header('location:'.SITEURL."admin/manag-admin.php");
        }
        
        }
?>

<?php include('partial/footer.php');
?>