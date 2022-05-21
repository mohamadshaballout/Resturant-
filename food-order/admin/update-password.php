<?php 
include('partial/menu.php');
?>
<div class="wrapper">
    <h1>change password</h1>
    <br><br>
    <?php 
        if(isset($_GET['id'])){
            $id=$_GET['id'];
        }
    ?>
    <form action="" method="POST">
        <table class="tbl-30">
            <tr>
                <td>currnet password:</td>
                <td><input type="password" name="current_password" placeholder="current password"></td>

            </tr><tr>
                <td>new password</td>
                <td>
                    <input type="password" name="new_password" placeholder="New password">

                </td><tr><td>confirm password</td>
            <td><input type="password" name="confirm_password" placeholder="confirm password"></td></tr>
            </tr>
            <tr>
                <td colspan="2">
                    <input type="hidden" name="id" value="<?php echo $id;?>">
                    <input type="submit" name="submit" value="change password" class="btn-secondry">

                </td>
            </tr>

        </table>
    </form>
</div>
<?php 
    //check wether the submit clicked or not 
    if(isset($_POST['submit'])){
        //echo "clicked"
        //1-get data from form
        $id=$_POST['id'];
        $current_password=md5($_POST['current_password']);
        $new_password=md5($_POST['new_password']);
        $confirm_password=md5($_POST['confirm_password']);
        //2- check the user with the current password id and current password exists or not
        $sql="SELECT * FROM tbl_admin WHERE id=$id AND password='$current_password'";
        //excute the query
        $res=mysqli_query($conn,$sql);
        if($res==true){
            //check whether data is avliable or not
            $count=mysqli_num_rows($res);
                if($count==1){
                //USERR EXISTS AND PASSWORD CAN CHANGED
                //check whether the new password and confirm match or not
                if($new_password==$confirm_password){
                    //update password
                    $sql2="UPDATE tbl_admin SET password='$new_password' WHERE id=$id";
                    //excute the query 
                    $res2=mysqli_query($conn,$sql2);
                    //check whether query excuted or not
                    if($res2==true){
                        //display succes message
                        //redirect to manage admin page with error
                    $_SESSION['change-pwd']="<div class='succes'> password changed successfuly.</div>";
                    //rederict user
                    header('location:'.SITEURL.'admin/manag-admin.php');
                    }else{
                        //display error message
                        //redirect to manage admin page with error
                    $_SESSION['change-pwd']="<div class=''> password failed to changed successfuly.</div>";
                    //rederict user
                    header('location:'.SITEURL.'admin/manag-admin.php');
                    }

                }else{
                    //redirect to manage admin page with error
                    $_SESSION['pwd-not-match']="<div class='error'> password not match.</div>";
                    //rederict user
                    header('location:'.SITEURL.'admin/manag-admin.php');
                }
                 
                 }else{
                     //user not exist set message and redirect
                     $_SESSION['user-not-found']="<div class='error'> user not found.</div>";
                         //rederict user
                         header('location:'.SITEURL.'admin/manag-admin.php');
                     }
                 }
        //3- check the current or the current or the new password match or not
        //4- update password if all above is true

    }
?>

<?php
    include('partial/footer.php');
?>