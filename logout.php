<?php
   session_start();
   unset($_SESSION["username"]);
   unset($_SESSION["password"]);
   session_destroy();
   
   echo 'Logging out.....';
   header('Refresh: 2; URL = login.php');
?>