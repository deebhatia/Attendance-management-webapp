<html>
<head>
	<link rel="stylesheet" href="/project2/css/stud.css">
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
<div id="wrapper">

	<form name="login-form" class="login-form" action="/project2/php/att_check.php" method="post">
	
		<div class="header">
		<h1>Student Login</h1>
		
		</div>
	
		<div class="content">
		<input name="stdntid" type="text" class="input username" placeholder="Enter Studentid" />
		<div class="user-icon"></div>
		<input name="semester" type="number" min="1" max="8" step="1" class="input password" placeholder="Enter semester" />
		<div class="pass-icon"></div>		
		</div>
		<div class="footer">
		<input type="submit" name="submit" value="submit" class="button" />
		</div>
	
	</form>
</div>
<div class="gradient"></div>




<?php
if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['submit']))
	{
		require_once('config3.php');
		$a=$_POST['semester'];
		$b=$_POST['stdntid'];
		if($b=='')
		{
			echo '<center style="color:red;font-size: 20px;">**Please Enter Student\'s Roll No.</center>';
			return;
		}
		
		if($a=='')
		{
			echo '<center style="color:red;">**Please enter the Semester</center>';
			return;
		}
		
		if(intval($a) > 8 || intval($a) < 1)
		{
			echo '<center style="color:red;">Entered Semester is invalid...<br/>Please enter the Correct Semester.</center>';
			return;
		}
		$var="select sub_code,from_date,to_date,class_attended,total_classes from attendance_report where stdnt_id='$b' and semester='$a'";
		$query=mysql_query($var);
		$sum=0;
		$sum2=0;
		$rcount=mysql_num_rows($query);

		if($rcount  != 0)
		{
		$qry=mysql_query("select stdnt_name from student where stdnt_id='".$b."'");
		$name=mysql_fetch_array($qry);
		echo "<br><h3>Name : ".$name['stdnt_name']."</h3><br/>";
		
		echo '<table class="tftable" border="1">';
		echo '<tr>';
		echo '<th>Subject</td>';
		echo '<th>From</td>';
		echo '<th>To</td>';
		echo '<th>Class Attended</td>';
		echo '<th>Total Classes</td>';
		echo '<th>Percentage</td>';
		echo '</tr>';
		while($row=mysql_fetch_array($query))
		{
			echo '<tr>';
			$c=$row['sub_code'];
			$query1=mysql_query("select sub_name from subjects where sub_code='$c'");
			while($row1=mysql_fetch_array($query1))
			echo '<td>'.$row1['sub_name'].'</td>';	
			echo '<td>'.$row['from_date'].'</td>';
			echo '<td>'.$row['to_date'].'</td>';
			echo '<td>'.$row['class_attended'].'</td>';
			$sum+=$row['class_attended'];
			echo '<td>'.$row['total_classes'].'</td>';
			$sum2+=$row['total_classes'];
			echo '<td>'.round((($row['class_attended']*100)/$row['total_classes']),2).'%</td>';
			echo '</tr>';
		
		}	
			echo '</table>';
			echo "<p class=\"a\">Total class attended : $sum".'<br/>';
			echo "Total classes Taken  : $sum2".'<br/>';
			echo "Attendance : ".round((($sum/$sum2)*100),2)."%";
		}
		else
		{
		echo '<br/><br/><br/><div id="display-error">';
			echo ' <center><h3>Sorry..Your Input Is Invalid.</h3></center>';
		echo '</div>';
		}
	}
	echo '</br></br><center><a href="/project2/index.php">HOME</a></center>';
?>
</body>
</html>
