<?php
include('connect.php');
include('verification.php'); 
 
        if($_SERVER["REQUEST_METHOD"]=="POST")
        {
              $fname= pg_escape_string($db,$_POST['fname']);
              $lname= pg_escape_string($db,$_POST['lname']);
              $email= pg_escape_string($db,$_POST['email']);
              $password= pg_escape_string($db,$_POST['password']);
              $cpassword= pg_escape_string($db,$_POST['cpassword']);
              $phone= pg_escape_string($db,$_POST['phno']);
      $code=substr(md5(mt_rand()),0,15);

              if(empty($fname)|| empty($lname) || empty($password) || empty($cpassword) || empty($email) || empty($phone) )
              {
                  $er="You did not fill out the required fields.";
              }
              else 
                {


                    $sql = "SELECT \"Email\" FROM login WHERE \"Email\"='$email'";
                    $result = pg_query($db,$sql);
                    $row = pg_fetch_array($result);
          
                    if(pg_num_rows($result) == 1)
                    {
                        $er= "Sorry.. This email id already exist.!!";
                    }
                    else if ($password!=$cpassword)
                    {
                        $er= "Passwords do not match.!!";
                    }

                    else
                    {   
                        //Encryption code
                      $salt = mcrypt_create_iv(22, MCRYPT_DEV_URANDOM);
            $salt = base64_encode($salt);
            $salt = str_replace('+', '.', $salt);
            $flag = 0;
            $hash = crypt($password, '$2y$10$'.$salt.'$');
                        $query = pg_query($db,"INSERT INTO \"login\"(\"Fname\",\"Lname\",\"Phone\",\"Email\",\"Password\",\"Code\",\"Flag\") VALUES('$fname','$lname','$phone','$email','$hash','$code','$flag')") or die("error");
                         
            require 'send-email.php'; 
            
            
             
               
}
                    }
                }
        
        
?>
<html>
    <head>
  <script>
      alert("<?php echo $er; ?>");</script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">

      <link href="http://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
       <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">

   <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/landing-page.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">

    
    <style type="text/css">
       
    html, body {
    height: 100%;
    margin: 0px;
    }
    .centered-form{
    margin-top: 60px;
    }

    .centered-form .panel{
    background: rgba(255, 255, 255, 0.8);
    box-shadow: rgba(0, 0, 0, 0.3) 20px 20px 20px;
    }

    .glowing-border {
   border-radius: 4px;
   box-shadow: 0 0 10px #999999!
  
    } 
    .btn-info {
      background: #0a76c7;
      font-family: sans-serif;
      border: none;

    }
    label{
        font-family: sans-serif;
        color: black;
    }
   
    </style>
    </head>
<body >
<nav class="navbar navbar-default navbar-fixed-top topnav" role="navigation">
        <div class="container topnav">
            <!-- Brand and toggle get grouped for better mobile display -->
            
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li>

                        <a href="index.php"><span class="glyphicon glyphicon-home"></span> Home</a>
                    </li>
                   
                   
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>


    
   
   
     
      
       
        
       
   
    </ul>
  </div>

</nav>
  
      



    <br><br>
    <div class="row centered-form">
     <div class="col-xs-12 col-sm-8 col-md-4 col-sm-offset-2 col-md-offset-4">
          <div class="panel panel-default">
            <div class="panel-heading">
              <h3 class="panel-title">Sign Up</h3>
            </div>
            <div class="panel-body">
            <form method="POST" action="signup.php" role="form" class="sform" >
            
            <br>
            
         <div class="row">
                  <div class="col-xs-6 col-sm-6 col-md-6">
                <label for="fname"><font color="red">*</font>First Name</label><br>
                <input type="text" placeholder="Enter Your First Name" name="fname" class="form-control input-sm glowing-border">
            </div>
                  <div class="col-xs-6 col-sm-6 col-md-6">
                <label for="lname"> <font color="red">*</font>Last Name</label><br> 
                <input  placeholder="Enter Your Last Name" type="text" name="lname" class="form-control input-sm glowing-border"><br>
           </div>
           </div>
          

           
            <label for="phone"> <font color="red">*</font>Phone Number</label><br> <input  placeholder="Enter Your Phone no" type="number" name="phno" maxlength="10" class="form-control input-sm glowing-border">
            <br>
             
                <label for="email"> <font color="red">*</font>Email ID</label><br> <input  placeholder="Enter Your email" type="email" name="email" class="form-control input-sm glowing-border">
            <br>
               
            <label for="pass"> <font color="red">*</font>Password</label><br> <input  placeholder="Enter Your passowrd" type="password" name="password" class="form-control input-sm glowing-border">
            
             <br> 
                    
                <label for="cpass"> <font color="red">*</font>Confirm Password</label><br> <input placeholder="Enter Your Confirm Passowrd" type="password" name="cpassword" class="form-control input-sm glowing-border"><br>

                 <br> 
                    
                
                <input type="submit" name="submit" value="Submit" class="btn btn-info btn-block">
                </div>
             
        </form> 
       </div>
       </div>
       </div>
    </body>
</html>