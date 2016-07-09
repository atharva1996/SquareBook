<?php
session_start();

$deletefile = $_SESSION['file_dir'];
unlink($deletefile);
header('location:search_home2.php');

?>