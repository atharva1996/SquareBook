<?php

  include 'connect.php'; 
  ?>

  <style type="text/css">
 
</style>
<?php
 $output = ''; 
 if(isset($_SESSION['lid']))
 {
  $lid = $_SESSION['lid'];
  $sql = "SELECT * FROM temp WHERE \"lid\" = '$lid';";
  $result = pg_query($db, $sql);  
  if(pg_num_rows($result) > 0)  
 {  
      $output .= '<h4 align="center">Search Result</h4>';  
      $output .= '<div class="table-responsive">  
                          <table class="table table bordered">  
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
      echo "<div id=\"result1\">".$output."</div>";  
 }  
 else  
 {  
      echo "<div id=\"result1\">Data not found</div>"; 
 }
unset($_SESSION['lid']);
 }
 ?>