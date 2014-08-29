<!DOCTYPE html>
<title> Update Attendance</title>
<head>
	
  <meta charset="utf-8" />
  <link rel="shortcut icon" href="/project2/images/jmi.jpg" type="image/x-icon" />
  <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
  <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
  <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
  <link rel="stylesheet" href="/resources/demos/style.css" />
  <link rel="stylesheet" type="text/css" href="/project2/css/test_css.css" />
  <script>
  $(function() {
    $( "#from" ).datepicker({
      defaultDate: "+1w",
      changeMonth: true,
      numberOfMonths: 2,
      onClose: function( selectedDate ) {
        $( "#to" ).datepicker( "option", "minDate", selectedDate );
      }
    });
    $( "#to" ).datepicker({
      defaultDate: "+1w",
      changeMonth: true,
      numberOfMonths: 2,
      onClose: function( selectedDate ) {
        $( "#from" ).datepicker( "option", "maxDate", selectedDate );
      }
    });
  });
  </script>
  
   </script>
  
  
  <style type="text/css">
.tftable {font-size:12px;color:#333333;width:100%;border-width: 1px;border-color: #a9a9a9;border-collapse: collapse;}
.tftable th {font-size:12px;background-color:#b8b8b8;border-width: 1px;padding: 8px;border-style: solid;border-color: #a9a9a9;text-align:left;}
.tftable tr {background-color:#ffffff;}
.tftable td {font-size:12px;border-width: 1px;padding: 8px;border-style: solid;border-color: #a9a9a9;}
.tftable tr:hover {background-color:#ffff99;}
.a {font-size:14px;
text-align: center;}
</style>
  
  

</head>
<body>
<?php
session_start();
require_once('config.php');

$err=array();
if(isset($_SESSION['access']) && $_SESSION['access']!=0)
{
	header("location:/project2/php/access_denied.php");
}
	
	if(isset($_POST['update']))
	{
			$tid=$_SESSION['id'];
			$a=$_SESSION['imax'];
			$stdntid=$_SESSION['stdntid'];
			$scode=$_SESSION['scode'];


			for($j=1;$j<$a;$j++)
			{
				$query="update attendance_report set class_attended='".$_POST['ca'.$j]."' where stdnt_id='".$stdntid."' and tchr_id='".$tid."' and sub_code='".$scode."' and from_date='".$_POST['fd'.$j]."'";
				
				if(!(mysql_query($query)))
				die(mysql_error());
			}	
			if($j==$a)
			{
			//	session_destroy();
				$_SESSION['check']=2;
				echo 'Success';
				header("location: /project2/php/final.php");
			}
	}

	if(isset($_SESSION['stdntid']) && isset($_SESSION['scode']) && isset($_SESSION['check']) && $_SESSION['check'] == 1)
	{
		echo "Welcome, ".$_SESSION['user'].'</br></br></br>';
		echo '<center><h2>Update Attendance</h2></center><br>';
		$myroll=$_SESSION['stdntid'];
		$sub_code=$_SESSION['scode'];
		$qry=mysql_query("select stdnt_name from student where stdnt_id='".$myroll."'");
		$name=mysql_fetch_array($qry);
		echo "<br><h3>Name : ".$name['stdnt_name']."</h3>";
		echo '<form action="/project2/php/update_att2.php" method="post">';
		
		$qry_j21="select * from attendance_report where stdnt_id='$myroll' and sub_code='$sub_code'";
		$qry_j22=mysql_query($qry_j21);
		echo '<table class="tftable" border="15">';
		echo '<tr><th>FROM</th><th>TO</th><th>Total CLasses</th><th>Class attended</th><th>Update Class Attended</th></tr>';
		$i=1;
		while($qry_j23=mysql_fetch_array($qry_j22))
		{
			echo '<tr><td>'.$qry_j23['from_date'].'</td><td>'.$qry_j23['to_date'].'</td><td>'.$qry_j23['total_classes'].'</td><td>'.$qry_j23['class_attended'].'</td><td><input type="number" name="ca'.$i.'" value="'.$qry_j23['class_attended'].'"/></td></tr><br/>' ;

			echo '<input type="hidden" value="'.$qry_j23['from_date'].'" name="fd'.$i.'"/>';
			echo '<input type="hidden" value="'.$qry_j23['to_date'].'" name="td'.$i.'"/>';
			$i++;
		}
		echo '</table>';
		$_SESSION['imax']=$i;
		echo '<br/>';echo '<center><input type="submit" value="Update" name="update"></center>';
		echo '</center>'.'</form>';
	}
	else if($_SESSION['check']!=1)
	{	
	
		echo $_SESSION['check'];
		echo '<img class="ia" height="150"	 src=/project2/images/private.jpg / >'.'<br/>';
		echo '<table style="padding-left: 100px;"><tr><td>';
		echo '<h1 class="p">Access Denied.....</h1>'."</br>";
		if(isset($_SESSION['id']))
			echo '<p><a class="a" href=tchr_login_2.php> Click Here</a>to go Home</p>';
		else
			echo '<a class="a" href=tchr_login.php> Click Here</a>'." to login";
		echo '</td></tr></table>';
	}
echo '</br></br><center><a href="/project2/php/home.php">HOME</a></center>';
?>
</body>
</html>	
