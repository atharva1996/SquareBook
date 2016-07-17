<?php
session_start();

$deletefile = $_SESSION['file_dir'];
unlink($deletefile);
header('location:userhome.php');

?>