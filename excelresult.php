<?php
session_start();
include('connect.php');
if(isset($_COOKIE["name"])&&isset($_COOKIE["pwd"]))
{
$_SESSION["name"]=$_COOKIE["name"];
}

if(isset($_SESSION['lid']))
include('tp.php');




?>
<html>
<head>
  <title>Search-Engine</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="hilitor.js"></script>
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
   <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/landing-page.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style type="text/css">
         #bg
    {
        background-color: white;
    }
    #login-dp{
    min-width: 250px;
    padding: 14px 14px 0;
    overflow:hidden;
    background-color:rgba(255,255,255);
}
#login-dp .help-block{
    font-size:12px    
}
#login-dp .bottom{
    background-color:rgba(255,255,255);
    border-top:1px solid #ddd;
    clear:both;
    padding:14px;
}


#login-dp .form-group {
    margin-bottom: 10px;
}
.bottom {
    color: blue;
}


    </style>
</head>
<body>
  <nav class="navbar navbar-default navbar-fixed-top topnav" role="navigation">
        <div class="container topnav">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand topnav" href="#">SquareBook</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="userhome.php"><span class="glyphicon glyphicon-home"></span> Home</a></li>
                    <li><a href="userhome.php"><span class="glyphicon glyphicon-user " id="green"></span> <?php echo $_SESSION["name"];?></a></li>
            
        
        <li><a href="sessionunset.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
                    <li class="hidden">
                        <a href="#page-top"></a>
                    </li>
                   
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

  
        <div class="container">  
                <br />  
                <br>
                <br>
                <h2 align="center">SquareBook</h2><br />  
                 
                 <button type="button" class="btn btn-info" onclick="location.href='search_dynamic.php'">
    <span class="glyphicon glyphicon-search" name="search" ></span> Search
  </button>
                 <!--<input type="button" name="search" onclick="location.href='search_dynamic.php'" value="SEARCH">
                   -->  
               <!--  <a onclick="move()" class="btn btn-info btn-lg">
          <span class="glyphicon glyphicon-edit"></span> Edit
        </a> -->
         <button type="button" class="btn btn-info" onclick="location.href='search_home2.php'">
    <span class="glyphicon glyphicon-edit" name="edit" ></span> Edit
  </button>
                <br />  
                <br>
                <br>
                <div id="result"></div>  
           </div>  
      </body>  
 </html>  