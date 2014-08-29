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
if (!isset($_SESSION))
{
	session_start();
}
require_once('config.php');
$err=array();
if(isset($_SESSION['access']) && $_SESSION['access']!=0)
{
	header("location:/project2/php/access_denied.php");
}
if(!isset($_POST['dropdown']))
{
header("location:/project2/php/access_denied.php");
}
if(isset($_SESSION['check']))
	if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['submit1']) && $_SESSION['check'] == 1)
	{
		$alert="";
		$flag=0;
		if(($_POST['from'])=="")
			$alert=$alert."From Date of Attendance is Required.\\n";
			
		if(($_POST['to'])=="")
			$alert=$alert."To Date of Attendance is Required.\\n";
		else
		{
			$cur_date=date("m/d/Y");
			if($_POST['to'] > $cur_date)
			$alert=$alert."Future dates are Entered.\\n";
		}
		
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
		else
		{
			$from=$_POST['from'];
			$from1=explode('/',$from);
			$from=$from1[2]."-".$from1[0]."-".$from1[1];
			$query="select count(*) as cnt from attendance_report where sub_code='".$_SESSION['scode']."' and to_date >= '".$from."';";
			$result=mysql_query($query);
			
			$cnt=mysql_fetch_array($result);
			if( $cnt['cnt']> 0 )
			{
				echo '<script>alert("Entries Exist in the Database with the selected range of dates.\nCheck Again the Entered Dates");</script>';
				$flag=1;
			}
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
			
				$_SESSION['check']=2;
				header("location: /project2/php/final.php");
			}
			}
		}
	}

	if(isset($_SESSION['check']) && $_SESSION['check'] == 1)
	{
		echo "Welcome, ".$_SESSION['user'].'</br></br></br>';
		echo '<form action="/project2/php/use.php" method="post">';
		
		echo '<label for="from">From</label>';
		if(isset($_POST['from']))
		echo '<input type="text" id="from" value="'.$_POST['from'].'" name="from" />';
		else
		echo '<input type="text" id="from" value="" name="from" />';
		echo '<input type="hidden" id="dropdown" value="'.$_POST['dropdown'].'" name="dropdown" />';
		echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
		echo '<label for="to">To</label>';
		if(isset($_POST['to']))
		echo '<input id="to" value="'.$_POST['to'].'" type="text" name="to" />';
		else
		echo '<input id="to" value="" type="text" name="to" />';
				
		echo '<br/><font-size="12px">Total Classes Taken ';
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
//		echo '<table>';
		//	echo '<tr>';
		echo '<table class="tftable" border="15">';
echo '<tr>';
		echo '<th>Roll No.</td>';
		echo '<th>Name</td>';
		
		echo '<th>Class Attended</td>';
		
		
		echo '</tr>';
		while($row2=mysql_fetch_array($query2))
		{
			if(isset($_POST["i".$i]))
			echo '<td>'.$row2['stdnt_id']." ".'</td><td>'.$row2['stdnt_name'].'</td>'.'<td><input  id="textbox" type="text" value= "'.$_POST["i".$i]. '" name= "i'.$i.'"/>';
			else
			echo '<td>'.$row2['stdnt_id']." ".'</td><td>'.$row2['stdnt_name'].'</td>'.'<td><input  id="textbox" type="text" value= "" name= "i'.$i.'"/></td>';
			if(isset($_POST["i".$i]))
			echo $err[$i].'</td>';
			$stdnt[$i]=$row2['stdnt_id'];
			$i++;
			echo '</tr>';
			echo '<br/>';
		}
		echo '</table>';
		$_SESSION['imax']=$i;
		$_SESSION['stdntmax']=$stdnt;
		echo '</center>'.'<br/>';echo '<input type="submit" value="Submit" name="submit1">';
		echo '</form>';
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
