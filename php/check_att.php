<!DOCTYPE html>
<title> Check Attendance</title>
<head>
	
  <meta charset="utf-8" />
  <link rel="shortcut icon" href="/project2/images/jmi.jpg" type="image/x-icon" />
  <style type="text/css">
.tftable {font-size:12px;color:#333333;width:100%;border-width: 1px;border-color: #a9a9a9;border-collapse: collapse;}
.tftable th {font-size:12px;background-color:#b8b8b8;border-width: 1px;padding: 8px;border-style: solid;border-color: #a9a9a9;text-align:left;}
.tftable tr {background-color:#ffffff;}
.tftable td {font-size:12px;border-width: 1px;padding: 8px;border-style: solid;border-color: #a9a9a9;}
.tftable tr:hover {background-color:#ffff99;}
.a {font-size:14px;
text-align: center;}
</style>
  </head>
<body>
<?php
session_start();
if(isset($_SESSION['access']) && $_SESSION['access']!=0)
{
	header("location:/project2/php/access_denied.php");
}
else
{
require_once('config.php');
	if(!isset($_POST['submit1']) && !isset($_POST['submit2']))
	{
		echo "Welcome, ".$_SESSION['user'];
		echo '<center>';
		echo '<form action="/project2/php/check_att.php" method="post">';
		echo '<table class="table">'.'<tr>'.'<td>';
		echo "<h1 class=\"hii\">Select Year</h1>".'<br/>'.'</tr>'.'</td>'.'</table>'.'</br>';
		$var1="select year from teaches where tchr_id='".$_SESSION['id']."'";
		
		$query=mysql_query($var1);
		echo '<select name="dropdown1">';
		while($row=mysql_fetch_array($query))
		{
			echo '<option style="font-variant:small-caps;text-align:center;" value="'.$row['year'].'">'.$row['year'].'</option>';
		}
		echo '</center>'.'<br/>';
		echo '<input type="submit" value="Submit" name="submit1">';
		echo '</form>';
	}
	else if(isset($_POST['submit1']) && !isset($_POST['submit2']))
	{
		echo "Welcome, ".$_SESSION['user'];
		$year=$_POST['dropdown1'];
		echo '<center>';
		echo '<form action="/project2/php/check_att.php" method="post">';
		echo '<table class="table">'.'<tr>'.'<td>';
		echo "<h1 class=\"hii\">Select Subject</h1>".'<br/>'.'</tr>'.'</td>'.'</table>'.'</br>';
		echo "<h3>Year : ".$year."</h3>";
		$var1="select sub_name,sub_code from subjects where sub_code in ( select sub_code from teaches where tchr_id='".$_SESSION['id']."' and year=".$year.");";
		echo '<input type="hidden" value="'.$year.'" name="year">';
		$query=mysql_query($var1);
		echo '<select name="dropdown2">';
		while($row=mysql_fetch_array($query))
		{
			echo '<option style="font-variant:small-caps;text-align:center;" value="'.$row['sub_code'].'">'.$row['sub_name'].'</option>';
		}
		echo '</center>'.'<br/>';
		echo '<input type="submit" value="Submit" name="submit2">';
		echo '</form>';
	}
	else
	{
		echo "Welcome, ".$_SESSION['user'];
		$year=$_POST['year'];
		$scode=$_POST['dropdown2'];
		$tchrid=$_SESSION['id'];
		$start=$year."-01-01";
		$end=$year."-12-31";
		$var1="select stdnt_id,sum(class_attended) as ca,sum(total_classes) as ct from attendance_report where tchr_id='".$tchrid."' and sub_code='".$scode."' and from_date > '".$start."' and to_date < '".$end."' group by stdnt_id";
		
		$var2="select sub_name from subjects where sub_code='".$scode."'";
		$result=mysql_query($var2);		
		$sname=mysql_fetch_array($result);
		
		$var2="select min(from_date) as fd from attendance_report where sub_code='".$scode."' and from_date > '".$start."'";
		$result=mysql_query($var2);
		$fdate=mysql_fetch_array($result);
		////echo $fdate['fd'];
		
		$var2="select max(to_date) as td from attendance_report where sub_code='".$scode."' and to_date < '".$end."'";
		$result=mysql_query($var2);
		$tdate=mysql_fetch_array($result);
		//echo $tdate['td'];
		
		//echo $var1;
		$query=mysql_query($var1);
		echo '<center><h3>From : '.$fdate['fd'].'<br/>To : '.$tdate['td'].'<br/>Subject : '.$sname['sub_name'].'</h3><br/>';
		
		echo '<table class="tftable" border="1">';
		echo '<tr>';
		echo '<th>Roll No.</td>';
		echo '<th>Name</td>';
		echo '<th>Class Attended</td>';
		echo '<th>Total Classes</td>';
		echo '<th>Percentage</td>';
		echo '</tr>';
		while($row=mysql_fetch_array($query))
		{
			echo '<tr>';
			echo '<td>'.$row['stdnt_id'].'</td>';
			$query1=mysql_query("select stdnt_name from student where stdnt_id='".$row['stdnt_id']."'");
			$row1=mysql_fetch_array($query1);
			echo '<td>'.$row1['stdnt_name'].'</td>';	
			echo '<td>'.$row['ca'].'</td>';
			echo '<td>'.$row['ct'].'</td>';
			echo '<td>'.round((($row['ca']*100)/$row['ct']),2).'%</td>';
			echo '</tr>';
		
		}	
			echo '</table>';
			
	}
}
echo '</br></br><center><a href="/project2/php/home.php">HOME</a></center>';
?>
</body>
</html>
