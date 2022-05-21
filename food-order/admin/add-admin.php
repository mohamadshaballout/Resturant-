<?php 
include('partial/menu.php');?>
<?php 

?>

<div class="main-content">
        <div class="wrapper">
            <h1>add admin</h1>
            <br><br>
            <?php 
                if(isset($_SESSION['add'])){//checking whether session set or not
                    echo $_SESSION['add'];// display session message if set
                    unset($_SESSION['add']);//remove session message
                }
            
            
            ?>
            <form action="" method="POST">
                <table class="tbl-30">
                    <tr>
                        <td>
                            full name
                        </td>
                        <td><input type="text" name="full_name" placeholder="enter your name"></td>
                    </tr>
                <tr>
                    <td>user name : </td>
                    <td>
                        <input type="text" name="username" placeholder="enter your username">
                    </td>
                <tr>
                    <td>password</td>
                    <td>
                        <input type="password" name="password" placeholder="password">
                    </td>


                </tr>    


                
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="add admin" class="btn-secondry"></td>
                </tr>

                </table>



            </form>
        </div>

</div>



<?php include('partial/footer.php') ?>
<?php 
 //procces the value and save it in data base
 // check whether the submit botton is clicked or not
     if(isset($_POST['submit'])){
         //botton clicked
         //get data from the form
         $full_name=$_POST['full_name'];
         $username=$_POST['username'];
         $password=md5($_POST['password']);
         if(empty($full_name)){
             echo "pls add your full name";
         }elseif(empty($username)){
             echo "pls choose username";
         }elseif(empty($password)){
             echo "pls choose password";
         }else{
         // sql query to save the data into database
         $sql= "INSERT INTO tbl_admin (full_name,username,password) VALUES
            ('$full_name','$username','$password')
             ";}
                    
            //3. excuting query and saving data into database
            $res = mysqli_query($conn,$sql);

            //4. check data wehter inserted or not and dispaly message
            if($res==TRUE){
                //echo "data inserted";
                //creat variable to display meassage
                $_SESSION['add']="admin successfuly added";
                //redirect page TO MANAG ADMIN
               header("location:".SITEURL.'admin/manag-admin.php'); 
           }else{
               // echo "not "; 
                   //creat variable to display meassage
                   $_SESSION['add']="faild to add admin";
                   //redirect page TO MANAG ADMIN
                   header("location:".SITEURL.'admin/add-admin.php');  
            }
            }
     

?>
