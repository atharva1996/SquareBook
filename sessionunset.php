<?php 
session_start();
// set the expiration date to one hour ago

setcookie( "name", "",time()-3600);
setcookie( "pwd", "", time()- 3660);
unset($_COOKIE['name']);
unset($_COOKIE['pwd']);
unset($_SESSION['name']);
session_unset();
session_destroy();
header('location:index.php');

?>