<?php 
 include('partial/menu.php');

?>
   <!--menu content section start*/ -->
   <div class="main-content"><div class="wrapper">   
   <h1>manag-admin</h1>
   <br/>
   

      <?php   
       if(isset($_SESSION['add'])){
          echo $_SESSION['add'];
          unset($_SESSION['add']);
       }
      
       
       if(isset($_SESSION['delete'])){
            echo $_SESSION['delete'];
            unset($_SESSION['delete']);

       }
       if(isset($_SESSION['update'])){
          echo $_SESSION['update'];
          unset($_SESSION['update']);
       }
       if(isset($_SESSION['user-not-found'])){
          echo $_SESSION['user-not-found'];
          unset($_SESSION['user-not-found']);
       }
       if(isset($_SESSION['pwd-not-match'])){
         echo $_SESSION['pwd-not-match'];
         unset($_SESSION['change-pwd']);}
       if(isset($_SESSION['change-pwd'])){
          echo $_SESSION['change-pwd'];
         unset($_SESSION['change-pwd']);}
         

      ?><br><br>
   <!-- bottom to add admin-->
   <a href="add-admin.php" class="btn-primary">add admin</a>
   <table  class="tbl-full"> 
<br/><br/>
     <tr><th>S.N</th><th>full name</th><th>username</th><th>action</th></tr>
      <?php 
         $sql="SELECT * FROM tbl_admin";
         $res =mysqli_query($conn, $sql);
         //check whether the query is executed
         if($res==TRUE){
            //count rows to check wether if we have data in data base or not 
            $rows=mysqli_num_rows($res);
            $sn=1;// creat variable and assign the value
            //check the num of rwos
            if($rows>0){
            
                  //we hava data in database
                 while($rows=mysqli_fetch_assoc($res)) {
                    //using while loop to get data from database.
                    //and while loop will run as lom=ng as we have data in data base
                    //get individal data
                    $id=$rows['id'];
                    $full_name=$rows['full_name'];
                    $username=$rows['username'];
                    //display thr value in our table
                     ?>
                      <tr>
                           <td><?php echo $sn++  ?></td><td><?php echo $full_name;?></td>
                        <td><?php echo $username;?></td>
                        <td>
                            <a href="<?php echo SITEURL; ?>admin/update-password.php?id=<?php echo $id;?>" class="btn-primary">change password</a>
                           <a href="<?php echo SITEURL; ?>admin/update-admin.php?id=<?php echo $id;?>" class="btn-secondry"> update admin</a>
                            <a href="<?php echo SITEURL; ?>admin/delete-admin.php?id=<?php echo $id;?>" class="btn-danger"> delete admin </a>
                        </td></tr>
                     <?php 
                 }
            }else{

            }

         }
      
      ?>


     
  </table>
  
        
        
</div></div>
   <!--main content section end*/ -->
   <?php 
include('partial/footer.php');?>
