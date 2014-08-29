<!DOCTYPE html>
<title> Checking page</title>
<head>
<script>
function check(){

}
</script>
</head>
<body>
<?php
	session_start();
	require_once('config2.php');
	include('cal2.php');
?>
<?php
	echo '<form action="use2.php" method="post">';
	
	echo '<label for="from">From</label>';
	echo '<input type="text" id="from" name="from" />';
	echo '<label for="to">To</label>';
	echo '<input id="to" type="text" name="to" />';
	echo '<br/>Total Classes Taken <input type="text" value="10" name="total"></input><hr/>';
	
	echo "Take Attendance  ".'<br/>';
	$my=$_POST['dropdown'];
	$var2="select stdnt_id,stdnt_name from student where stdnt_id in (select stdnt_id from studies where sub_code='$my')";
	$query2=mysql_query($var2);
	$stdnt=array();
	$i=1;
	while($row2=mysql_fetch_array($query2))
	{
		echo $row2['stdnt_id']."".$row2['stdnt_name'].'<input  id="textbox" type="text" name="'.$i.'"></input></br><span class="error" hidden="hidden"></span>';
		$i++;
	}
	$_SESSION['imax']=$i;
	echo '</center>'.'<br/>';
	echo '<input type="submit" value="Submit" name="submit">';
	echo '</form>';
	?>
	
</body>
</html>	
