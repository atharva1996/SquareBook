<?php
require('PHPExcel/IOFactory.php');
require('PHPExcel/PHPExcel.php');
require('connect.php');
session_start();

echo "please wait, loading...";
$headers = $_SESSION['column_array'];
$headers= array_filter($headers);
$input_mapping= array();

for($i=0; $i<count($headers);$i++)
{
	$index = "myInput_".$i;
	$inputmapping[$i]= $_POST[$index];
}

$_SESSION['input_array'] = $inputmapping;
$link = "<script>window.open('getdata.php','_self')</script>";
echo $link;

?>