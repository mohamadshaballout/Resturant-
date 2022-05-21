<?php  
include('partial/menu.php')?>
<div class="main-content">
   <div class="wrapper"> <h1>manag-food</h1>
   <br/>
   <br>
   
   <!-- bottom to add admin-->
   <a href="<?PHP echo SITEURL; ?>admin/add-food.php" class="btn-primary">add food</a>
   <?php 
      if(isset($_SESSION['add'])){
         echo $_SESSION['add'];
         unset($_SESSION['add']);
      }
      if(isset($_SESSION['delete'])){
         $_SESSION['delete'];
         unset($_SESSION['delete']);
      }
      if(isset($_SESSION['upload'])){
         $_SESSION['upload'];
         unset($_SESSION['upload']);
      }
      if(isset($_SESSION['unauthoriz'])){
         $_SESSION['unauthoriz'];
         unset($_SESSION['unauthoriz0']);
      }
      if(isset($_SESSION['update'])){
         $_SESSION['update'];
         unset($_SESSION['update']);
      }
   ?>

   <table  class="tbl-full"> 
<br/><br/>
     <tr><th>S.N</th><th>title</th><th>price</th><th>image</th><th>featured</th><th>active</th><th>action</th></tr>
     <?php 
         //creat sql query to get all the food 
         $sql="SELECT * FROM tbl_food";
         //excute the query
         $res=mysqli_query($conn,$sql);
         //count the rows to check wether we have food or not
         $count= mysqli_num_rows($res);
         //creat sn variable and set defult value ass1
         $sn=1;
         if($count>0){
            //we have food in database
            //get the food from database and display
            while($row=mysqli_fetch_assoc($res)){
               //get value from individals columns
               $id=$row['id'];
               $title=$row['title'];
               $price=$row['price'];
               $image_name=$row['image_name'];
               $featured=$row['featured'];
               $active=$row['active'];?>
               <tr><td><?php $sn++;?></td><td><?php echo $title; ?></td><td><?php echo $price; ?></td>
               <td><?php 
               //check wether we have image or not
               if($image_name==""){
                  //we don't have image display error message
                  echo "<div class='error'>image not added</div>";
               }else{
                  //dispaly the image
                  ?>
                  <img src="<?php echo SITEURL;  ?>images/food/<?php echo $image_name; ?>" width="100px">
                  <?php
               }
               ?>
               </td><td><?php echo $featured; ?></td><td><?php echo $active; ?></td><td> 
                  <a href="<?php echo SITEURL; ?>admin/update-food.php?id=<?php echo $id?>" class="btn-secondry"> update food</a>
                  <a href="<?php echo SITEURL; ?>admin/delete-food.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-danger"> delete food </a>
                     </td></tr>
               <?php
            }

         }else{
            //food not added to database
            echo "<tr><td colspan='7' class='error'>food not added successfuly</td></tr>";
         }
     
     
     ?>
    
       
      
  </table>
  
</div></div>
<?php include('partial/footer.php')?>