<html>
<head>
<title>Choose Subject</title>
<link rel="stylesheet" type="text/css" href="/project2/css/test_css.css" />
</head>
<?php
session_start();
if(!isset($_SESSION['id'])){
header("location: /project2/php/access_denied.php");}
?>
<?php
require_once('config.php');
if($_SESSION['check'] == 1 && $_SESSION['access']==0)
{
	$date=date("Y");
	$var=$_SESSION['id'];
	echo '<center>';
	echo '<form action="/project2/php/use.php" method="post">';
	echo '<table class="table">'.'<tr>'.'<td>';
	echo "<h1 class=\"hii\">Please Choose The Subject  </h1>".'<br/>'.'</tr>'.'</td>'.'</table>'.'</br>';
$var1="select sub_name ,sub_code from subjects where sub_code in (select sub_code from teaches where tchr_id='$var' and year=$date )";
	$query=mysql_query($var1);
	echo '<select name="dropdown">';
	while($row=mysql_fetch_array($query))
	{
		echo '<option style="font-variant:small-caps;text-align:center;" value="'.$row['sub_code'].'">'.$row['sub_name'].'</option>';
		echo $row;	
	}
	echo '</center>'.'<br/>';
	echo '<input type="submit" value="Submit" name="submit">';
	echo '</form>';
}

?>
</body>
</html>
