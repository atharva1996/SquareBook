<?php
session_start();

if(isset($_COOKIE["name"])&&isset($_COOKIE["pwd"]))
{
$_SESSION["name"]=$_COOKIE["name"];
include('connect.php');
}



header("Cache-Control: max-age=300, must-revalidate");
include 'uploadfile.php';
?>

<!DOCTYPE html>
<html>
<head>
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
      $("body").load('search_dynamic.php');
      $("body").fadeIn('slow');
      window.location.href="search_dynamic.php";
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

  <script type="text/javascript">

  function move()
  {
    location.href = 'search_home2.php?key=' + document.getElementById('search_text').value;
  }

  </script>
 

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

        <li><a href="search_dynamic.php"><span class="glyphicon glyphicon-user " id="green"></span> <?php echo $_SESSION["name"];?></a></li>
            
        
        <li><a href="sessionunset.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
       
   
    </ul>
  </div>

</nav>
  
        <div class="container">  
                <br />  
               <br>
               <br>
               <br>
                <div class="form-group">  
                     <div class="input-group">  
                          <span class="input-group-addon">Search</span>  
                          <input type="text" name="search_text" id="search_text" placeholder="Dynamic Search" class="form-control" />  

                     </div>

                </div>  
                <a onclick="move()" class="btn btn-info btn-lg">
          <span class="glyphicon glyphicon-edit"></span> Edit
        </a>
               
                <br />  
               <div id="result" class="display"> 
               </div>
           </div>  
      </body>  
 </html>  
 <script>  
 $(document).ready(function(){  
      $('#search_text').keyup(function(){ 
           var txt = $(this).val();  
           if(txt != '')  
           {  
                $.ajax({  
                     url:"search2.php",  
                     method:"post",  
                     data:{search:txt},  
                     dataType:"text",  
                     success:function(data)  
                     {  
                          $('#result').html(data);  
                     }  
                });  
           }  
           else  
           {  
                $('#result').html('');                 
           }  
      });  
 });  
 </script>  
