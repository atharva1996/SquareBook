<?php
include_once 'dbconfig.php';

if($_GET['edit_id'])
{
	$id = $_GET['edit_id'];	
	$stmt=$db_con->prepare("SELECT * from person_details,address_details,company_details,source_details,person_source,category_details,person_category,person_event,book_event_details,art_event_details,food_promo_details,alcohol_pairing_details,fund_raiser_details,fashion_event_details,sports_event_details,vip_event_details where person_details.pid = address_details.pid and person_details.pid = company_details.pid and person_source.sid = source_details.sid and person_details.pid = person_source.pid and person_details.pid=person_category.pid and person_category.catid = category_details.catid and person_details.pid = person_event.pid and book_event_details.bookid = person_event.bookid  and art_event_details.artid = person_event.artid and food_promo_details.foodid = person_event.foodid and alcohol_pairing_details.alcid = person_event.alcid and fund_raiser_details.fundid = person_event.fundid and fashion_event_details.fashionid = person_event.fashionid and sports_event_details.sportsid = person_event.sportsid and vip_event_details.vipid = person_event.vipid and person_details.pid = :id");
	$stmt->execute(array(':id'=>$id));	
	$row=$stmt->fetch(PDO::FETCH_ASSOC);
}

?>
<style type="text/css">
#dis{
	display:none;
}
</style>


	
    
    <div id="dis">
    
	</div>
        
 	
	 <form method='post' id='emp-UpdateForm' action='#'>
 
    <table class='table table-bordered'>
 		<input type='hidden' name='pid' value='<?php echo $row['pid']; ?>' />
        <input type='hidden' name='sid' value='<?php echo $row['sid']; ?>' />
        <input type='hidden' name='aid' value='<?php echo $row['aid']; ?>' />
        <input type='hidden' name='catid' value='<?php echo $row['catid']; ?>' />
        <input type='hidden' name='cmpid' value='<?php echo $row['cmpid']; ?>' />   
        <tr>
            <td>Salutation</td>
            <td><input type='text' name='sal' class='form-control' value='<?php echo $row['sal']; ?>' ></td>
        </tr>
 
        <tr>
            <td>First Name</td>
            <td><input type='text' name='fname' class='form-control' value='<?php echo $row['fname']; ?>' ></td>
        </tr>
 
        <tr>
            <td>Last Name</td>
            <td><input type='text' name='lname' class='form-control' value='<?php echo $row['lname']; ?>' ></td>
        </tr>
          <tr>
            <td>Phone</td>
            <td><input type='text' name='phone' class='form-control' value='<?php echo $row['phone']; ?>' ></td>
        </tr>
          <tr>
            <td>Email</td>
            <td><input type='text' name='email' class='form-control' value='<?php echo $row['email']; ?>' ></td>
        </tr>
          <tr>
            <td>Mobile</td>
            <td><input type='text' name='mobile' class='form-control' value='<?php echo $row['mobile']; ?>' ></td>
        </tr>
         <tr>
            <td>Date of Birth</td>
            <td><input type='text' name='dob' class='form-control' value='<?php echo $row['dob']; ?>' ></td>
        </tr>
         <tr>
            <td>Anniversary</td>
            <td><input type='text' name='anniversary' class='form-control' value='<?php echo $row['Anniversary']; ?>' ></td>
        </tr>
        <tr>
            <td>Company Name</td>
            <td><input type='text' name='cmp_name' class='form-control' value='<?php echo $row['cmp_name']; ?>' ></td>
        </tr>
          <tr>
            <td>Designation</td>
            <td><input type='text' name='designation' class='form-control' value='<?php echo $row['designation']; ?>' ></td>
        </tr>
        <tr>
            <td>Address 1</td>
            <td><input type='text' name='c_addr1' class='form-control' value='<?php echo $row['c_addr1']; ?>' ></td>
        </tr>
         <tr>
            <td>Address 2</td>
            <td><input type='text' name='c_addr2' class='form-control' value='<?php echo $row['c_addr2']; ?>' ></td>
        </tr>

         <tr>
            <td>Address 3</td>
            <td><input type='text' name='c_addr3' class='form-control' value='<?php echo $row['c_addr3']; ?>' ></td>
        </tr>

          
          <tr>
            <td>City</td>
            <td><input type='text' name='city' class='form-control' value='<?php echo $row['city']; ?>' ></td>
        </tr>
          <tr>
            <td>Pincode</td>
            <td><input type='text' name='pincode' class='form-control' value='<?php echo $row['pincode']; ?>' ></td>
        </tr>
          <tr>
            <td>Country</td>
            <td><input type='text' name='country' class='form-control' value='<?php echo $row['country']; ?>' ></td>
        </tr>
          <tr>
            <td>Fax</td>
            <td><input type='text' name='fax' class='form-control' value='<?php echo $row['fax']; ?>' ></td>
        </tr>
          
          <tr>
            <td>Source</td>
            <td><input type='text' name='source' class='form-control' value='<?php echo $row['src_name']; ?>' ></td>
       
          <tr>
            <td>Source Description</td>
            <td><input type='text' name='src_desc' class='form-control' value='<?php echo $row['src_desc']; ?>' ></td>
        </tr>
          <tr>
            <td>Category</td>
            <td><input type='text' name='category' class='form-control' value='<?php echo $row['cat_name']; ?>' ></td>
        </tr>
          <tr>
            <td>Book Events</td>
            <td><input type='text' name='book_event' class='form-control' value='<?php echo $row['book_event']; ?>' ></td>
        </tr>
          <tr>
            <td>Art Events</td>
            <td><input type='text' name='art_event' class='form-control' value='<?php echo $row['art_event']; ?>' ></td>
        </tr>
          <tr>
            <td>Food Promotion</td>
            <td><input type='text' name='food_promo' class='form-control' value='<?php echo $row['food_promo']; ?>' ></td>
        </tr>
          <tr>
            <td>Alcohol Pairing</td>
            <td><input type='text' name='alcohol_pairing' class='form-control' value='<?php echo $row['alcohol_pairing']; ?>' ></td>
        </tr>
          <tr>
            <td>Fund Raiser</td>
            <td><input type='text' name='fund_raiser' class='form-control' value='<?php echo $row['fund_raiser']; ?>' ></td>
        </tr>
        </tr>
          <tr>
            <td>Fashion Events</td>
            <td><input type='text' name='fashion_event' class='form-control' value='<?php echo $row['fashion_event']; ?>' ></td>
        </tr>
        </tr>
          <tr>
            <td>Sports Events</td>
            <td><input type='text' name='sports_event' class='form-control' value='<?php echo $row['sports_event']; ?>' ></td>
        </tr>
        </tr>
          <tr>
            <td>VIP Events</td>
            <td><input type='text' name='vip_event' class='form-control' value='<?php echo $row['vip_event']; ?>' ></td>
        </tr>
        <tr>
            <td colspan="2">
            <button type="submit" class="btn btn-primary" name="btn-update" id="btn-update">
    		<span class="glyphicon glyphicon-plus"></span> Save Updates
			</button>
            </td>
        </tr>
 
    </table>
</form>
     
