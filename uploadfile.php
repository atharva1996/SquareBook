<?php
require('PHPExcel/IOFactory.php');
require('PHPExcel/PHPExcel.php');
require_once('connect.php');

#include 'PHPExcel/IOFactory.php';
/****** Include the EXCEL Reader Factory ***********/
error_reporting(0);
set_include_path(get_include_path() . PATH_SEPARATOR . 'Classes/');




$link = "<script>window.open('mapping.php','_self')</script>";
if(isset($_POST) && !empty($_FILES['excelupload']['name']))
{
//print_r($_FILES['excelupload']);
$namearr = explode(".",$_FILES['excelupload']['name']);
if(end($namearr) != 'xls' && end($namearr) != 'xlsx' )
{
echo '<script>alert("Invalid File");</script>';
$invalid = 1;
}


if($invalid != 1)
{
$target_dir = "uploads/";
$filename = $_FILES["excelupload"]["name"];
$target_file = $target_dir . basename($_FILES["excelupload"]["name"]);
$inputFileName = $target_file;

$response = move_uploaded_file($_FILES['excelupload']['tmp_name'],$target_file); // Upload the file to the current folder


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

	$query = <<<EOF

	SELECT * from log where "File_Name" = '$filename' AND "Sheet_Name" = '$fsheet'; 

EOF;
	
	
	$result = pg_query($query); 

	
	if(pg_num_rows($result)!=0)
	{	

			$_SESSION['sheet'] = $fsheet;
			$_SESSION['file_dir'] = $target_file; 
			header('location:delete.html');
			
		
	}

	$_SESSION['file_dir'] = $target_file;  
    $_SESSION['filename'] = $filename;
          
	$date = date("d-m-Y");
	
	$query = <<<EOF

	INSERT INTO log("File_Name","Sheet_Name","Date") values ('$filename','$fsheet','$date'); 

EOF;

	$result = pg_query($query); 
	
    echo "<script> alert('Successfully Submitted')</script>";
    echo $link;



}
}
?>
