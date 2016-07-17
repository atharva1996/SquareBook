<?php
class person
{
	var $source = "";
	var $category = "";
	var $company = "";
	var $sal = "";
	var $fname = "";
	var $lname = "";
	var $designation = "";
	var $cmp_addr2 = "";
	var $cmp_addr3 = "";
	var $country = "";
	var $dob = "";
	var $anniv = "";
	var $city = "";
	var $pc = "";
	var $email = "";
	var $phone = "";
	var $fax = "";
	var $mobile= "";
	var $art_event = "";
	var $book_event = "";
	var $food_promo ="";
	var $alcohol = "";
	var $fund_raiser = "";
	var $fashion_event = "";
	var $sports_event = "";
	var $vip_event = "";
	var $flag = ""; 
	var $cmp_addr1 = "";
	var $src_desc = "";
	var $sid = "";
	var $pid = "";
	var $aid = "";
	var $cmpid = "";
	var $catid = "";
	var $bookid = "";
	var $artid = "";
	var $foodid = "";
	var $alcid = "";
	var $fundid = "";
	var $fashionid = "";
	var $sportsid = "";
	var $vipid = "";
	
	
	function set_lid($lid)
	{
		$this->lid = $lid;
	}

	function set_source($source)
	{
		$this->source = $source;
	}

	function set_category($category)
	{
		$this->category = $category;
	}

	function set_company($company)
	{
		$this->company = $company;
	}

	function set_sal($sal)
	{
		$this->sal = $sal;
	}

	function set_fname($fname)
	{
		$this->fname = $fname;
	}

	function set_lname($lname)
	{
		$this->lname = $lname;
	}

	function set_designation($designation)
	{
		$this->designation = $designation;
	}


	function set_cmp_addr2($cmp_addr2)
	{
		$this->cmp_addr2 = $cmp_addr2;
	}
	
	function set_city($city)
	{
		$this->city = $city;
	}

	function set_pc($pc)
	{
		$this->pc = $pc;
	}

	function set_email($email)
	{
		$this->email = $email;
	}

	function set_phone($phone)
	{
		$this->phone = $phone;
	}

	function set_fax($fax)
	{
		$this->fax = $fax;
	}

	function set_dob($dob)
	{
		$this->dob = $dob;
	}

	function set_anniv($anniv)
	{
		$this->anniv = $anniv;
	}

	function set_mobile($mobile)
	{

		$this->mobile = $mobile;
	}

	function set_art_event($art_event)
	{

		$this->art_event = $art_event;
	}

	function set_book_event($book_event)
	{
		$this->book_event = $book_event;
	}

	function set_food_promo($food_promo)
	{
		$this->food_promo = $food_promo;
	}

	function set_alcohol($alcohol)
	{
		$this->alcohol = $alcohol;
	}

	function set_fund_raiser($fund_raiser)
	{
		$this->fund_raiser = $fund_raiser;
	}

	function set_fashion_event($fashion_event)
	{
		$this->fashion_event = $fashion_event;
	}

	function set_sports_event($sports_event)
	{
		$this->sports_event = $sports_event;
	}

	function set_vip_event($vip_event)
	{
		$this->vip_event = $vip_event;
	}

	function set_flag($flag)
	{
		$this->flag = $flag;
	}

	function set_cmp_addr1($cmp_addr1)
	{
		$this->cmp_addr1 = $cmp_addr1;
	}

	function set_cmp_addr3($cmp_addr3)
	{
		$this->cmp_addr3 = $cmp_addr3;
	}

	function set_src_desc($src_desc)
	{
		$this->src_desc = $src_desc;
	}

	function set_country($country)
	{
		$this->country = $country;
	}

	function set_sid($sid)
	{
		$this->sid = $sid;
	}

	function set_pid($pid)
	{
		$this->pid = $pid;
	}
	function set_aid($aid)
	{
		$this->aid = $aid;
	}
	function set_cmpid($cmpid)
	{
		$this->cmpid = $cmpid;
	}
	function set_catid($catid)
	{
		$this->catid = $catid;
	}
	function set_bookid($bookid)
	{
		$this->bookid = $bookid;
	}
	function set_artid($artid)
	{
		$this->artid = $artid;
	}
	function set_foodid($foodid)
	{
		$this->foodid = $foodid;
	}
	function set_alcid($alcid)
	{
		$this->alcid = $alcid;
	}
	function set_fundid($fundid)
	{
		$this->fundid = $fundid;
	}
	function set_fashionid($fashionid)
	{
		$this->fashionid = $fashionid;
	}
	function set_sportsid($sportsid)
	{
		$this->sportsid = $sportsid;
	}
	function set_vipid($vipid)
	{
		$this->vipid = $vipid;
	}
	

	function get_lid()
	{
		return $this->lid;
	}

	function get_source()
	{
		return $this->source;
	}

	function get_category()
	{
		return $this->category;
	}

	function get_company()
	{
		return $this->company;
	}

	function get_sal()
	{
		return $this->sal;
	}

	function get_fname()
	{
		return $this->fname;
	}

	function get_lname()
	{
		return $this->lname;
	}

	function get_designation()
	{
		return $this->designation;
	}


	function get_cmp_addr2()
	{
		return $this->cmp_addr2;
	}

	function get_cmp_addr3()
	{
		return $this->cmp_addr3;
	}

	function get_city()
	{
		return $this->city;
	}

	function get_country()
	{
		return $this->country;
	}

	function get_dob()
	{
		return $this->dob;
	}

	function get_anniv()
	{
		return $this->anniv;
	}

	function get_pc()
	{
		return $this->pc;
	}

	function get_email()
	{
		return $this->email;
	}

	function get_phone()
	{
		return $this->phone;
	}

	function get_fax()
	{
		return $this->fax ;
	}

	function get_mobile()
	{
		return $this->mobile;
	}

	function get_art_event()
	{
		return $this->art_event;
	}

	function get_book_event()
	{
		return $this->book_event;
	}

	function get_food_promo()
	{
		return $this->food_promo ;
	}

	function get_alcohol()
	{
		return $this->alcohol ;
	}

	function get_fund_raiser()
	{
		return $this->fund_raiser;
	}

	function get_fashion_event()
	{
		return $this->fashion_event;
	}

	function get_sports_event()
	{
		return $this->sports_event;
	}

	function get_vip_event()
	{
		return $this->vip_event ;
	}

	function get_flag()
	{
		return $this->flag;
	}

	function get_cmp_addr1()
	{
		return $this->cmp_addr1;
	}

	function get_src_desc()
	{
		return $this->src_desc;
	}
	
	function get_pid()
	{
		return $this->pid;
	}
	function get_sid()
	{
		return $this->sid;
	}
	function get_aid()
	{
		return $this->aid;
	}
	function get_cmpid()
	{
		return $this->cmpid;
	}
	function get_catid()
	{
		return $this->catid;
	}
	function get_bookid()
	{
		return $this->bookid;
	}
	function get_artid()
	{
		return $this->artid;
	}
	function get_foodid()
	{
		return $this->foodid;
	}
	function get_alcid()
	{
		return $this->alcid;
	}
	function get_fundid()
	{
		return $this->fundid;
	}
	function get_fashionid()
	{
		return $this->fashionid;
	}
	function get_sportsid()
	{
		return $this->sportsid;
	}
	function get_vipid()
	{
		return $this->vipid;
	}
}

?>