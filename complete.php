<?php
session_start();
require('PHPExcel/IOFactory.php');
require('PHPExcel/PHPExcel.php');
require_once('connect.php');

echo "please wait, loading...";
$link = "<script>window.open('mapping.php','_self')</script>";
$target_file = $_SESSION['file_dir'];
$sheet = $_SESSION['sheet'];

$date = date("d-m-Y");
	
	$query = <<<EOF

	INSERT INTO log("File_Name","Sheet_Name","Date") values ('$target_file','$sheet','$date'); 

EOF;

	$result = pg_query($query); 
	
    echo "<script> alert('Successfully Submitted')</script>";
    echo $link;

?>