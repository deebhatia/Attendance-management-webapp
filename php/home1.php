<head>
	<title>Student Details</title>
	<link rel="stylesheet" href="/project2/css/stud.css">
	
</head>
<body>
<div id="wrapper">

	<form name="login-form" class="login-form" action="/project2/php/home1.php" method="post">
	
		<div class="header">
		<h1>New  Student Details</h1>
		
		</div>
	
		<div class="content">
		<input name="StudentID" type="text" class="input stdnt_id" placeholder="StudentID" />
		<div class="user-icon"></div>
		<input name="StudentName" type="text" class="input stdnt_name" placeholder="StudentName" />
		<div class="user-icon"></div>
		<input name="EnrollmentNo" type="text" class="input enroll_no" placeholder="EnrollmentNo" />
		<div class="user-icon"></div>
		<input name="Semester" type="text" class="input semester" placeholder="Semester" />
		<div class="user-icon"></div>	
		</div>

		<div class="footer">
		<input type="submit" name="submit" value="Insert" class="button" />
		<input type="reset" name="reset" value="Reset" class="button" />

		</div>
	
	</form>

</div>
<div class="gradient"></div>

<?php 
session_start();
if($_SESSION['access']!=1)
{
header("location: /project2/php/access_denied.php");
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
$EnrollmentNo = clean($_POST['EnrollmentNo']);
$Semester = clean($_POST['Semester']);
		if($StudentID=='')
		{
			echo '<center style="color:red;font-size: 20px;">**Please Enter student \'s ID.</center>';
			return;
		}
		if($StudentName=='')
		{
			echo '<center style="color:red;font-size: 20px;">**Please Enter student \'s Name.</center>';
			return;
		}
		if($EnrollmentNo=='')
		{
			echo '<center style="color:red;font-size: 20px;">**Please Enter student \'s enrollment no.</center>';
			return;
		}
		if($Semester=='')
		{
			echo '<center style="color:red;font-size: 20px;">**Please Enter semester.</center>';
			return;
		}
	$qry="select stdnt_id from student where stdnt_id='$StudentID'";
	$result=mysql_query($qry);
	$count=0;
	while($row=mysql_fetch_array($result))
	{
		$count=$count+1;
	}
	echo $count;
	if($count==0)
	{
		$var1="insert into student values('$StudentID','$StudentName',$EnrollmentNo,$Semester)";
		$result=mysql_query($var1);
		$sql = "SELECT sub_code FROM `subjects` WHERE semester=$Semester LIMIT 0, 30 ";
		$result1=mysql_query($sql);
		while($row=mysql_fetch_array($result1))
		{
			$subcode=$row['sub_code'];
			echo $subcode;
			$var2="insert into studies values('$StudentID','$subcode')";
			$result2=mysql_query($var2);
			header("location: /project2/php/home2.php");

		}
		
	}
	else
	{
		echo '<br/><br/><br/><div id="display-error">';
			echo ' <center style="color:red;"><h3>Sorry..Insertion is failed Entry Already exists</h3></center>';
		echo '</div>';	
	}
}

?>
</body>
