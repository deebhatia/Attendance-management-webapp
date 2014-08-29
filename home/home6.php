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
$TeacherID = clean($_POST['TeacherID']);
$TeacherName = clean($_POST['TeacherID']);
$TeacherName = clean($_POST['Password']);
if($TeacherID=='' || $TeacherName=='' || $Password=='')
{
	header("location: /project2/php/home5.php");
}
else
{
	$qry="select tchr_id from teacher where tchr_id='$TeacherID'";
	$result=mysql_query($qry);
	$count=0;
	while($row=mysql_fetch_array($result))
	{
		$count=$count+1;
	}
	if($count==0)
	{
		$var1="insert into teacher values('$TeacherID','$TeacherName',$Password,0)";
		$result=mysql_query($var1);
		echo "Success";
		
	}
	else
	{
		header("location: /project2/php/home5.php");
	}
}
?>
</body>
</html>
