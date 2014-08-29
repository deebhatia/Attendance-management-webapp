<?php 
session_start();
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
if($StudentID=='' || $StudentName=='' || $EnrollmentNo=='' || $Semester=='')
{
	header("location: /project2/php/home1.php");
}
else
{
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
		}
		
	}
	else
	{
		header("location: /project2/php/home1.php");
	}
}
?>
</body>
</html>
