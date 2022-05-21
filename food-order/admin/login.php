<?php include("../config/constants.php")   ?>
<html>
    <head>
        <title>login food order system</title>
        <link rel="stylesheet" href="../css/admin.css">
    </head>
    <body>
        <div class="login">
            <h1 class="text-center">login</h1><br><br>
            <?php 
            if(isset($_SESSION['login'])){
                echo $_SESSION['login'];
                unset($_SESSION['login']);
            }
            if(isset($_SESSION['no-login-message'])){
                echo $_SESSION['no-login-message'];
                unset($_SESSION['no-login-message']);
            }
            ?>
            <!--form start here-->
            <form action="" method="POST" class="text-center">
            username;<br>
            <input type="text" name="username" placeholder="enter user name"><br><br>
            
            password :<br>
            <input type="password" name="password" placeholder="enter password"><br><br>
            <input type="submit" name="submit" value="login" class="btn-primary">
            <br><br>

                </form>




            <p class="text-center">created by <a href="www.mohamd.com">mohamad shaballout</a></p>
        </div>
    </body>
</html>

<?php 
//CHECK WHETEH THE SUBMIT OR NOT
if(isset($_POST['submit'])){
    //proccess for login
    //1- get the data from login form
    $username=$_POST['username'];
    $password =md5($_POST['password']);
    //2- check whether the user name and password exists or not
    $sql="SELECT * FROM tbl_admin WHERE username='$username' AND password='$password'";
    // 3- excute the query 
    $res=mysqli_query($conn,$sql);
    //4- count the rows to check whether the user is exists or not
    $count=mysqli_num_rows($res);
    if($count==1){
        //user availble
        $_SESSION['login']="<div class='succes text-center'>login successful.</div> ";
        $_SESSION['user']=$username;//to check the user is logedin  or not and logout will unset it

        //redirect to home page/dashboard
        header('location:'.SITEURL.'admin/');
 
    }else{
        //user not availble and login failed
        $_SESSION['login']="<div class='error text-center' >user name or password not match.</div> ";
        //redirect to home page/dashboard
        header('location:'.SITEURL.'admin/login.php');
    }

}

?>