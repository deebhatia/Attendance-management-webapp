<!DOCTYPE html>
<title> Checking page</title>
<head>
<link rel="stylesheet" type="text/css" href="/project2/css/test_css.css" />	
  <meta charset="utf-8" />
  <title>jQuery UI Datepicker - Select a Date Range</title>
  <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
  <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
  <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
  <link rel="stylesheet" href="/resources/demos/style.css" />
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
      numberOfMonths: 1,
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

if($_SERVER['REQUEST_METHOD']=='POST' && $_SESSION['check'] == 1)
{
		
		if(isset($_POST['total']))
		$total=$_POST['total'];			
		$flag=0;
		for($i=1;$i<$_SESSION['imax'];++$i)
		{
			if($_POST['i'.$i]>$total)
			{
				$err[$i]="** invalid";
				$flag=1;
			}
			else
			{
				$err[$i]="";		
			}
		}
		if($flag==0)
		{
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
			for($j=1;$j<$a;$j++)
			{
				$query="insert into attendance_report values('$stdntid[$j]','$scode','$tid','$from','$to','".$_POST['i'.$j]."','$classes','$s')";
				if(!(mysql_query($query)))
				die(mysql_error());
			}	
			if($j==$a)
			{
				session_destroy();
				header("location: /project2/php/final.php");
			}
		}
}
	if($_SESSION['check'] == 1)
	{
		echo '<form action="/project2/php/use.php" method="post">';
		echo '<label for="from">From</label>';
		echo '<input type="text" id="from" value="'.$_POST['from'].'" name="from" />';
		echo '<label for="to">To</label>';
		echo '<input id="to" value="'.$_POST['to'].'" type="text" name="to" />';
		echo '<input id="drop" type="hidden" name="dropdown" value="'.$_REQUEST['dropdown'].'"/>';
		echo '<br/>Total Classes Taken <input type="int" value="'.$_POST['total'].'" name="total"></input><hr/>';
		echo "Take Attendance  ".'<br/>';
		$my=$_REQUEST['dropdown'];
		$_SESSION['scode']=$my;
		$var2="select stdnt_id,stdnt_name from student where stdnt_id in (select stdnt_id from studies where sub_code='$my')";
		$query2=mysql_query($var2);
		$stdnt=array();
		$i=1;
		while($row2=mysql_fetch_array($query2))
		{
			echo $row2['stdnt_id']." ".$row2['stdnt_name'].'<input  id="textbox" type="text" value= "'.$_POST["i".$i]. '" name= "i'.$i.'"/>';
			echo $err[$i];
			$stdnt[$i]=$row2['stdnt_id'];
			$i++;
			echo '<br/>';
		}
		$_SESSION['imax']=$i;
		$_SESSION['stdntmax']=$stdnt;
		echo '</center>'.'<br/>';echo '<input type="submit" value="Submit" name="submit">';
		echo '</form>';
	}
	else
	{
		echo '<img class="ia" height="150"  src="/project2/images/ad.jpeg" / >'.'<br/>';
		echo '<table style="padding-left: 100px;"><tr><td>';
		echo '<h1 class="p">Access Denied.....</h1>'."</br>";
		echo '<a class="a" href=/project2/index.php> Click Here</a>'." to login";
		echo '</td></tr></table>';
	}
?>
</body>
</html>	
