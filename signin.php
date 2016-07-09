
     
<?php
session_start();
include('connect.php');
//your values are stored in cookies, then you can login without validate
if(isset($_COOKIE['name']) && isset($_COOKIE['pwd']))
{
	echo $_COOKIE['name'];
	$_SESSION['name']=$_COOKIE['name'];
   header('location:search_home2.php');
}
// login validation in php
if(isset($_POST['submit']))
{
 
 $name=$_POST['name'];
 $pwd=$_POST['pwd'];

 if($name!=''&& $pwd!='')
 {
 	//echo $name;
 	//echo $pwd;
 	
 
 	$query=pg_query($db,"select \"Password\",\"Flag\" from login where \"Email\"='$name'")  or die("error".pg_last_error());
 	$res=pg_fetch_array($query);
 	$f = $res["Flag"];
 	$y = trim($res["Password"]); //password from database
  $x = crypt($pwd,$res["Password"]); //hashed user enter password
 
   if(strcmp($y,$x) == 0 && strcmp($f,1) == 0) //comparing user and database hash values
   {
   
    if(isset($_POST['remember']))
    {
   setcookie('name',$name, time() + (60*60*24*1));
   setcookie('pwd',$pwd, time() + (60*60*24*1));
     }
    $_SESSION['name']=$name;
    header('location:search_home2.php');
   }
   else
   {
    echo '<script>alert("You  entered username or password is incorrect");</script>';
   }
 }
 else
 {
  echo'<script>alert("Enter both username and password!");</script>';
 }
}
?>
     

