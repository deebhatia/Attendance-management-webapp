<!DOCTYPE html>
<title> Display info</title>
<head>
<!--<link rel="stylesheet" type="text/css" href="test_css.css" />-->

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
	require_once('config2.php');
		$a=$_POST['semester'];
		$b=$_POST['stdntid'];
		echo '<table class="tftable" border="1">';
		echo '<tr>';
		echo '<th>Subject</td>';
		echo '<th>From</td>';
		echo '<th>To</td>';
		echo '<th>Class Attended</td>';
		echo '<th>Total Classes</td>';
		echo '<th>Percentage</td>';
		echo '</tr>';
		$query=mysql_query("select sub_code,from_date,to_date,class_attended,total_classes from attendance_report where stdnt_id='$b' and semester=$a");
		$sum=0;
		$sum2=0;
		while($row=mysql_fetch_array($query))
		{
			echo '<tr>';
			$c=$row['sub_code'];
			$query1=mysql_query("select sub_name from subjects where sub_code='$c'");
			while($row1=mysql_fetch_array($query1))
			echo '<td>'.$row1['sub_name'].'</td>';	
			echo '<td>'.$row['from_date'].'</td>';
			echo '<td>'.$row['to_date'].'</td>';
			echo '<td>'.$row['class_attended'].'</td>';
			$sum+=$row['class_attended'];
			echo '<td>'.$row['total_classes'].'</td>';
			$sum2+=$row['total_classes'];
			echo '<td>'.round((($row['class_attended']*100)/$row['total_classes']),2).'%</td>';
			echo '</tr>';
		
		}	
		echo '</table>';
		echo "<p class=\"a\">Total class attended : $sum".'<br/>';
		echo "Total classes Taken  : $sum2".'<br/>';
		echo "Attendace : ".round((($sum/$sum2)*100),2)."%";	

	?>
</body>
</html>
