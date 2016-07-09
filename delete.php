<?php
include_once 'dbconfig.php';

	
	
	$pid = $_POST['del_id'];

	#$sql= "SELECT * FROM address_details WHERE \"cmpid\" = '$cmpid'"; 

	$stmt = $db_con->prepare("SELECT * FROM person_source WHERE \"pid\" = '$pid'"); 
	$stmt->execute();
	$row = $stmt->fetch(PDO::FETCH_ASSOC);
	$sid = $row['sid'];

	
	$stmt = $db_con->prepare("SELECT \"cmpid\" FROM company_details WHERE \"pid\"='$pid' AND \"sid\"='$sid'"); 
	$stmt->execute();
	$row = $stmt->fetch(PDO::FETCH_ASSOC);
	$cmpid = $row['cmpid'];

	$stmt = $db_con->prepare("SELECT * FROM address_details WHERE \"pid\" = '$pid' AND \"cmpid\"= '$cmpid'"); 
	$stmt->execute();
	$row = $stmt->fetch(PDO::FETCH_ASSOC);
	$aid = $row['aid'];
	

	
	

	$stmt = $db_con->prepare("SELECT \"catid\" FROM person_category WHERE \"pid\" = '$pid'"); 
	$stmt->execute();
	$row = $stmt->fetch(PDO::FETCH_ASSOC);
	$catid = $row['catid'];




	
	$stmt1=$db_con->prepare("DELETE FROM person_category WHERE \"pid\"=:pid AND \"catid\"=:catid");
	$stmt1->bindParam(":pid",$pid);
	$stmt1->bindParam(":catid",$catid);
	$stmt2=$db_con->prepare("DELETE FROM category_details WHERE \"catid\"=:catid");
	$stmt2->bindParam(":catid",$catid);
	$stmt3=$db_con->prepare("DELETE FROM person_source WHERE \"pid\"=:pid AND \"sid\"=:sid");
	$stmt3->bindParam(":pid",$pid);
	$stmt3->bindParam(":sid",$sid);
	$stmt4=$db_con->prepare("DELETE FROM person_event WHERE \"pid\"=:pid");
	$stmt4->bindParam(":pid",$pid);
	$stmt5=$db_con->prepare("DELETE FROM address_details WHERE \"aid\"=:aid");
	$stmt5->bindParam(":aid",$aid);
	$stmt6=$db_con->prepare("DELETE FROM company_details WHERE \"cmpid\"=:cmpid");
	$stmt6->bindParam(":cmpid",$cmpid);
	$stmt7=$db_con->prepare("DELETE FROM source_details WHERE \"sid\"=:sid");
	$stmt7->bindParam(":sid",$sid);
	$stmt8=$db_con->prepare("DELETE FROM person_details WHERE \"pid\"=:pid");
	$stmt8->bindParam(":pid",$pid);
	
	$stmt1->execute();
	$stmt2->execute();
	$stmt3->execute();
	$stmt4->execute();
	$stmt5->execute();
	$stmt6->execute();
	$stmt7->execute();
	$stmt8->execute();

	echo "<script>alert(\"Deleted Successfully\");</script>";
	

?>	