<style type="text/css">
  .table-responsive
  {
    max-height: 650px;
  }
</style>

<?php  
  include 'connect.php'; 
 $output = ''; 
 $key = $_POST['search']; 

 
// temp is view in database

$sql = "SELECT * FROM temp WHERE \"src_name\" LIKE '%".$key."%' OR \"src_desc\" LIKE '%".$key."%' OR \"cat_name\" LIKE '%".$key."%' OR \"cmp_name\" LIKE '%".$key."%' OR \"sal\" LIKE '%".$key."%' OR \"fname\" LIKE '%".$key."%' OR \"lname\" LIKE '%".$key."%' OR \"designation\" LIKE '%".$key."%' OR \"c_addr1\" LIKE '%".$key."%' OR \"c_addr2\" LIKE '%".$key."%' OR \"city\" LIKE '%".$key."%' OR \"pincode\" LIKE '%".$key."%' OR \"country\" LIKE '%".$key."%' OR \"phone\" LIKE '%".$key."%' OR \"fax\" LIKE '%".$key."%' OR \"email\" LIKE '%".$key."%' OR \"mobile\" LIKE '%".$key."%' OR \"art_event\" LIKE '%".$key."%' OR \"book_event\" LIKE '%".$key."%' OR \"food_promo\" LIKE '%".$key."%' OR \"alcohol_pairing\" LIKE '%".$key."%' OR \"fund_raiser\" LIKE '%".$key."%' OR \"fashion_event\" LIKE '%".$key."%' OR \"sports_event\" LIKE '%".$key."%' OR \"vip_event\" LIKE '%".$key."%' OR \"dob\" LIKE '%".$key."%' OR \"anniversary\" LIKE '%".$key."%' OR \"c_addr3\" LIKE '%".$key."%';";  

 $result = pg_query($db, $sql);  
 if(pg_num_rows($result) > 0)  
 {  
      
      $output .= '<div class="table-responsive">  
                  <br>
                          <table class="table table bordered" border=1px>  
                               <tr> 
                               <th>Source</th> 
                               <th>Source Description</th>
                                    <th>Category</th>
                                    <th>Salutation</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Company</th>
                                    <th>Designation</th>
                                    <th>Phone</th>
                                     <th>Fax</th>
                                    <th>Email</th>
                                    <th>Mobile</th>   
                                   <th>Date of Birth</th>
                                   <th>Anniversary</th>
                                    <th>Address 1</th>
                                    <th>Address 2</th>
                                    <th>Address 3</th>
                                    <th>City</th>
                                    <th>Pincode</th>
                                    <th>Country</th>
                                    <th>Art Event</th>
                                    <th>Book Event</th>
                                    <th>Fashion Event</th>
                                    <th>VIP Event</th>
                                    <th>Food Promotion</th>
                                    <th>Alcohol Pairing</th>
                                    <th>Fund Raiser</th>
                                    <th>Sports Event</th>

                                    
                                   
                                    
                               </tr>';  
      while($row = pg_fetch_array($result))  
      {  
           $output .= '  
                <tr>  
                     <td>'.$row["src_name"].'</td>
                     <td>'.$row["src_desc"].'</td>
                     <td>'.$row["cat_name"].'</td>
                     <td>'.$row["sal"].'</td>  
                     <td>'.$row["fname"].'</td>
                     <td>'.$row["lname"].'</td>
                     <td>'.$row["cmp_name"].'</td>
                     <td>'.$row["designation"].'</td>
                     <td>'.$row["phone"].'</td>
                     <td>'.$row["fax"].'</td>
                     <td>'.$row["email"].'</td>
                     <td>'.$row["mobile"].'</td>
                     <td>'.$row["dob"].'</td>
                     <td>'.$row["anniversary"].'</td>
                     <td>'.$row["c_addr1"].'</td>
                     <td>'.$row["c_addr2"].'</td>
                     <td>'.$row["c_addr3"].'</td>
                     <td>'.$row["city"].'</td>
                     <td>'.$row["pincode"].'</td>
                     <td>'.$row["country"].'</td>
                     <td>'.$row["art_event"].'</td>
                     <td>'.$row["book_event"].'</td>
                     <td>'.$row["fashion_event"].'</td>
                     <td>'.$row["vip_event"].'</td>
                     <td>'.$row["food_promo"].'</td>
                     <td>'.$row["alcohol_pairing"].'</td>
                     <td>'.$row["fund_raiser"].'</td>
                    <td>'.$row["sports_event"].'</td>               
                     
                </tr>  
           ';  
      }  
      echo $output;  
 }  
 else  
 {  
      echo '<br>Data Not Found';  
 }  

 ?>  