<html>
<head>
<title>Choose Subject</title>
<!--<link rel="stylesheet" type="text/css" href="/project2/css/test_css.css" />-->
</head>
<?php
session_start();
if(!isset($_SESSION['id'])){
	header("location: /project2/php/access_denied.php");}
?>
<?php
require_once('config.php');
$alert="";
if($_SESSION['check'] == 1 && $_SESSION['access']==0)
{
	if(isset($_POST['submit1']))
	{
		if($_POST['roll']=="")
		$alert=$alert."Roll no required.\\n";
		else
		{
			$var="select stdnt_id from studies where stdnt_id='".$_POST['roll']."' and sub_code='".$_POST['dropdown']."';";
			$qry=mysql_query($var);
			if(mysql_num_rows($qry)<1)
			$alert=$alert."Roll no is Invalid.\\n";
		}
	if($alert=="")
	{
		$_SESSION['scode']=$_POST['dropdown'];
		$_SESSION['stdntid']=$_POST['roll'];
		header('location: /project2/php/update_att2.php');
	}
	else
	echo '<script>alert("'.$alert.'");</script>';
	}
	if(isset($_POST['submit']) && isset($_POST['roll']) && isset($_POST['dropdown']))
	{
		$alert="";
		if($_POST['roll']=="")
		{
			$alert=$alert."Roll No is Required";
		}
	}
	echo "Welcome, ".$_SESSION['user'];
	$date=date("Y");
	$var=$_SESSION['id'];
	echo '<center>';
	echo '<form action="/project2/php/update_att.php" method="post">';
	echo '<table class="table">'.'<tr>'.'<td>';
	echo "<h1 class=\"\">Please Choose The Subject</h1>".'<br/>'.'</tr>'.'</td>'.'</table>'.'</br>';
	$var1="select sub_name ,sub_code from subjects where sub_code in (select sub_code from teaches where tchr_id='$var' and year=$date )";
	$query=mysql_query($var1);
	$rcount=mysql_num_rows($query);
	if($rcount>0)
	{
	echo '<select name="dropdown">';
	while($row=mysql_fetch_array($query))
	{
		echo '<option style="font-variant:small-caps;text-align:center;" value="'.$row['sub_code'].'">'.$row['sub_name'].'</option>';
		echo $row;
	}
	
	if(isset($_POST['roll']))
	echo '<input type="text" placeholder="Student Roll No." value="'.$_POST['roll'].'"name="roll">';
	else
	echo '<input type="text" placeholder="Student Roll No." name="roll">';
	echo '<br/>';
	echo '<input type="submit" value="Submit" name="submit1">';
	echo '</center>';
	echo '</form>';
	}
	else
	echo '<h2>Sorry..You have no Subject to teach this year..</h2>';
	echo '</br></br><center><a href="/project2/php/home.php">HOME</a></center>';
}
else
header("location: /project2/php/access_denied.php");
?>
</body>
</html>
