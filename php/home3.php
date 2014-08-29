<html>
<head>
	<title>Remove the student </title>
	<link rel="stylesheet" href="/project2/css/stud.css">
	
</head>
<body>
<div id="wrapper">

	<form name="login-form" class="login-form" action="/project2/php/home3.php" method="post">
	
		<div class="header">
		<h1>REMOVE the student</h1>
		
		</div>
	
		<div class="content">
		<input name="StudentID" type="text" class="input stdnt_id" placeholder="Student ID" />
		<div class="user-icon"></div>
		<input name="StudentName" type="text" class="input stdnt_name" placeholder="Student Name" />
		<div class="user-icon"></div>
		</div>

		<div class="footer">
		<input type="submit" name="submit" value="Insert" class="button" />
		<input type="reset" name="reset" value="Reset" class="button" />

		</div>
	
	</form>

</div>





<?php 
session_start();
if($_SESSION['access']!=1)
{
header("location: /project21/php/access_denied.php");
}
else if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['submit']))
{
require_once('config.php');
$errmsg_arr = array();
$errflag = true;
function clean($str) 
{
	$str = @trim($str);
	if(get_magic_quotes_gpc()) 
	{
		$str = stripslashes($str);
	}
	return mysql_real_escape_string($str);
}
$StudentID = clean($_POST['StudentID']);
$StudentName = clean($_POST['StudentName']);
		if($StudentID=='')
		{
			echo '<center style="color:red;font-size: 20px;">**Please Enter student \'s ID.</center>';
			return;
		}
		if($StudentName=='')
		{
			echo '<center style="color:red;font-size: 20px;">**Please Enter student \'s name.</center>';
			return;
		}
	$qry="select stdnt_id,stdnt_name from student where stdnt_id='$StudentID'";
	$result=mysql_query($qry);
	$count=0;
	while($row=mysql_fetch_array($result))
	{
		$count=$count+1;
		$nm=$row['stdnt_name']
	}
	echo $count;
	if($count==0 && $StudentName==$nm)
	{
		
		$var1="insert into student values('$StudentID','$StudentName',$EnrollmentNo,$Semester)";
		$result=mysql_query($var1);
		header("location:project21/php/home4.php");
		
	}
	else
	{
		echo '<br/><br/><br/><div id="display-error">';
			echo ' <center style="color:red;"><h3>Sorry..Invalid StudentID or StudentName</h3></center>';
		echo '</div>';	
	}
}
}
?>

</body>
</html>
