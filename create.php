<?php
require_once 'connect.php';

	
	if($_POST)
	{


		$sal = $_POST['sal'];
		$fname= $_POST['fname'];
		$lname = $_POST['lname'];
		$phone = $_POST['phone'];
		$email = $_POST['email'];
		$mobile = $_POST['mobile'];
		$company = $_POST['cmp_name'];
		$designation = $_POST['designation'];
		$c_addr = $_POST['c_addr'];
		$sub_area = $_POST['sub_area'];
		$city = $_POST['city'];
		$pc = $_POST['pincode'];
		$fax = $_POST['fax'];
		$source = $_POST['source'];
		$src_desc = $_POST['src_desc'];
		$category = $_POST['category'];
		$book_event = trim(strtolower($_POST['book_event']));
		$art_event = trim(strtolower($_POST['art_event']));
		$food_promo = trim(strtolower($_POST['food_promo']));
		$alcohol = trim(strtolower($_POST['alcohol_pairing']));
		$fund_raiser = trim(strtolower($_POST['fund_raiser']));
		$fashion_event = trim(strtolower($_POST['fashion_event']));
		$sports_event = trim(strtolower($_POST['sports_event']));
		$vip_event = trim(strtolower($_POST['vip_event']));
		date_default_timezone_set('Asia/Kolkata');
		$t = explode(" ",microtime());
		$date = date("m-d-y H:i:s",$t[1]).substr((string)$t[0],1,4); 
		do
		{
try{
			
			$add_query1 = "INSERT INTO person_details(\"fname\",\"lname\",\"phone\",\"email\",\"mobile\",\"inserted_at\",\"updated_at\",\"sal\") VALUES('$fname','$lname','$phone','$email','$mobile','$date','$date','$sal');";
		$add_result1 = pg_query($add_query1); 
		if(!$add_result1)
			break;
		$select_query1 = "SELECT \"pid\" FROM person_details WHERE \"updated_at\"='$date';";
		$select_result1 = pg_query($select_query1);
		$pid = pg_fetch_result($select_result1, 0, 0);

		$add_query3 = "INSERT INTO source_details(\"src_name\",\"src_desc\",\"inserted_at\",\"updated_at\") VALUES('$source','$src_desc','$date','$date');";
		$add_result3 = pg_query($add_query3);
		if(!$add_result3)
		{
			pg_query("DELETE FROM person_details WHERE \"pid\"='$pid';");
			
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
			break;
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
			break;
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
			break;
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
			
				
	}
		
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
		echo "<script>alert(\"Successfully added\");</script>";
	}
	while(0);

}
?>