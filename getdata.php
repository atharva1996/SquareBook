<?php
require('PHPExcel/IOFactory.php');
require('PHPExcel/PHPExcel.php');
require('connect.php');
session_start();
include 'oops.php';
include 'connect.php';

date_default_timezone_set('Asia/Kolkata');
$headers = $_SESSION['column_array'];
$input_mapping = $_SESSION['input_array'];
$target_file = $_SESSION['file_dir'];
$inputFileName = $target_file;

//  Read your Excel workbook
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
    $highestColumn = PHPExcel_Cell::stringFromColumnIndex(count($headers)-1);

    $people = array();
	for ($i=0;$i<$highestRow-1;$i++)
		$people[$i] = new person;
	
	$final_people = array();
	for($i=0;$i<$highestRow-1;$i++)
		$final_people[$i] = new person;

	$j=0;
	$i=0;

	//  Loop through each row of the worksheet in turn and making objects of each row 
    for ($row = 2; $row <= $highestRow; $row++) {
        //  Read a row of data into an array
        $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row, 
        NULL, TRUE, FALSE);
		foreach($rowData[0] as $k=>$v)
		{
			if($i==count($headers))
				$i=0;
			if($input_mapping[$i]== 1)
				$people[$j]->set_source($v);

			else if ($input_mapping[$i]==2)
				$people[$j]->set_src_desc($v);

			else if ($input_mapping[$i]==3)
				$people[$j]->set_category($v);

			else if ($input_mapping[$i]==4)
				$people[$j]->set_company($v);

			else if ($input_mapping[$i]==5)
				$people[$j]->set_sal($v);

			else if ($input_mapping[$i]==6)
				$people[$j]->set_fname($v);

			else if ($input_mapping[$i]==7)
				$people[$j]->set_lname($v);

			else if ($input_mapping[$i]==8)
				$people[$j]->set_designation($v);

			else if ($input_mapping[$i]==9)
				$people[$j]->set_cmp_addr($v);

			else if ($input_mapping[$i]==10)
				$people[$j]->set_sub_area($v);

			else if ($input_mapping[$i]==11)
				$people[$j]->set_city($v);

			else if ($input_mapping[$i]==12)
				$people[$j]->set_pc($v);

			else if ($input_mapping[$i]==13)
				$people[$j]->set_phone($v);

			else if ($input_mapping[$i]==14)
				$people[$j]->set_fax($v);

			else if ($input_mapping[$i]==15)
				$people[$j]->set_email($v);

			else if ($input_mapping[$i]==16)
				$people[$j]->set_mobile($v);

			else if ($input_mapping[$i]==17)
				$people[$j]->set_art_event($v);

			else if ($input_mapping[$i]==18)
				$people[$j]->set_book_event($v);

			else if ($input_mapping[$i]==19)
				$people[$j]->set_food_promo($v);

			else if ($input_mapping[$i]==20)
				$people[$j]->set_alcohol($v);

			else if ($input_mapping[$i]==21)
				$people[$j]->set_fund_raiser($v);

			else if ($input_mapping[$i]==22)
				$people[$j]->set_fashion_event($v);

			else if ($input_mapping[$i]==23)
				$people[$j]->set_sports_event($v);

			else if ($input_mapping[$i]==24)
				$people[$j]->set_vip_event($v);

			

			$i = $i + 1;
		}

		$j = $j + 1;

	}


	$query = "SELECT * from person_details;";
	$result = pg_query($query); 
	$no_of_rows = pg_num_rows($result);
	$mobile_array = array();
	$mobile_rev = array();
	$email_array = array();
	$fname_array = array();
	$lname_array = array();
	for($j=0;$j<$no_of_rows;$j++)
	{
		$fname_array[$j]= pg_fetch_result($result, $j, 2);	
		$fname_array[$j] = trim($fname_array[$j]);
		$fname_array[$j] = strtolower($fname_array[$j]);

		$lname_array[$j]= pg_fetch_result($result, $j, 3);	
		$lname_array[$j] = trim($lname_array[$j]);
		$lname_array[$j] = strtolower($lname_array[$j]);

		$email_array[$j]= pg_fetch_result($result, $j, 5);	
		$email_array[$j] = trim($email_array[$j]);
		$email_array[$j] = strtolower($email_array[$j]);

		$mobile_array[$j]= pg_fetch_result($result, $j, 6);	
		$mobile_array[$j] = trim($mobile_array[$j]);
		$mobile_array[$j] = strtolower($mobile_array[$j]);
		$mobile_rev[$j] = strrev($mobile_array[$j]);

	}

	
	for ($i=0;$i<$highestRow-1;$i++)
	{
		$get_mobile =trim(strtolower($people[$i]->get_mobile()));
		$mobilerev = strrev($get_mobile);
		$get_email = trim(strtolower($people[$i]->get_email()));
		$get_fname = trim(strtolower($people[$i]->get_fname()));
		$get_lname = trim(strtolower($people[$i]->get_lname()));
		
		for($j=0;$j<$no_of_rows;$j++)
		{
		if($get_mobile!="" || $get_email!=""){
		if(strncasecmp($mobile_rev[$j],$mobilerev,10)==0 || $email_array[$j] == $get_email)
		{
			if($fname_array[$j] == $get_fname && $lname_array[$j] == $get_lname)
			{
				$people[$i]->set_flag(1);
				if($mobile_array[$j] == $get_mobile)
				{
				$select_query1 = "SELECT \"pid\" FROM person_details WHERE \"mobile\"='$get_mobile';";
				$select_result1 = pg_query($select_query1);
				$pid = pg_fetch_result($select_result1, 0, 0);
				$people[$i]->set_pid($pid);
				$select_query3 = "SELECT \"sid\" FROM person_source WHERE \"pid\"='$pid';";
				$select_result3 = pg_query($select_query3);
				$sid = pg_fetch_result($select_result3, 0, 0);
				$people[$i]->set_sid($sid);
				$select_query4 = "SELECT \"cmpid\" FROM company_details WHERE \"pid\"='$pid' AND \"sid\"='$sid';";
				$select_result4 = pg_query($select_query4);
				$cmpid = pg_fetch_result($select_result4, 0, 0);
				$people[$i]->set_cmpid($cmpid);
				$select_query2 = "SELECT \"aid\" FROM address_details WHERE \"pid\"='$pid' AND \"cmpid\"='$cmpid';";
				$select_result2 = pg_query($select_query2);
				$aid = pg_fetch_result($select_result2, 0, 0);
				$people[$i]->set_aid($aid);
				$select_query5 = "SELECT \"catid\" FROM person_category WHERE \"pid\"='$pid';";
				$select_result5 = pg_query($select_query5);
				$catid = pg_fetch_result($select_result5, 0, 0);
				$people[$i]->set_catid($catid);
				/*$select_query6 = "SELECT \"bookid\",\"artid\",\"foodid\",\"alcid\",\"fundid\",\"fashionid\",\"sportsid\",\"vipid\" FROM person_event WHERE \"pid\"='$pid';";
				$select_result6 = pg_query($select_query6);
				$bookid = pg_fetch_result($select_result6, 0, 0);
				$people[$i]->set_bookid($bookid);
				$artid = pg_fetch_result($select_result6, 0, 1);
				$people[$i]->set_artid($artid);
				$foodid = pg_fetch_result($select_result6, 0, 2);
				$people[$i]->set_foodid($foodid);
				$alcid = pg_fetch_result($select_result6, 0, 3);
				$people[$i]->set_alcid($alcid);
				$fundid = pg_fetch_result($select_result6, 0, 4);
				$people[$i]->set_fundid($fundid);
				$fashionid = pg_fetch_result($select_result6, 0, 5);
				$people[$i]->set_fashionid($fashionid);
				$sportsid = pg_fetch_result($select_result6, 0, 6);
				$people[$i]->set_sportsid($sportsid);
				$vipid = pg_fetch_result($select_result6, 0, 7);
				$people[$i]->set_vipid($vipid);*/
				}
				else
				{
				$select_query1 = "SELECT \"pid\" FROM person_details WHERE \"email\"='$get_email';";
				$select_result1 = pg_query($select_query1);
				$pid = pg_fetch_result($select_result1, 0, 0);
				$people[$i]->set_pid($pid);
				$select_query3 = "SELECT \"sid\" FROM person_source WHERE \"pid\"='$pid';";
				$select_result3 = pg_query($select_query3);
				$sid = pg_fetch_result($select_result3, 0, 0);
				$people[$i]->set_sid($sid);
				$select_query4 = "SELECT \"cmpid\" FROM company_details WHERE \"pid\"='$pid' AND \"sid\"='$sid';";
				$select_result4 = pg_query($select_query4);
				$cmpid = pg_fetch_result($select_result4, 0, 0);
				$people[$i]->set_cmpid($cmpid);
				$select_query2 = "SELECT \"aid\" FROM address_details WHERE \"pid\"='$pid' AND \"cmpid\"='$cmpid';";
				$select_result2 = pg_query($select_query2);
				$aid = pg_fetch_result($select_result2, 0, 0);
				$people[$i]->set_aid($aid);
				$select_query5 = "SELECT \"catid\" FROM person_category WHERE \"pid\"='$pid';";
				$select_result5 = pg_query($select_query5);
				$catid = pg_fetch_result($select_result5, 0, 0);
				$people[$i]->set_catid($catid);
				}
			}
		}
	}
			else
				$people[$i]->set_flag("0");
		}
	}


	for ($i=0;$i<$highestRow-1;$i++)
	{
		if($people[$i]->get_source() == "" && $people[$i]->get_category() == "" && $people[$i]->get_company() == "" && $people[$i]->get_sal() == "" && $people[$i]->get_designation() == "" && $people[$i]->get_cmp_addr() == "" && $people[$i]->get_sub_area() == "" && $people[$i]->get_city() == "" && $people[$i]->get_pc() == "" && $people[$i]->get_phone() == "" && $people[$i]->get_fax() == "" && $people[$i]->get_art_event() == "" && $people[$i]->get_book_event() == "" && $people[$i]->get_food_promo() == "" && $people[$i]->get_alcohol() == "" && $people[$i]->get_fund_raiser() == "" && $people[$i]->get_fashion_event() == "" && $people[$i]->get_sports_event() == "" && $people[$i]->get_vip_event() == "" && $people[$i]->get_src_desc() == "")
			continue;

		else if($people[$i]->get_flag()== 0)
			add($people[$i],$final_people[$i]);

		else if($people[$i]->get_flag()!= 0)
			update($people[$i],$result,$final_people[$i]);

	}


	function add($person,$final_person)
	{
		$final_person->set_source($person->get_source());
		$final_person->set_category($person->get_category());
		$final_person->set_company($person->get_company());
		$final_person->set_sal($person->get_sal());
		$final_person->set_fname($person->get_fname());
		$final_person->set_lname($person->get_lname());
		$final_person->set_designation($person->get_designation());
		$final_person->set_sub_area($person->get_sub_area());
		$final_person->set_city($person->get_city());
		$final_person->set_pc($person->get_pc());
		$final_person->set_email($person->get_email());
		$final_person->set_phone($person->get_phone());
		$final_person->set_fax($person->get_fax());
		$final_person->set_mobile($person->get_mobile());
		$final_person->set_art_event($person->get_art_event());
		$final_person->set_book_event($person->get_book_event());
		$final_person->set_food_promo($person->get_food_promo());
		$final_person->set_alcohol($person->get_alcohol());
		$final_person->set_fund_raiser($person->get_fund_raiser());
		$final_person->set_fashion_event($person->get_fashion_event());
		$final_person->set_sports_event($person->get_sports_event());
		$final_person->set_vip_event($person->get_vip_event());
		$final_person->set_cmp_addr($person->get_cmp_addr());
		$final_person->set_src_desc($person->get_src_desc());


		$source = pg_escape_string($final_person->get_source());
		$category = pg_escape_string($final_person->get_category());
		$company = pg_escape_string($final_person->get_company());
		$sal = pg_escape_string($final_person->get_sal());
		$fname = pg_escape_string($final_person->get_fname());
		$lname = pg_escape_string($final_person->get_lname());
		$designation = pg_escape_string($final_person->get_designation());
		$sub_area = pg_escape_string($final_person->get_sub_area());
		$city = pg_escape_string($final_person->get_city());
		$pc = pg_escape_string($final_person->get_pc());
		$email = pg_escape_string($final_person->get_email());
		$phone = pg_escape_string($final_person->get_phone());
		$fax = pg_escape_string($final_person->get_fax());
		$mobile = pg_escape_string($final_person->get_mobile());
		$art_event = pg_escape_string($final_person->get_art_event());
		$book_event = strtolower(pg_escape_string($final_person->get_book_event()));
		$food_promo = strtolower(pg_escape_string($final_person->get_food_promo()));
		$alcohol = strtolower(pg_escape_string($final_person->get_alcohol()));
		$fund_raiser = strtolower(pg_escape_string($final_person->get_fund_raiser()));
		$fashion_event = strtolower(pg_escape_string($final_person->get_fashion_event()));
		$sports_event = strtolower(pg_escape_string($final_person->get_sports_event()));
		$vip_event = strtolower(pg_escape_string($final_person->get_vip_event()));
		$c_addr = pg_escape_string($final_person->get_cmp_addr());
		$src_desc = pg_escape_string($final_person->get_src_desc());
	
		$t = explode(" ",microtime());
		$date = date("m-d-y H:i:s",$t[1]).substr((string)$t[0],1,4);
		$add_query1 = "INSERT INTO person_details(\"fname\",\"lname\",\"phone\",\"email\",\"mobile\",\"inserted_at\",\"updated_at\",\"sal\") VALUES('$fname','$lname','$phone','$email','$mobile','$date','$date','$sal');";
		$add_result1 = pg_query($add_query1); 
		if(!$add_result1)
			return;
		$select_query1 = "SELECT \"pid\" FROM person_details WHERE \"updated_at\"='$date';";
		$select_result1 = pg_query($select_query1);
		$pid = pg_fetch_result($select_result1, 0, 0);

		$add_query3 = "INSERT INTO source_details(\"src_name\",\"src_desc\",\"inserted_at\",\"updated_at\") VALUES('$source','$src_desc','$date','$date');";
		$add_result3 = pg_query($add_query3);
		if(!$add_result3)
		{
			pg_query("DELETE FROM person_details WHERE \"pid\"='$pid';");
			return;
		}
		$select_query3 = "SELECT \"sid\" FROM source_details WHERE \"updated_at\"='$date';";
		$select_result3 = pg_query($select_query3);
		$sid = pg_fetch_result($select_result3, 0, 0);	

		$add_query4 = "INSERT INTO company_details(\"pid\",\"sid\",\"cmp_name\",\"designation\",\"fax\",\"inserted_at\",\"updated_at\") VALUES('$pid','$sid','$company','$designation','$fax','$date','$date');";
		$add_result4 = pg_query($add_query4);
		if(!$add_result4)
		{
			pg_query("DELETE FROM source_details WHERE \"sid\"='$sid';");
			pg_query("DELETE FROM person_details WHERE \"pid\"='$pid';");
			return;
		}
		$select_query4 = "SELECT \"cmpid\" FROM company_details WHERE \"updated_at\"='$date';";
		$select_result4 = pg_query($select_query4);
		$cmpid = pg_fetch_result($select_result4, 0, 0);


		$add_query2 = "INSERT INTO address_details(\"pid\",\"cmpid\",\"c_addr\",\"sub_area\",\"city\",\"pincode\",\"inserted_at\",\"updated_at\") VALUES('$pid','$cmpid','$c_addr','$sub_area','$city','$pc','$date','$date');";
		$add_result2 = pg_query($add_query2);
		if(!$add_result2)
		{	
			pg_query("DELETE FROM company_details WHERE \"cmpid\"='$cmpid';");
			pg_query("DELETE FROM source_details WHERE \"sid\"='$sid';");
			pg_query("DELETE FROM person_details WHERE \"pid\"='$pid';");
			return;
		}
		$select_query2 = "SELECT \"aid\" FROM address_details WHERE \"updated_at\"='$date';";
		$select_result2 = pg_query($select_query2);
		$aid = pg_fetch_result($select_result2, 0, 0);
		
	
		$add_query5 = "INSERT INTO category_details(\"cat_name\",\"inserted_at\",\"updated_at\") VALUES('$category','$date','$date');";
		$add_result5 = pg_query($add_query5);
		if(!$add_result5)
		{
			pg_query("DELETE FROM address_details WHERE \"aid\"='$aid';");
			pg_query("DELETE FROM company_details WHERE \"cmpid\"='$cmpid';");
			pg_query("DELETE FROM source_details WHERE \"sid\"='$sid';");
			pg_query("DELETE FROM person_details WHERE \"pid\"='$pid';");
			return;
		}
		$select_query5 = "SELECT \"catid\" FROM category_details WHERE \"updated_at\"='$date';";
		$select_result5 = pg_query($select_query5);
		$catid = pg_fetch_result($select_result5, 0, 0);
	
		if($book_event!='' && $book_event!='no')
		{
			$select_query6 = "SELECT \"bookid\" FROM book_event_details WHERE \"book_event\"='yes';";
			$select_result6 = pg_query($select_query6);
			$bookid = pg_fetch_result($select_result6, 0, 0);
		}
		else
		{
			$select_query6 = "SELECT \"bookid\" FROM book_event_details WHERE \"book_event\"='no';";
			$select_result6 = pg_query($select_query6);
			$bookid = pg_fetch_result($select_result6, 0, 0);	
		}

		if($art_event!='' && $art_event!='no')
		{
			$select_query6 = "SELECT \"artid\" FROM art_event_details WHERE \"art_event\"='yes';";
			$select_result6 = pg_query($select_query6);
			$artid = pg_fetch_result($select_result6, 0, 0);
		}
		else
		{
			$select_query6 = "SELECT \"artid\" FROM art_event_details WHERE \"art_event\"='no';";
			$select_result6 = pg_query($select_query6);
			$artid = pg_fetch_result($select_result6, 0, 0);	
		}

		if($food_promo!='' && $food_promo!='no')
		{
			$select_query6 = "SELECT \"foodid\" FROM food_promo_details WHERE \"food_promo\"='yes';";
			$select_result6 = pg_query($select_query6);
			$foodid = pg_fetch_result($select_result6, 0, 0);
		}
		else
		{
			$select_query6 = "SELECT \"foodid\" FROM food_promo_details WHERE \"food_promo\"='no';";
			$select_result6 = pg_query($select_query6);
			$foodid = pg_fetch_result($select_result6, 0, 0);	
		}

		if($alcohol!='' && $alcohol!='no')
		{
			$select_query6 = "SELECT \"alcid\" FROM alcohol_pairing_details WHERE \"alcohol_pairing\"='yes';";
			$select_result6 = pg_query($select_query6);
			$alcid = pg_fetch_result($select_result6, 0, 0);
		}
		else
		{
			$select_query6 = "SELECT \"alcid\" FROM alcohol_pairing_details WHERE \"alcohol_pairing\"='no';";
			$select_result6 = pg_query($select_query6);
			$alcid = pg_fetch_result($select_result6, 0, 0);	
		}

		if($fund_raiser!='' && $fund_raiser!='no')
		{
			$select_query6 = "SELECT \"fundid\" FROM fund_raiser_details WHERE \"fund_raiser\"='yes';";
			$select_result6 = pg_query($select_query6);
			$fundid = pg_fetch_result($select_result6, 0, 0);
		}
		else
		{
			$select_query6 = "SELECT \"fundid\" FROM fund_raiser_details WHERE \"fund_raiser\"='no';";
			$select_result6 = pg_query($select_query6);
			$fundid = pg_fetch_result($select_result6, 0, 0);	
		}

		if($fashion_event!='' && $fashion_event!='no')
		{
			$select_query6 = "SELECT \"fashionid\" FROM fashion_event_details WHERE \"fashion_event\"='yes';";
			$select_result6 = pg_query($select_query6);
			$fashionid = pg_fetch_result($select_result6, 0, 0);
		}
		else
		{
			$select_query6 = "SELECT \"fashionid\" FROM fashion_event_details WHERE \"fashion_event\"='no';";
			$select_result6 = pg_query($select_query6);
			$fashionid = pg_fetch_result($select_result6, 0, 0);	
		}

		if($sports_event!='' && $sports_event!='no')
		{
			$select_query6 = "SELECT \"sportsid\" FROM sports_event_details WHERE \"sports_event\"='yes';";
			$select_result6 = pg_query($select_query6);
			$sportsid = pg_fetch_result($select_result6, 0, 0);
		}
		else
		{
			$select_query6 = "SELECT \"sportsid\" FROM sports_event_details WHERE \"sports_event\"='no';";
			$select_result6 = pg_query($select_query6);
			$sportsid = pg_fetch_result($select_result6, 0, 0);	
		}

		if($vip_event!='' && $vip_event!='no')
		{
			$select_query6 = "SELECT \"vipid\" FROM vip_event_details WHERE \"vip_event\"='yes';";
			$select_result6 = pg_query($select_query6);
			$vipid = pg_fetch_result($select_result6, 0, 0);
		}
		else
		{
			$select_query6 = "SELECT \"vipid\" FROM vip_event_details WHERE \"vip_event\"='no';";
			$select_result6 = pg_query($select_query6);
			$vipid = pg_fetch_result($select_result6, 0, 0);	
		}

		$add_query9 = "INSERT INTO person_event(\"pid\",\"bookid\",\"artid\",\"foodid\",\"alcid\",\"fundid\",\"fashionid\",\"sportsid\",\"vipid\") VALUES('$pid','$bookid','$artid','$foodid','$alcid','$fundid','$fashionid','$sportsid','$vipid');";
		$add_result9 = pg_query($add_query9);

		$add_query7 = "INSERT INTO person_source(\"pid\",\"sid\",\"inserted_at\",\"updated_at\") VALUES('$pid','$sid','$date','$date');";
		$add_result7 = pg_query($add_query7);

		$add_query8 = "INSERT INTO person_category(\"pid\",\"catid\",\"inserted_at\",\"updated_at\") VALUES('$pid','$catid','$date','$date');";
		$add_result8 = pg_query($add_query8);

		$person->set_pid($pid);
		$person->set_sid($sid);
		$person->set_aid($aid);
		$person->set_catid($catid);
		$person->set_cmpid($cmpid);
		$person->set_bookid($bookid);
		$person->set_artid($artid);
		$person->set_foodid($foodid);
		$person->set_alcid($alcid);
		$person->set_fundid($fundid);
		$person->set_fashionid($fashionid);
		$person->set_sportsid($sportsid);
		$person->set_vipid($vipid);

		$final_person->set_pid($pid);
		$final_person->set_sid($sid);
		$final_person->set_aid($aid);
		$final_person->set_catid($catid);
		$final_person->set_cmpid($cmpid);
		$final_person->set_bookid($bookid);
		$final_person->set_artid($artid);
		$final_person->set_foodid($foodid);
		$final_person->set_alcid($alcid);
		$final_person->set_fundid($fundid);
		$final_person->set_fashionid($fashionid);
		$final_person->set_sportsid($sportsid);
		$final_person->set_vipid($vipid);

	}


	function update($person,$result,$final_person)
	{	
		$person_source = trim(strtolower($person->get_source()));
		$person_category = trim(strtolower($person->get_category()));
		$person_company = trim(strtolower($person->get_company()));
		$person_sal = trim(strtolower($person->get_sal()));
		$person_fname = trim(strtolower($person->get_fname()));
		$person_lname = trim(strtolower($person->get_lname()));
		$person_designation = trim(strtolower($person->get_designation()));
		$person_sub_area = trim(strtolower($person->get_sub_area()));
		$person_city = trim(strtolower($person->get_city()));
		$person_pc = trim(strtolower($person->get_pc()));
		$person_email = trim(strtolower($person->get_email()));
		$person_phone = trim(strtolower($person->get_phone()));
		$person_fax = trim(strtolower($person->get_fax()));
		$person_mobile = trim(strtolower($person->get_mobile()));
		$person_art_event = trim(strtolower($person->get_art_event()));
		$person_book_event = trim(strtolower($person->get_book_event()));
		$person_food_promo = trim(strtolower($person->get_food_promo()));
		$person_alcohol = trim(strtolower($person->get_alcohol()));
		$person_fund_raiser = trim(strtolower($person->get_fund_raiser()));
		$person_fashion_event = trim(strtolower($person->get_fashion_event()));
		$person_sports_event = trim(strtolower($person->get_sports_event()));
		$person_vip_event = trim(strtolower($person->get_vip_event()));
		$person_src_desc = trim(strtolower($person->get_src_desc()));
		$person_cmp_addr = trim(strtolower($person->get_cmp_addr()));
		$pid = $person->get_pid();
		$sid =  $person->get_sid();
		$aid = $person->get_aid();
		$cmpid = $person->get_cmpid();
		$catid = $person->get_catid();
		/*$bookid = $person->get_bookid();
		$artid = $person->get_artid();
		$foodid = $person->get_foodid();
		$alcid = $person->get_alcid();
		$fundid = $person->get_fundid();
		$fashionid = $person->get_fashionid();
		$sportsid = $person->get_sportsid();
		$vipid = $person->get_vipid();*/

		$final_person->set_source($person->get_source());
		$final_person->set_category($person->get_category());
		$final_person->set_company($person->get_company());
		$final_person->set_sal($person->get_sal());
		$final_person->set_fname($person->get_fname());
		$final_person->set_lname($person->get_lname());
		$final_person->set_designation($person->get_designation());
		$final_person->set_sub_area($person->get_sub_area());
		$final_person->set_city($person->get_city());
		$final_person->set_pc($person->get_pc());
		$final_person->set_email($person->get_email());
		$final_person->set_phone($person->get_phone());
		$final_person->set_fax($person->get_fax());
		$final_person->set_mobile($person->get_mobile());
		$final_person->set_art_event($person->get_art_event());
		$final_person->set_book_event($person->get_book_event());
		$final_person->set_food_promo($person->get_food_promo());
		$final_person->set_alcohol($person->get_alcohol());
		$final_person->set_fund_raiser($person->get_fund_raiser());
		$final_person->set_fashion_event($person->get_fashion_event());
		$final_person->set_sports_event($person->get_sports_event());
		$final_person->set_vip_event($person->get_vip_event());
		$final_person->set_src_desc($person->get_src_desc());
		$final_person->set_cmp_addr($person->get_cmp_addr());
		$final_person->set_pid($pid);
		$final_person->set_sid($sid);
		$final_person->set_aid($aid);
		$final_person->set_cmpid($cmpid);
		$final_person->set_catid($catid);
		/*$final_person->set_bookid($bookid);
		$final_person->set_artid($artid);
		$final_person->set_foodid($foodid);
		$final_person->set_alcid($alcid);
		$final_person->set_fundid($fundid);
		$final_person->set_fashionid($fashionid);
		$final_person->set_sportsid($sportsid);
		$final_person->set_vipid($vipid);*/

		$dbperson = new person;

		$select_query1 = "SELECT \"sal\",\"fname\",\"lname\",\"phone\",\"email\",\"mobile\",\"sal\" FROM person_details WHERE \"pid\"='$pid';";
		$select_result1 = pg_query($select_query1);
		$dbperson->set_sal(pg_fetch_result($select_result1, 0, 0));
		$dbperson_sal = trim(strtolower($dbperson->get_sal()));
		$dbperson->set_fname(pg_fetch_result($select_result1, 0, 1));
		$dbperson_fname = trim(strtolower($dbperson->get_fname()));
		$dbperson->set_lname(pg_fetch_result($select_result1, 0, 2));
		$dbperson_lname = trim(strtolower($dbperson->get_lname()));
		$dbperson->set_phone(pg_fetch_result($select_result1, 0, 3));
		$dbperson_phone = trim($dbperson->get_phone());
		$dbperson->set_email(pg_fetch_result($select_result1, 0, 4));
		$dbperson_email = trim(strtolower($dbperson->get_email()));
		$dbperson->set_mobile(pg_fetch_result($select_result1, 0, 5));
		$dbperson_mobile = trim($dbperson->get_mobile());

		$select_query2 = "SELECT \"c_addr\",\"sub_area\",\"city\",\"pincode\" FROM address_details WHERE \"aid\"='$aid';";
		$select_result2 = pg_query($select_query2);
		$dbperson->set_cmp_addr(pg_fetch_result($select_result2, 0, 0));
		$dbperson_cmp_addr = trim(strtolower($dbperson->get_cmp_addr()));
		$dbperson->set_sub_area(pg_fetch_result($select_result2, 0, 1));
		$dbperson_sub_area = trim(strtolower($dbperson->get_sub_area()));
		$dbperson->set_city(pg_fetch_result($select_result2, 0, 2));
		$dbperson_city = trim(strtolower($dbperson->get_city()));
		$dbperson->set_pc(pg_fetch_result($select_result2, 0, 3));
		$dbperson_pc = trim($dbperson->get_pc());

		$select_query3 = "SELECT \"src_name\",\"src_desc\" FROM source_details WHERE \"sid\"='$sid';";
		$select_result3 = pg_query($select_query3);
		$dbperson->set_source(pg_fetch_result($select_result3, 0, 0));
		$dbperson_source = trim(strtolower($dbperson->get_source()));
		$dbperson->set_src_desc(pg_fetch_result($select_result3, 0, 1));
		$dbperson_src_desc = trim(strtolower($dbperson->get_src_desc()));

		$select_query4 = "SELECT \"cmp_name\",\"designation\",\"fax\" FROM company_details WHERE \"cmpid\"='$cmpid';";
		$select_result4 = pg_query($select_query4);
		$dbperson->set_company(pg_fetch_result($select_result4, 0, 0));
		$dbperson_company = trim(strtolower($dbperson->get_company()));
		$dbperson->set_designation(pg_fetch_result($select_result4, 0, 1));
		$dbperson_designation = trim(strtolower($dbperson->get_designation()));
		$dbperson->set_fax(pg_fetch_result($select_result4, 0, 2));
		$dbperson_fax = trim($dbperson->get_fax());

		$select_query5 = "SELECT \"cat_name\" FROM category_details WHERE \"catid\"='$catid';";
		$select_result5 = pg_query($select_query5);
		$dbperson->set_category(pg_fetch_result($select_result5, 0, 0));
		$dbperson_category = trim(strtolower($dbperson->get_category()));
		
		/*$select_query6 = "SELECT \"bookid\",\"artid\",\"foodid\",\"alcid\",\"fundid\",\"fashionid\",\"sportsid\",\"vipid\" FROM person_event WHERE \"pid\"='$pid';";
		$select_result6 = pg_query($select_query6);*/
	
			
		if($person_source == "" && $dbperson_source!="")
			$final_person->set_source($dbperson->get_source());

		if($person_source!=$dbperson_source && $person_source!="" && $dbperson_source!="")
			{
				$final_source = $person_source." , ".$dbperson_source;
				$final_person->set_source($final_source);
			}

		if($person_category == "" && $dbperson_category!="")
			$final_person->set_category($dbperson->get_category());

		if($person_category!=$dbperson_category && $person_category!="" && $dbperson_category!="")
			{
				$final_category = $person_category." , ".$dbperson_category;
				$final_person->set_category($final_category);
			}

		if($person_company == "" && $dbperson_company!="")
			$final_person->set_company($dbperson->get_company());

		if($person_company!=$dbperson_company && $person_company!="" && $dbperson_company!="")
			{
				$final_company = $person_company." , ".$dbperson_company;
				$final_person->set_company($final_company);
			}

		if($person_sal == "" && $dbperson_sal!="")
			$final_person->set_sal($dbperson->get_sal());

		if($person_designation == "" && $dbperson_designation!="")
			$final_person->set_designation($dbperson->get_designation());

		if($person_designation!=$dbperson_designation && $person_designation!="" && $dbperson_designation!="")
			{
				$final_designation = $person_designation." , ".$dbperson_designation;
				$final_person->set_designation($final_designation);
			}

		if($person_sub_area == "" && $dbperson_sub_area!="")
			$final_person->set_sub_area($dbperson->get_sub_area());

		if($person_sub_area!=$dbperson_sub_area && $person_sub_area!="" && $dbperson_sub_area!="")
			{
				$final_sub_area = $person_sub_area." , ".$dbperson_sub_area;
				$final_person->set_company($final_sub_area);
			}

		if($person_city == "" && $dbperson_city!="")
			$final_person->set_city($dbperson->get_city());

		if($person_city!=$dbperson_city && $person_city!="" && $dbperson_city!="")
			{
				$final_city = $person_city." , ".$dbperson_city;
				$final_person->set_city($final_city);
			}

		if($person_pc == "" && $dbperson_pc!="")
			$final_person->set_pc($dbperson->get_pc());

		if($person_pc!=$dbperson_pc && $person_pc!="" && $dbperson_pc!="")
			{
				$final_pc = $person_pc." , ".$dbperson_pc;
				$final_person->set_pc($final_pc);
			}

		if($person_phone == "" && $dbperson_phone!="")
			$final_person->set_phone($dbperson->get_phone());

		if($person_phone!=$dbperson_phone && $person_phone!="" && $dbperson_phone!="")
			{
				$final_phone = $person_phone." , ".$dbperson_phone;
				$final_person->set_phone($final_phone);
			}	

		if($person_fax == "" && $dbperson_fax!="")
			$final_person->set_fax($dbperson->get_fax());

		if($person_fax!=$dbperson_fax && $person_fax!="" && $dbperson_fax!="")
			{
				$final_fax = $person_fax." , ".$dbperson_fax;
				$final_person->set_fax($final_fax);
			}

		if($person_email == "" && $dbperson_email!="")
			$final_person->set_email($dbperson->get_email());

		if($person_mobile == "" && $dbperson_mobile!="")
			$final_person->set_mobile($dbperson->get_mobile());

		if($person_src_desc == "" && $dbperson_src_desc!="")
			$final_person->set_src_desc($dbperson->get_src_desc());
		
		if($person_src_desc!=$dbperson_src_desc && $person_src_desc!="" && $dbperson_src_desc!="")
			{
				$final_src_desc = $person_src_desc." , ".$dbperson_src_desc;
				$final_person->set_src_desc($final_src_desc);
			}
		if($person_cmp_addr == "" && $dbperson_cmp_addr!="")
			$final_person->set_cmp_addr($dbperson->get_cmp_addr());

		if($person_cmp_addr!=$dbperson_cmp_addr && $person_cmp_addr!="" && $dbperson_cmp_addr!="")
			{
				$final_cmp_addr = $person_cmp_addr." , ".$dbperson_cmp_addr;
				$final_person->set_cmp_addr($final_cmp_addr);
			}


		$source = trim(pg_escape_string($final_person->get_source()));
		$category = trim(pg_escape_string($final_person->get_category()));
		$company = trim(pg_escape_string($final_person->get_company()));
		$sal = trim(pg_escape_string($final_person->get_sal()));
		$fname = trim(pg_escape_string($final_person->get_fname()));
		$lname = trim(pg_escape_string($final_person->get_lname()));
		$designation = trim(pg_escape_string($final_person->get_designation()));
		$sub_area = trim(pg_escape_string($final_person->get_sub_area()));
		$city = trim(pg_escape_string($final_person->get_city()));
		$pc = trim(pg_escape_string($final_person->get_pc()));
		$email = trim(pg_escape_string($final_person->get_email()));
		$phone = trim(pg_escape_string($final_person->get_phone()));
		$fax = trim(pg_escape_string($final_person->get_fax()));
		$mobile = trim(pg_escape_string($final_person->get_mobile()));
		$cmp_addr = trim(pg_escape_string($final_person->get_cmp_addr()));
		$src_desc = trim(pg_escape_string($final_person->get_src_desc()));

		if($person_book_event!='' && $person_book_event!='no')
		{
			$select_query6 = "SELECT \"bookid\" FROM book_event_details WHERE \"book_event\"='yes';";
			$select_result6 = pg_query($select_query6);
			$bookid = pg_fetch_result($select_result6, 0, 0);
		}
		else
		{
			$select_query6 = "SELECT \"bookid\" FROM book_event_details WHERE \"book_event\"='no';";
			$select_result6 = pg_query($select_query6);
			$bookid = pg_fetch_result($select_result6, 0, 0);	
		}

		if($person_art_event!='' && $person_art_event!='no')
		{
			$select_query6 = "SELECT \"artid\" FROM art_event_details WHERE \"art_event\"='yes';";
			$select_result6 = pg_query($select_query6);
			$artid = pg_fetch_result($select_result6, 0, 0);
		}
		else
		{
			$select_query6 = "SELECT \"artid\" FROM art_event_details WHERE \"art_event\"='no';";
			$select_result6 = pg_query($select_query6);
			$artid = pg_fetch_result($select_result6, 0, 0);	
		}

		if($person_food_promo!='' && $person_food_promo!='no')
		{
			$select_query6 = "SELECT \"foodid\" FROM food_promo_details WHERE \"food_promo\"='yes';";
			$select_result6 = pg_query($select_query6);
			$foodid = pg_fetch_result($select_result6, 0, 0);
		}
		else
		{
			$select_query6 = "SELECT \"foodid\" FROM food_promo_details WHERE \"food_promo\"='no';";
			$select_result6 = pg_query($select_query6);
			$foodid = pg_fetch_result($select_result6, 0, 0);	
		}

		if($person_alcohol!='' && $person_alcohol!='no')
		{
			$select_query6 = "SELECT \"alcid\" FROM alcohol_pairing_details WHERE \"alcohol_pairing\"='yes';";
			$select_result6 = pg_query($select_query6);
			$alcid = pg_fetch_result($select_result6, 0, 0);
		}
		else
		{
			$select_query6 = "SELECT \"alcid\" FROM alcohol_pairing_details WHERE \"alcohol_pairing\"='no';";
			$select_result6 = pg_query($select_query6);
			$alcid = pg_fetch_result($select_result6, 0, 0);	
		}

		if($person_fund_raiser!='' && $person_fund_raiser!='no')
		{
			$select_query6 = "SELECT \"fundid\" FROM fund_raiser_details WHERE \"fund_raiser\"='yes';";
			$select_result6 = pg_query($select_query6);
			$fundid = pg_fetch_result($select_result6, 0, 0);
		}
		else
		{
			$select_query6 = "SELECT \"fundid\" FROM fund_raiser_details WHERE \"fund_raiser\"='no';";
			$select_result6 = pg_query($select_query6);
			$fundid = pg_fetch_result($select_result6, 0, 0);	
		}

		if($person_fashion_event!='' && $person_fashion_event!='no')
		{
			$select_query6 = "SELECT \"fashionid\" FROM fashion_event_details WHERE \"fashion_event\"='yes';";
			$select_result6 = pg_query($select_query6);
			$fashionid = pg_fetch_result($select_result6, 0, 0);
		}
		else
		{
			$select_query6 = "SELECT \"fashionid\" FROM fashion_event_details WHERE \"fashion_event\"='no';";
			$select_result6 = pg_query($select_query6);
			$fashionid = pg_fetch_result($select_result6, 0, 0);	
		}

		if($person_sports_event!='' && $person_sports_event!='no')
		{
			$select_query6 = "SELECT \"sportsid\" FROM sports_event_details WHERE \"sports_event\"='yes';";
			$select_result6 = pg_query($select_query6);
			$sportsid = pg_fetch_result($select_result6, 0, 0);
		}
		else
		{
			$select_query6 = "SELECT \"sportsid\" FROM sports_event_details WHERE \"sports_event\"='no';";
			$select_result6 = pg_query($select_query6);
			$sportsid = pg_fetch_result($select_result6, 0, 0);	
		}

		if($person_vip_event!='' && $person_vip_event!='no')
		{
			$select_query6 = "SELECT \"vipid\" FROM vip_event_details WHERE \"vip_event\"='yes';";
			$select_result6 = pg_query($select_query6);
			$vipid = pg_fetch_result($select_result6, 0, 0);
		}
		else
		{
			$select_query6 = "SELECT \"vipid\" FROM vip_event_details WHERE \"vip_event\"='no';";
			$select_result6 = pg_query($select_query6);
			$vipid = pg_fetch_result($select_result6, 0, 0);	
		}
		/*$art_event = pg_escape_string($final_person->get_art_event());
		$book_event = pg_escape_string($final_person->get_book_event());
		$food_promo = pg_escape_string($final_person->get_food_promo());
		$alcohol = pg_escape_string($final_person->get_alcohol());
		$fund_raiser = pg_escape_string($final_person->get_fund_raiser());
		$fashion_event = pg_escape_string($final_person->get_fashion_event());
		$sports_event = pg_escape_string($final_person->get_sports_event());
		$vip_event = pg_escape_string($final_person->get_vip_event());*/
		$t = explode(" ",microtime());
		$date = date("m-d-y H:i:s",$t[1]).substr((string)$t[0],1,4);
		$merge_query1 = "UPDATE person_details SET(\"sal\",\"phone\",\"email\",\"mobile\",\"updated_at\") = ('$sal','$phone','$email','$mobile','$date') WHERE \"pid\" = '$pid';";
		$merge_query2 = "UPDATE source_details SET(\"src_name\",\"src_desc\",\"updated_at\") = ('$source','$src_desc','$date') WHERE \"sid\" = '$sid';";
		$merge_query3 = "UPDATE company_details SET(\"cmp_name\",\"designation\",\"fax\",\"updated_at\") = ('$company','$designation','$fax','$date') WHERE \"cmpid\" = '$cmpid';";
		$merge_query4 = "UPDATE address_details SET(\"c_addr\",\"sub_area\",\"city\",\"pincode\",\"updated_at\") = ('$cmp_addr','$sub_area','$city','$pc','$date') WHERE \"aid\" = '$aid';";
		$merge_query5 = "UPDATE category_details SET(\"cat_name\",\"updated_at\") = ('$category','$date') WHERE \"catid\" = '$catid';";
		$merge_query6 = "UPDATE person_event SET(\"bookid\",\"artid\",\"foodid\",\"alcid\",\"fundid\",\"fashionid\",\"sportsid\",\"vipid\") = ('$bookid','$artid','$foodid','$alcid','$fundid','$fashionid','$sportsid','$vipid') WHERE \"pid\" = '$pid';";

		$merge_result1 = pg_query($merge_query1);
		$merge_result2 = pg_query($merge_query2);
		$merge_result3 = pg_query($merge_query3);
		$merge_result4 = pg_query($merge_query4);
		$merge_result5 = pg_query($merge_query5);
		$merge_result6 = pg_query($merge_query6);



		/*if($person->get_email() == "")
		{
			
		$merge_query = "UPDATE temp SET(\"Source\",\"Category\",\"Company\",\"Sal\",\"Designation\",\"Address\",\"Sub_Area\",\"City\",\"Pincode\",\"Phone\",\"Fax\",\"Email\",\"Art_Event\",\"Book_Event\",\"Food_Promo\",\"Alcohol_Pairing\",\"Fund_Raiser\",\"Fashion_Event\",\"Sports_Event\",\"Vip_Event\") = ('$source','$category','$company','$sal','$designation','$addr','$sub_area','$city','$pc','$phone','$fax','$email','$art_event','$book_event','$food_promo','$alcohol','$fund_raiser','$fashion_event','$sports_event','$vip_event') WHERE \"Mobile\" = '$mobile';";
			}

		else if($person->get_mobile() == "")

		{
			$merge_query = "UPDATE temp SET(\"Source\",\"Category\",\"Company\",\"Sal\",\"Designation\",\"Address\",\"Sub_Area\",\"City\",\"Pincode\",\"Phone\",\"Fax\",\"Mobile\",\"Art_Event\",\"Book_Event\",\"Food_Promo\",\"Alcohol_Pairing\",\"Fund_Raiser\",\"Fashion_Event\",\"Sports_Event\",\"Vip_Event\") = ('$source','$category','$company','$sal','$designation','$addr','$sub_area','$city','$pc','$phone','$fax','$mobile','$art_event','$book_event','$food_promo','$alcohol','$fund_raiser','$fashion_event','$sports_event','$vip_event') WHERE \"Email\" = '$email';";

			}
		else
		{

			$merge_query = "UPDATE temp SET(\"Source\",\"Category\",\"Company\",\"Sal\",\"Designation\",\"Address\",\"Sub_Area\",\"City\",\"Pincode\",\"Phone\",\"Fax\",\"Art_Event\",\"Book_Event\",\"Food_Promo\",\"Alcohol_Pairing\",\"Fund_Raiser\",\"Fashion_Event\",\"Sports_Event\",\"Vip_Event\") = ('$source','$category','$company','$sal','$designation','$addr','$sub_area','$city','$pc','$phone','$fax','$art_event','$book_event','$food_promo','$alcohol','$fund_raiser','$fashion_event','$sports_event','$vip_event') WHERE \"Email\" = '$email' AND \"Mobile\" = '$mobile';";
}	

*/

 

}

unset($_SESSION['column_array']);
unset($_SESSION['input_array']);
unset($_SESSION['file_dir']);
session_destroy();
//echo "ENDED";
echo "<script>window.open('search_home2.php','_self')</script>";

?>

