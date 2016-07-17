<?php
session_start();
require('PHPExcel/IOFactory.php');
require('PHPExcel/PHPExcel.php');
require_once('connect.php');

echo "please wait, loading...";
date_default_timezone_set('Asia/Kolkata');
$link = "<script>window.open('mapping.php','_self')</script>";
$target_file = $_SESSION['file_dir'];
$sheet = $_SESSION['sheet'];

$t = explode(" ",microtime());
$date = date("m-d-y H:i:s",$t[1]).substr((string)$t[0],1,4);
	
	$query = <<<EOF

	INSERT INTO log("File_Name","Sheet_Name","Date") values ('$target_file','$sheet','$date'); 

EOF;

	$result = pg_query($query); 
	
	$query1 = "SELECT lid FROM log WHERE \"Date\"='$date';";
	$result1 = pg_query($query1);
	$lid = pg_fetch_result($result1,0,0);
	$_SESSION['lid'] = $lid;
	
    echo "<script> alert('Successfully Submitted')</script>";
    echo $link;

?>