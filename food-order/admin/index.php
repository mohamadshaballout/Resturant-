<?php 
 include('partial/menu.php');
?>
   <!--menu content section start*/ -->
   <div class="main-content"><div class="wrapper">   
   <h1>dashboard</h1>
      <br>
      <?php 
            if(isset($_SESSION['login'])){
                echo $_SESSION['login'];
                unset($_SESSION['login']);
            }
            ?><br>
        <div class="cal-4 text-center"><h1>5</h1><br />categories</div>
        <div class="cal-4 text-center"><h1>5</h1><br />categories</div>
        <div class="cal-4 text-center"><h1>5</h1><br />categories</div>
        <div class="cal-4 text-center"><h1>5</h1><br />categories</div>
        <div class="clearfix"></div>
        
</div></div>
   <!--main content section end*/ -->
   
  
<?php 
include('partial/footer.php')?>


