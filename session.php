<?php
   include('data.php');
   session_start();
   
   $user_check = $_SESSION['login_user'];
   
   $ses_sql = mysqli_query($db,"select matric from register where matric = '$user_check' ");
   
   $row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);
   
   $login_session = $row['matric'];
   
   if(!isset($_SESSION['login_user'])){
      header("signin.php");
      die();
   }
?>