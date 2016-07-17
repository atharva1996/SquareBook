<?php
   #require_once('phppgsql-r1\phppgsql.php');
   $host        = "host=localhost";
   $port        = "port=5432";
   $dbname      = "dbname=squareinch";
   $credentials = "user=postgres password=atharva123";

   $db = pg_connect( "$host $port $dbname $credentials"  );
   /*if(!$db){
      echo "Error : Unable to open database\n";
   } else {
      echo "Opened database successfully\n";
   }*/
?>