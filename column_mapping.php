<?php	
require('PHPExcel/IOFactory.php');
require('PHPExcel/PHPExcel.php');
require('connect.php');
session_start();

$headers = $_SESSION['column_array'];
$headers = array_filter($headers);
$i=0;
?>


<html>
<head>
<title>Column Mapping</title>
</head>
<body bgcolor="#e6ffff"><br>
<a href="#eg" style="margin-left:150px">Need help?</a>
<fieldset style="margin-left:150px;margin-right:200px;">

	<table border="1" style="border-radius:10px;float:left;margin-left:100px;margin-top:50px">
<tr style="color:#0a76c7">
	<th>Sr. No.</th>
	<th>Default Headers</th>
</tr>
<tr>
	<td>1</td>
	<td>Source</td>
</tr>
<tr>
	<td>2</td>
	<td>Source Description</td>
</tr>
<tr>
	<td>3</td>
	<td>Category</td>
</tr>
<tr>
	<td>4</td>
	<td>Company</td>
</tr>
<tr>
	<td>5</td>
	<td>Sal</td>
</tr>
<tr>
	<td>6</td>
	<td>First Name</td>
</tr>
<tr>
	<td>7</td>
	<td>Last Name</td>
</tr>
<tr>
	<td>8</td>
	<td>Designation</td>
</tr>
<tr>
	<td>9</td>
	<td>Address Line 1</td>
</tr>
<tr>
	<td>10</td>
	<td>Address Line 2</td>
</tr>
<tr>
	<td>11</td>
	<td>Address Line 3</td>
</tr>
<tr>
	<td>12</td>
	<td>City</td>
</tr>
<tr>
	<td>13</td>
	<td>Pincode</td>
</tr>
<tr>
	<td>14</td>
	<td>Country</td>
</tr>
<tr>
	<td>15</td>
	<td>Phone</td>
</tr>
<tr>
	<td>16</td>
	<td>Fax</td>
</tr>
<tr>
	<td>17</td>
	<td>Email</td>
</tr>
<tr>
	<td>18</td>
	<td>Mobile</td>
</tr>
<tr>
	<td>19</td>
	<td>Date of Birth</td>
</tr>
<tr>
	<td>20</td>
	<td>Anniversary Date</td>
</tr>
<tr>
	<td>21</td>
	<td>Art Event</td>
</tr>
<tr>
	<td>22</td>
	<td>Book Event</td>
</tr>
<tr>
	<td>23</td>
	<td>Food Promotion</td>
</tr>
<tr>
	<td>24</td>
	<td>Alcohol Pairing</td>
</tr>
<tr>
	<td>25</td>
	<td>Fund Raiser</td>
</tr>
<tr>
	<td>26</td>
	<td>Fashion Event</td>
</tr>
<tr>
	<td>27</td>
	<td>Sports Event</td>
</tr>
<tr>
	<td>28</td>
	<td>VIP Event</td>
</tr>



</table>
<form action="process.php" method="POST">
<table border="2" id="myForm" style="border-radius:10px;float:left;margin-left:200px;margin-top:50px">
<tr  style="color:#0a76c7">
<th>Sr.No.</th>
<th>Sheet Headers</th>
</tr>
<?php
foreach($headers as $value)
{
echo "<tr><td><input type='number' name='myInput_".$i."'' min='1' style = 'width:52px;height:18px;'><td style=\"height:20px;\">".$value."</td></tr>";
$i++;
}
?>
</table>
<input style="margin-top:690px;height:30px;width:80px;background-color:#0a76c7;color:white;border-radius:5px;border:0px" type="submit" value="submit">
</form>

</fieldset><br><br>
<hr>
<br><br>
<div id="eg">
	<ul style="margin-top:25px;margin-left:200px"><b><li>Match the Sheet Headers with the Default Headers with the help of Sr. No.</li><li>Keep input blank for those Sheet Headers that cannot be mapped.</li></b></ul><br>
	<img src="example.jpg" style="margin-left:200px">
</div>
</body>
</html>
























