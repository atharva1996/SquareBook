<?php
session_start();

header("Cache-Control: max-age=300, must-revalidate");
if(isset($_SESSION['name']))
{

        require_once 'dbconfig.php';

}

include 'uploadfile.php';
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Search-Engine</title>
<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
<link href="bootstrap/css/bootstrap-theme.min.css" rel="stylesheet" media="screen"> 
<link href="assets/datatables.min.css" rel="stylesheet" type="text/css">

<script type="text/javascript" src="assets/jquery-1.11.3-jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  
      <link href="http://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">

    <link href="http://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    
<script type="text/javascript">

$(document).ready(function(){
	
	$("#btn-view").hide();
	
	$("#btn-add").click(function(){
		$(".content-loader").fadeOut('slow', function()
		{
			$(".content-loader").fadeIn('slow');
			$(".content-loader").load('add_form.php');
			$("#btn-add").hide();
			$("#btn-view").show();
		});
	});
	
	$("#btn-view").click(function(){
		
		$("body").fadeOut('slow', function()
		{
			$("body").load('search_home2.php');
			$("body").fadeIn('slow');
			window.location.href="search_home2.php";
		});
	});
	
});

</script>
 <style type="text/css">
 
    #margin
 	{
 		margin-left: 10px;
 	}
#wrapper:before {
    content:'';
    float: left;
    height: 100%;
}
#wrapper {
    height: 100%;
 
    
}
#header {
    background-color:#000;

}
#result {
  border-radius: 10px;
   
    font-weight: bold;
    
}
/* this is the big trick*/
#result:after {
    font-family: comic;
    content:'';
    display: block;
    clear: both;

}


 #bg
    {
        background-color: grey;
    }
    #login-dp{
    min-width: 250px;
    padding: 14px 14px 0;
    overflow:hidden;
    background-color:rgba(255,255,255,.8);
}
#login-dp .help-block{
    font-size:12px    
}
#login-dp .bottom{
    background-color:rgba(255,255,255,.8);
    border-top:1px solid #ddd;
    clear:both;
    padding:14px;
}
#login-dp .social-buttons{
    margin:12px 0    
}
#login-dp .social-buttons a{
    width: 49%;
}
#login-dp .form-group {
    margin-bottom: 10px;
}
.bottom {
    color: grey;
}

#joinus{
    color: grey;
}


 </style>

</head>

<body>

<nav class="navbar navbar-default navbar-fixed-top topnav" role="navigation">
  <div class="container">
    <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-main-collapse">
                    Menu <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand topnav" href="#">SquareBook</a>
         
                
            </div>
   
      <ul class="nav navbar-nav navbar-right">
      
        <li><a href="userhome.php"><span class="glyphicon glyphicon-home"></span> Home</a></li>
        <li>
                        <li class="dropdown">
                         <a href="#" class="dropdown-toggle" data-toggle="dropdown"><b>Upload File</b> <span class="caret"></span></a>
                            <ul id="login-dp" class="dropdown-menu">
                            <li>
                     <div class="row" >
                            <div class="col-md-12">
                               
                                 <form class="form" role="form" method="post" action="" accept-charset="UTF-8" id="login-nav" enctype="multipart/form-data">
                                        <div class="form-group">
                                             <input id="excelupload" name="excelupload" type="file" class="form-control"/>
                                        </div>
                                        
                                            
                                        <div class="form-group">
                                              <input name="submit" type="submit" value="Upload" class="btn btn-primary btn-block" />
                                             
                                        </div>
                                       
                                 </form>
                            </div>
                           
                     </div>
                </li>
            </ul>
        </li>
        </li>
      
                    </li>

        <li><a href="search_home2.php"><span class="glyphicon glyphicon-user " id="green"></span> <?php echo $_SESSION["name"];?></a></li>
            
        
        <li><a href="sessionunset.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
       
   
    </ul>
  </div>

</nav>
<br>
<br>
<br>
	<div class="container" id="margin">
      
        <br>
        <button class="btn btn-info" type="button" id="btn-add"> <span class="glyphicon glyphicon-pencil"></span> &nbsp; Add Person</button>
        <button class="btn btn-info" type="button" id="btn-view"> <span class="glyphicon glyphicon-eye-open"></span> &nbsp; View Result</button>
        <hr />
        
        <div class="content-loader">
        
        <table cellspacing="0" width="100%" id="example" class="table table-striped table-hover table-responsive">
        <thead>
<tr>
        					       	<th>edit</th>
       							  <th>delete</th>
       
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
        </tr>
        </thead>
        <tbody>
        <?php
        $key = $_GET['key'];
       $stmt = $db_con->prepare("SELECT * FROM temp WHERE \"src_name\" LIKE '%".$key."%' OR \"src_desc\" LIKE '%".$key."%' OR \"cat_name\" LIKE '%".$key."%' OR \"sal\" LIKE '%".$key."%' OR \"fname\" LIKE '%".$key."%' OR \"lname\" LIKE '%".$key."%' OR \"cmp_name\" LIKE '%".$key."%' OR \"designation\" LIKE '%".$key."%' OR \"phone\" LIKE '%".$key."%' OR \"fax\" LIKE '%".$key."%' OR \"email\" LIKE '%".$key."%' OR \"mobile\" LIKE '%".$key."%' OR \"dob\" LIKE '%".$key."%'  OR \"anniversary\" LIKE '%".$key."%' OR \"c_addr1\" LIKE '%".$key."%' OR \"c_addr2\" LIKE '%".$key."%' OR \"c_addr3\" LIKE '%".$key."%' OR \"city\" LIKE '%".$key."%' OR \"pincode\" LIKE '%".$key."%' OR \"country\" LIKE '%".$key."%' OR \"art_event\" LIKE '%".$key."%' OR \"book_event\" LIKE '%".$key."%'OR \"fashion_event\" LIKE '%".$key."%' OR \"vip_event\" LIKE '%".$key."%' OR \"food_promo\" LIKE '%".$key."%'OR \"alcohol_pairing\" LIKE '%".$key."%'OR \"fund_raiser\" LIKE '%".$key."%'OR \"sports_event\" LIKE '%".$key."%' ");
        $stmt->execute();
		while($row=$stmt->fetch(PDO::FETCH_ASSOC))
		{
			?>
			<tr>
			<td align="center">
			<a id="<?php echo $row['pid']; ?>" class="edit-link" href="#" title="Edit">
			<img src="edit.png" width="20px" />
            </a></td>
			<td align="center"><a id="<?php echo $row['pid']; ?>" class="delete-link" href="#" title="Delete">
			<img src="delete.png" width="20px" />
            </a></td>
			<td><?php echo $row['src_name']; ?></td>
			<td><?php echo $row['src_desc']; ?></td>
			<td><?php echo $row['cat_name']; ?></td>
			<td><?php echo $row['sal']; ?></td>
			<td><?php echo $row['fname']; ?></td>
			<td><?php echo $row['lname']; ?></td>
			<td><?php echo $row['cmp_name']; ?></td>
			<td><?php echo $row['designation']; ?></td>
			<td><?php echo $row['phone']; ?></td>
			<td><?php echo $row['fax']; ?></td>
			<td><?php echo $row['email']; ?></td>
			<td><?php echo $row['mobile']; ?></td>
			<td><?php echo $row['dob']; ?></td>
			<td><?php echo $row['anniversary']; ?></td>
			<td><?php echo $row['c_addr1']; ?></td>
			<td><?php echo $row['c_addr2']; ?></td>
			<td><?php echo $row['c_addr3']; ?></td>
			<td><?php echo $row['city']; ?></td>
			<td><?php echo $row['pincode']; ?></td>
			<td><?php echo $row['country']; ?></td>
			<td><?php echo $row['art_event']; ?></td>
			<td><?php echo $row['book_event'];?></td>
			<td><?php echo $row['fashion_event']; ?></td>
			<td><?php echo $row['vip_event']; ?></td>
            <td><?php echo $row['food_promo']; ?></td>
            <td><?php echo $row['alcohol_pairing']; ?></td>
            <td><?php echo $row['fund_raiser']; ?></td>
            <td><?php echo $row['sports_event']; ?></td>
			
			</tr>
			<?php
		}
		?>
        </tbody>
        </table>
        
        </div>

    </div>
    
    <br />
    
   
    

    
<script src="bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="assets/datatables.min.js"></script>
<script type="text/javascript" src="crud.js"></script>

<script type="text/javascript" charset="utf-8">
$(document).ready(function() {
	$('#example').DataTable();

	$('#example')
	.removeClass( 'display' )
	.addClass('table table-bordered');
});
</script>
</body>
</html>