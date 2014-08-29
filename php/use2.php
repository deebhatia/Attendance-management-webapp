<!DOCTYPE html>
<title> Completion</title>
<head>

<link rel="stylesheet" type="text/css" href="test_css.css" />
</head>
<body>
<?php
	session_start();
	if($_SESSION['check'] == 3 && $_SESSION['access']==0)
	{
	require_once('config2.php');
	$stdntid=array();
	$tid=$_SESSION['id'];
	$a=$_SESSION['imax'];
	$stdntid=$_SESSION['stdntmax'];
	$scode=$_SESSION['scode'];
	$classes=$_POST['total'];
	$from=$_POST['from'];
	$from1=explode('/',$from);
	$from=$from1[2]."-".$from1[0]."-".$from1[1];
	
	$to=$_POST['to'];
	$to1=explode('/',$to);
	$to=$to1[2]."-".$to1[0]."-".$to1[1];
	$sem1=mysql_query("select semester from subjects where sub_code = '$scode'");
	$sem=mysql_fetch_array($sem1);
	$s=$sem['semester'];	
//echo $a;
	
	for($j=1;$j<$a;$j++)
	{
		$query="insert into attendance_report values('$stdntid[$j]','$scode','$tid', '$from','$to','$_POST[$j]','$classes', $s )";
		
		if(!(mysql_query($query)))
		die(mysql_error());
		//echo "error";
	}	
	if($j==$a)
	echo "SUCCESS";
	}
	
	
	else
	{
	echo '<img class="ia" height="150"	 src=private.jpg / >'.'<br/>';
	echo '<table style="padding-left: 100px;"><tr><td>';
	echo '<h1 class="p">Access Denied.....</h1>'."</br>";
	echo '<a class="a" href=tchr_login.php> Click Here</a>'." to login";
	echo '</td></tr></table>';
	}

	
	
	?>
	
</body>
</html>	


