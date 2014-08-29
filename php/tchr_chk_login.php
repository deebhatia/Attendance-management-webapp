<?php 
session_start();
require_once('config.php');
$errmsg_arr = array();
$errflag = false;
function clean($str) 
{
	$str = @trim($str);
	if(get_magic_quotes_gpc()) 
	{
		$str = stripslashes($str);
	}
	return mysql_real_escape_string($str);
}

define("MAX_LENGTH", 6);
 
function generateHashWithSalt($password) {
    $intermediateSalt = md5(uniqid(rand(), true));
    $salt = substr($intermediateSalt, 0, MAX_LENGTH);
    return hash("sha256", $password . $salt);
}

//$password = hash("sha512", $password); 


$username = clean($_POST['username']);
//$password = clean($_POST['password']);
$password = clean(hash("sha512",$_POST['password']));
//include("use.php");
if($username == '') 
{
	$errmsg_arr = 'Username missing';
	header("location: /project2/php/tchr_login.php?error=1");
	//$errflag = true;
}
if($password == '') 
{
	$errmsg_arr = 'Password missing';
	header("location: /project2/php/tchr_login.php?error=2");
	//$errflag = true;
}
 
if($errflag) 
{
	$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
	session_write_close();
	header("location: /project2/php/tchr_login_2.php");
	exit();
}
$qry="select tchr_id,access from $table where tchr_name='$username' and password='$password'";
$result=mysql_query($qry);
	if($result) 
	{
		if(mysql_num_rows($result) > 0) 
		{
			session_regenerate_id();
			$member = mysql_fetch_array($result);
			$_SESSION['check'] = 1;
			$_SESSION['user'] = $username;
			$_SESSION['id'] = $member['tchr_id'];
			$_SESSION['access'] = $member['access'];
			session_write_close();
			header("location: /project2/php/home.php");
			exit();
		}
		else 
		{
			$errmsg_arr = '';
			$errflag = true;
			if($errflag) {
				$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
				echo "user name and password not found"; 
				session_write_close();
				header("location: /project2/php/tchr_login_2.php?error=a");
			}
		}
	}
	else 
	{
		die("Query failed");
	}
?>