<?php
require('PHPExcel/IOFactory.php');
require('PHPExcel/PHPExcel.php');
require_once('connect.php');


date_default_timezone_set('Asia/Kolkata');
error_reporting(0);
//set_include_path(get_include_path() . PATH_SEPARATOR . 'Classes\\');

$link = "<script>window.open('mapping.php','_self')</script>";
if(isset($_POST) && !empty($_FILES['excelupload']['name']))
{
//print_r($_FILES['excelupload']);
$namearr = explode(".",$_FILES['excelupload']['name']);
if(end($namearr) != 'xls' && end($namearr) != 'xlsx' )
{
echo '<p> Invalid File </p>';
$invalid = 1;
}


if($invalid != 1)
{
$target_dir = "uploads/";
$filename = $_FILES["excelupload"]["name"];
$target_file = $target_dir . basename($_FILES["excelupload"]["name"]);
$inputFileName = $target_file;
move_uploaded_file($_FILES['excelupload']['tmp_name'], $target_file); // Upload the file to the current folder

try {
        $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
		$objReader = PHPExcel_IOFactory::createReader($inputFileType);
		$objPHPExcel = $objReader->load($inputFileName);
} 

catch (Exception $e) {
        die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME) 
        . '": ' . $e->getMessage());

    }


	$sheet = $objPHPExcel->getSheetNames();
	$fsheet = $sheet[0];
	$query = "SELECT * from log where \"File_Name\" = '$filename' AND \"Sheet_Name\" = '$fsheet';";
	$result = pg_query($query); 

	if(pg_num_rows($result)!=0)
	{	
			$_SESSION['sheet'] = $fsheet;
			$_SESSION['file_dir'] = $target_file; 
			header('location:delete.html');
	}
	
	$_SESSION['file_dir'] = $target_file;  
    $_SESSION['filename'] = $filename;

    $t = explode(" ",microtime());
	$date = date("m-d-y H:i:s",$t[1]).substr((string)$t[0],1,4);
	
	$query1 = "INSERT INTO log(\"File_Name\",\"Sheet_Name\",\"Date\") values ('$filename','$fsheet','$date');"; 
	$result1 = pg_query($query1); 

	$query2 = "SELECT \"lid\" FROM log WHERE \"Date\"='$date';";
	$result2 = pg_query($query2);
	$lid = pg_fetch_result($result2,0,0);

	$_SESSION['lid'] = $lid;
    echo "<script> alert('Successfully Submitted')</script>";
    echo $link;

}
}
?>

