<html>
<head>
	<title>Update the teacher </title>
	<link rel="stylesheet" href="/project2/css/stud.css">
	
</head>
<body>
<div id="wrapper">

	<form name="login-form" class="login-form" action="/project2/php/update1.php" method="post">
	
		<div class="header">
		<h1>Alter Teacher</h1>
		
		</div>
	
		<div class="content">
		<input name="SubjectName" type="text" class="input stdnt_id" placeholder="Subject Name" />
		<div class="user-icon"></div>
		<input name="PresentTeacherName" type="text" class="input stdnt_name" placeholder="PresentTeacher" />
		<div class="user-icon"></div>
		<input name="NewTeacherName" type="text" class="input enroll_no" placeholder="NewTeacher" />
		<div class="user-icon"></div>
		</div>

		<div class="footer">
		<input type="submit" name="submit" value="Alter" class="button" />
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
$SubjectName = clean($_POST['SubjectName']);
$PresentTeacherName = clean($_POST['PresentTeacherName']);
$NewTeacherName = clean($_POST['NewTeacherName']);
		if($SubjectName=='')
		{
			echo '<center style="color:red;font-size: 20px;">**Please Enter the subject</center>';
			return;
		}
		
		if($PresentTeacherName =='')
		{
			echo '<center style="color:red;">**Please enter present Teacher \'s Name.</center>';
			return;
		}
		

		if($NewTeacherName =='')
		{
			echo '<center style="color:red;">**Please enter new Teacher \'s Name.</center>';
			return;
		}
		$qry="select sub_code from subjects where sub_name='$SubjectName'";
		$result=mysql_query($qry);
		$count=0;
		while($row=mysql_fetch_array($result))
		{
			$count=$count+1;
			$sc=clean($row['sub_code']);
		}
		if($count==0)
		{
		echo '<br/><br/><br/><div id="display-error">';
			echo ' <center style="color:red;">Invalid Subject</center>';
		echo '</div>';
		}
		$qry="select tchr_id from teacher where tchr_name='$PresentTeacherName'";
		$result=mysql_query($qry);
		$count=0;
		while($row=mysql_fetch_array($result))
		{
			$count=$count+1;
			$pt=clean($row['tchr_id']);
		}
		$qry="select tchr_id from teaches where tchr_id='$pt' and sub_code='$sc'";
		$result=mysql_query($qry);
		$count1=0;
		$flag=0;
		while($row=mysql_fetch_array($result))
		{
			$count1=$count1+1;
			$pt=clean($row['tchr_id']);
			
		}
		if($count==0 || $count1==0)
		{$flag=1;
		echo '<br/><br/><br/><div id="display-error">';
			echo ' <center style="color:red;">Invalid Present Teacher</center>';
		echo '</div>';
		return;
		}

		$qry="select tchr_id from teacher where tchr_name='$NewTeacherName'";
		$result=mysql_query($qry);
		$count=0;
		while($row=mysql_fetch_array($result))
		{
			$count=$count+1;
			$nt=clean($row['tchr_id']);
		}
		if($count==0)
		{
		echo '<br/><br/><br/><div id="display-error">';
			echo ' <center style="color:red;">Invalid New Teacher</center>';
		echo '</div>';
		$flag=1;
		return;
		}
		if($flag==0)
		{
		$qry="update teaches set tchr_id='$nt' where tchr_id='$pt' and sub_code='$sc'";
		$result=mysql_query($qry);
		
		header("location: /project2/php/update2.php");
		}
	}
?>

</body>
</html>
