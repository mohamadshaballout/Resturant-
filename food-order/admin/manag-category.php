<?php  
include('partial/menu.php')?>
<div class="main-content">
   <div class="wrapper"> <h1>manag-category</h1>
   <br/>
   <br>
   <?php  
    if(isset($_SESSION['add'])){
        echo $_SESSION['add'];
        unset($_SESSION['add']);
    }  
    if(isset($_SESSION['remove'])){
      echo $_SESSION['remove'];
      unset($_SESSION['remove']);
  }  
   if(isset($_SESSION['delete'])){
   echo $_SESSION['delete'];
   unset($_SESSION['delete']);
} 
   if(isset($_SESSION['no-catagory-found'])){
   echo $_SESSION['no-catagory-found'];
   unset($_SESSION['no-catagory-found']);
} 
   if(isset($_SESSION['update'])){
   echo $_SESSION['update'];
   unset($_SESSION['update']);
}
   if(isset($_SESSION['upload'])){
   echo $_SESSION['upload'];
   unset($_SESSION['upload']);
}
if(isset($_SESSION['failed-remove'])){
   echo $_SESSION['failed-remove'];
   unset($_SESSION['failed-remove']);
}
    ?><br><br><br><br>
   <!-- bottom to add admin-->
   <a href="<?php echo SITEURL;?>admin/add-catagory.php" class="btn-primary">add catagory</a>
   <table  class="tbl-full"> 
<br/><br/>
     <tr><th>S.N</th>
     <th>Title</th>
     <th>Image</th>
     <th>featured</th>
      <th>Active</th>
      <th>Action</th>
      </tr>
      <?php 
       //excute to get all categories from database 
      $sql="SELECT * FROM tbl_catagories ";
     //excute query
      $res=mysqli_query($conn,$sql);
      //count rows
      $count = mysqli_num_rows($res);
      //check we have data in data abse or not 
      if($count>0){
         //we have data in databse
         //get the data and display
         while($row=mysqli_fetch_assoc($res)){
            $id=$row['id'];
            $title=$row['title'];

            $image_name=$row['image_name'];

            $featured=$row['featured'];
            $active=$row['active'];
            ?>
               <tr><td>1.</td>
               <td><?php echo $title; ?></td>
                   <td>
                      <?php 
                        //check whether image name is avliable or not
                        if($image_name!=""){
                           //display the image
                           ?>
                        <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" width="100px" >
                           <?php
                        }else{
                           //display the message
                           echo "<div class='error'>image not added.<?div>";
                        }
                      ?>
                     </td>
                   <td><?php echo $featured; ?></td>
                  <td><?php echo $active; ?></td> 
                 <td> <a href="<?php echo SITEURL; ?>admin/update-category.php?id=<?php echo $id; ?>" class="btn-secondry"> update category</a>
                  <a href="<?php echo SITEURL; ?>admin/delete-category.php?id=<?php echo $id;  ?>&image_name=<?php echo $image_name; ?>" class="btn-danger"> delete category </a>
                  </td>
   
                  </tr>
      
            <?php
         }
      }else{
         //we don't have data in our databse
         //we will display the message inside the table
         //to do that we should write html code so that we close the php file and open it like below
         ?>
         <tr>
            <td><div class="error">no category added.</div></td> 
         </tr>
         <?php
      }
      
      
      ?>
      
  </table>
  
</div></div>
<?php include('partial/footer.php')?>