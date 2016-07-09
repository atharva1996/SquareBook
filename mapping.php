<?php
require('PHPExcel/IOFactory.php');
require('PHPExcel/PHPExcel.php');
require('connect.php');
session_start();

$filename = $_SESSION['filename'];
$target_file = $_SESSION['file_dir'];
$inputFileName = $target_file;
try {
        $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
        $objReader = PHPExcel_IOFactory::createReader($inputFileType);
        $objPHPExcel = $objReader->load($inputFileName);
    } 
	catch (Exception $e) {
        die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME) 
        . '": ' . $e->getMessage());
    }
	
    //  Get worksheet dimensions
    $sheet = $objPHPExcel->getSheet(0);
    $highestRow = $sheet->getHighestRow();
    $highestColumn = $sheet->getHighestColumn();
    $headers= array();
    $i= 0;

    //  Loop through each row of the worksheet in turn 
    for ($row = 1; $row <= $highestRow; $row++) {
        //  Read a row of data into an array
        $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row, 
        NULL, TRUE, FALSE);
        foreach($rowData[0] as $k=>$v){
            #echo "Row: ".$row."- Col: ".($k+1)." = ".$v."<br>";
            #$data[$row][$k+1][] = $v;
            $v = trim($v);
            if($row == 1){
                if($v == "")
                    continue;
                $headers[$i]= trim($v);
                $i= $i + 1;
            } else {
                break;
            }
            #if($row >1)
                #pg_query($db,"INSERT INTO temp VALUES ('".$rowData."')");  

        }  
    }

#$headers = array_filter($headers);
$_SESSION['column_array'] = $headers;
$link = "<script>window.open('column_mapping.php','_self')</script>";
echo $link;

?>





