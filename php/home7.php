<head>
	<title>Remove Teacher</title>
	<link rel="stylesheet" href="/project2/css/stud.css">
	
</head>
<body>
<div id="wrapper">

	<form name="login-form" class="login-form" action="/project2/php/home7.php" method="post">
	
		<div class="header">
		<h1>Remove Teacher </h1>
		
		</div>
	
		<div class="content">
		<input name="TeacherID" type="text" class="input stdnt_id" placeholder="TeacherID" />
		<div class="user-icon"></div>
		<input name="TeacherName" type="text" class="input stdnt_name" placeholder="TeacherName" />
		<div class="user-icon"></div>
		</div>

		<div class="footer">
		<input type="submit" name="submit" value="Delete" class="button" />
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
$TeacherID = clean($_POST['TeacherID']);
$TeacherName = clean($_POST['TeacherName']);
		if($TeacherID=='')
		{
			echo '<center style="color:red;font-size: 20px;">**Please Enter Teacher \'s ID.</center>';
			return;
		}
		
		if($TeacherName =='')
		{
			echo '<center style="color:red;">**Please enter Teacher \'s Name.</center>';
			return;
		}
		
		$qry="select tchr_id from teacher where tchr_id='$TeacherID' and tchr_name='$TeacherName'";
		$result=mysql_query($qry);
		$count=0;
		while($row=mysql_fetch_array($result))
		{
			$count=$count+1;
		}
		if($count!=0)
		{
			$var1="DELETE FROM `attendance`.`teacher` WHERE `teacher`.`tchr_id` = '$TeacherID';";
			$result=mysql_query($var1);
			header("location: /project2/php/home8.php");	
		
		}
		else
		{
		echo '<br/><br/><br/><div id="display-error">';
			echo ' <center style="color:red;">Sorry..Deletion is failed No Entry  exists</center>';
		echo '</div>';
		}
	}
?>

</body>
