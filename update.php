<?php
require_once 'dbconfig.php';

	if($_POST)
	{
		date_default_timezone_set('Asia/Kolkata');
		$t = explode(" ",microtime());
		$date = date("m-d-y H:i:s",$t[1]).substr((string)$t[0],1,4); 

		$pid = $_POST['pid'];
		$sid = $_POST['sid'];
		$aid = $_POST['aid'];
		$catid = $_POST['catid'];
		$cmpid = $_POST['cmpid'];
		
		$sal = $_POST['sal'];
		$fname= $_POST['fname'];
		$lname = $_POST['lname'];
		$phone = $_POST['phone'];
		$email = $_POST['email'];
		$mobile = $_POST['mobile'];
		$cmp_name = $_POST['cmp_name'];
		$designation = $_POST['designation'];
		$c_addr = $_POST['c_addr'];
		$sub_area = $_POST['sub_area'];
		$city = $_POST['city'];
		$pincode = $_POST['pincode'];
		$fax = $_POST['fax'];
		$src_name = $_POST['src_name'];
		$src_des = $_POST['src_des'];
		$cat_name = $_POST['cat_name'];
		$book_event = trim(strtolower($_POST['book_event']));
		$art_event = trim(strtolower($_POST['art_event']));
		$food_promo = trim(strtolower($_POST['food_promo']));
		$alcohol_pairing = trim(strtolower($_POST['alcohol_pairing']));
		$fund_raiser = trim(strtolower($_POST['fund_raiser']));
		$fashion_event = trim(strtolower($_POST['fashion_event']));
		$sports_event = trim(strtolower($_POST['sports_event']));
		$vip_event = trim(strtolower($_POST['vip_event']));

		$stmt1 = $db_con->prepare("UPDATE person_details SET(\"sal\",\"fname\",\"lname\",\"phone\",\"email\",\"mobile\",\"updated_at\") = ('$sal','$fname','$lname','$phone','$email','$mobile','$date') WHERE \"pid\"='$pid'");

		$stmt2 = $db_con->prepare("UPDATE company_details SET (\"cmp_name\",\"designation\",\"fax\",\"updated_at\") = ('$cmp_name','$designation','$fax','$date') WHERE \"cmpid\"='$cmpid'");	
		
		$stmt3 = $db_con->prepare("UPDATE address_details SET (\"c_addr\",\"sub_area\",\"city\",\"pincode\",\"updated_at\") = ('$c_addr','$sub_area','$city','$pincode','$date') WHERE \"aid\"='$aid'");	

		$stmt4 = $db_con->prepare("UPDATE source_details SET (\"src_name\",\"src_desc\",\"updated_at\") = ('$src_name','$src_des','$date') WHERE \"sid\"='$sid'");

		if($book_event!='' && $book_event!='no')
		{
			$bookid = '1' ;
		}
		else
		{
			$bookid = '2';
		}

		if ($art_event!='' && $art_event!='no') 
		{
			$artid = '1';
		}
		else
		{
			$artid = '2';
		}

		if ($food_promo!='' && $food_promo!='no') 
		{
			$foodid = '1';
		}
		else
		{
			$foodid = '2';
		}
		if ($alcohol_pairing!='' && $alcohol_pairing!='no') 
		{
			$alcid = '1';
		}
		else
		{
			$alcid = '2';
		}
		if ($fund_raiser!='' && $fund_raiser!='no') 
		{
			$fundid = '1';
		}
		else
		{
			$fundid = '2';
		}
		if($fashion_event!='' && $fashion_event!='no')
		{
			$fashionid = '1';
		}
		else
		{
			$fashionid = '2';
		}
		if ($sports_event!='' && $sports_event!='no') 
		{
			$sportsid = '1';
		}
		else
		{
			$sportsid = '2';
		}
		if ($vip_event!='' && $vip_event!='no') 
		{
			$vipid = '1';
		}
		else
		{
			$vipid = '2';
		}

		$stmt5 = $db_con->prepare("UPDATE person_event SET (\"bookid\",\"artid\",\"foodid\",\"alcid\",\"fundid\",\"fashionid\", \"sportsid\",\"vipid\") = ('$bookid','$artid','$foodid','$alcid','$fundid','$fashionid','$sportsid','$vipid') WHERE \"pid\"='$pid'");	

		$stmt5 = $db_con->prepare("UPDATE category_details SET (\"cat_name\") = ('$cat_name') WHERE \"catid\"='$catid'");	

	
		
		if($stmt1->execute() && $stmt2->execute() && $stmt3->execute() && $stmt4->execute() && $stmt5->execute())
		{
			echo "<script>alert('Successfully updated');</script>";
		}
		else{
			echo "<script>alert('sdds asda');</script>";
		}
	}

?>