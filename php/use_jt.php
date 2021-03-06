<!DOCTYPE html>
<title> Take Attendance</title>
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
if(!isset($_SESSION['id']))
header("location: /project2/php/access_denied.php");
require_once('config.php');
$err=array();
if(isset($_SESSION['check']))
	if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['submit1']) && $_SESSION['check'] == 1)
	{
		$alert="";
		$flag=0;
		if(($_POST['from'])=="")
			$alert=$alert."From Date of Attendance is Required.\\n";
			
		if(($_POST['to'])=="")
			$alert=$alert."To Date of Attendance is Required.\\n";
		
		if(($_POST['total'])=="")
			$alert=$alert."Total Classes are Required.\\n";
			
		else if(strlen($_POST['total'])>0 && intval($_POST['total'])==0 )
			$alert=$alert."Enter the Valid No. of Total Classes.\\n";
			
		else if(intval($_POST['total'])>100 || intval($_POST['total'])<1)
			$alert=$alert."Total Classes Entered are out of range(1-100).\\n";

		if($alert!="")
		{
		echo "<script>alert('".$alert."');</script>";
		$flag=1;
		}
		if(isset($_POST['total']))
		{
			$total=$_POST['total'];			
			for($i=1;$i<$_SESSION['imax'];++$i)
			{
				if(($_POST["i".$i])=="")
				{
					$err[$i]="**required";
					$flag=1;
				}
				else if($_POST["i".$i]>$total)
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
				$query="insert into attendance_report values('$stdntid[$j]','$scode','$tid','$from','$to','".$_POST["i".$j]."','$classes','$s')";
				if(!(mysql_query($query)))
				die(mysql_error());
			}	
			if($j==$a)
			{
			
				//$_SESSION['check']=2;
				header("location: /project2/php/final.php");
			}
			}
		}
	}

	if(isset($_SESSION['check']) && $_SESSION['check'] == 1)
	{
		echo '<form action="/project2/php/use.php" method="post">';
		
		echo '<label for="from">From</label>&nbsp;&nbsp;';
		if(isset($_POST['from']))
		echo '<input type="text" id="from" value="'.$_POST['from'].'" name="from" />';
		else
		echo '<input type="text" id="from" value="" name="from" />';
		
		echo '<label for="to">&nbsp;&nbsp;To</label>&nbsp;&nbsp;';
		if(isset($_POST['to']))
		echo '<input id="to" value="'.$_POST['to'].'" type="text" name="to" />';
		else
		echo '<input id="to" value="" type="text" name="to" />';
		echo '<br/>Total Classes Taken ';
		if(isset($_POST['total']))
		echo '<input type="int" value="'.$_POST['total'].'" name="total"></input><hr/>';
		else
		echo '<input type="int" value="" name="total"></input><hr/>';
		if(!isset($_SESSION['scode']))
		{
			$my=$_POST['dropdown'];
			$_SESSION['scode']=$my;
		}
		else
		$my=$_SESSION['scode'];
		$var2="select stdnt_id,stdnt_name from student where stdnt_id in (select stdnt_id from studies where sub_code='$my')";
		$query2=mysql_query($var2);
		$stdnt=array();
		$i=1;
		echo "Take Attendance  ".'<br/>';
		echo '<table class="tftable" border="1">';
		//echo '<tr>';
		while($row2=mysql_fetch_array($query2))
		{
			echo '<tr>';
			if(isset($_POST["i".$i]))
			echo '<td>'.$row2['stdnt_id']." ".'</td><td>'.$row2['stdnt_name'].'</td>'.'<td><input  id="textbox" type="text" value= "'.$_POST["i".$i]. '" name= "i'.$i.'"/>';
			else
			echo '<td>'.$row2['stdnt_id']." ".'</td><td>'.$row2['stdnt_name'].'</td>'.'<td><input  id="textbox" type="text" value= "" name= "i'.$i.'"/></td>';
			if(isset($_POST["i".$i]))
			echo $err[$i];
			$stdnt[$i]=$row2['stdnt_id'];
			$i++;
			echo '<br/>';
		}
		echo '</table>';
		$_SESSION['imax']=$i;
		$_SESSION['stdntmax']=$stdnt;
		echo '</center>'.'<br/>';echo '<input type="submit" value="Submit" name="submit1">';
		echo '</form>';
	}
	
?>
</body>
</html>	
