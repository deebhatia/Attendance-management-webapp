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
if($_SESSION['check'] == 1 && $_SESSION['access']==0)
{
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
		$i=1;
		echo '<select name="dropdown">';
		while($row=mysql_fetch_array($query))
		{
			echo '<option name="i'.$i.'">'.$row['sub_name'].'</option>';
			
			$i++;
		}
		
		
		if(isset($_POST['roll']))
		echo '<input type="text" placeholder="Student Roll No." value="'.$_POST['roll'].'"name="roll">';
		else		
			echo '<input type="text" placeholder="Student Roll No." name="roll">';
			echo '<br/>';
			echo '<input type="submit" value="Submit" name="submit">';
			echo '</center>';
			echo '</form>';
			$myroll=$_POST['roll'];
						
			$subject=$_POST['dropdown'];
			$qry_j11="select sub_code from subjects where sub_name='$subject'";
			$qry_j12=mysql_query($qry_j11);
			while($qry_j13=mysql_fetch_array($qry_j12))
			$subject_sub = $qry_j13['sub_code'];
			//echo $subject_sub;			
			$qry_j1="select sub_code from studies where stdnt_id='$myroll'";
			$qry_j2=mysql_query($qry_j1);
			while($qry_j14=mysql_fetch_array($qry_j2))
			{
				if( $qry_j14['sub_code']== $subject_sub )
				{
					$flag=0;
					
				}
				else
				{
					$flag=1;
					
				}
				
			}
			if($flag==0)
			{
				echo "Wrong Student selected.";
			}
			if($flag==1)
			{
				$qry_j21="select * from attendance_report where stdnt_id='$myroll' and sub_code='$subject_sub'";
				$qry_j22=mysql_query($qry_j21);
				echo '<table border="1">';
				echo '<tr><td>FROM</td><td>TO</td><td>Total CLasses</td><td>Class attended</td><td>Update</td></tr>';
				while($qry_j23=mysql_fetch_array($qry_j22))
				{
				
					echo '<tr><td>'.$qry_j23['from_date'].'</td><td>'.$qry_j23['to_date'].'</td><td>'.$qry_j23['total_classes'].'</td><td>'.$qry_j23['class_attended'].'</td><td><input type=\"number\"/></td></tr></br>' ;
					
				
				}
				echo '</table>';
			}
			
			
				
	}
	else
	echo '<h2>Sorry..You have no Subject to teach this year..</h2>';
}
else
header("location: /project2/php/access_denied.php");
?>
</body>
</html>
