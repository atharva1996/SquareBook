<?php

   $db_host = "localhost";
   $db_name = "squareinch";
   $db_user = "root";
   $db_pass = "";
   
   try{
      
      $db_con = new PDO('pgsql:dbname=squareinch;host=localhost;user=postgres;password=atharva123');
      $db_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   }
   catch(PDOException $e){
      echo $e->getMessage();
   }


?>