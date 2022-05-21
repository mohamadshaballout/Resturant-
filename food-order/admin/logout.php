<?php 
//include contstant.php for siteurl
include('../config/constants.php');
//1.destroid the session 
session_destroy();//unset $_session ['user']
//2. redirect to login page
header('location:'.SITEURL.'admin/login.php')
?>