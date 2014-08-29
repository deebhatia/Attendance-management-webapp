<head>
<title>Update Account Settings</title>

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
<h3><center>Update Account Settings</center></h3><br/>
<?php
	session_start();
	if(!isset($_SESSION['id']))
	header("location:/project2/php/access_denied.php");
	else
	{	
		require_once('config.php');
		if(isset($_POST['submit']))
		{
			$flag=0;
			$err=array();
			if(($_POST['npass'])=="")
			{
				$err['npass']="**required";
				$flag=1;
			
			}
			else if(strlen($_POST['npass'])<7)
			{
				$err['npass']="**minimum length 6 required";
				$flag=1;
			}
			else if($_POST['npass']!=$_POST['cnpass'])
			{
				$err['cnpass']="**password not matches with new password";
			}
			if(($_POST['cnpass'])=="")
			{
				$err['cnpass']="**required";
				$flag=1;
			}
			if(($_POST['opass'])=="")
			{
				$err['opass']="**required";
				$flag=1;
			}			
			if($flag==0)
			{
				
				
				
				$tchrid=$_SESSION['id'];
				$qry="select password from teacher where tchr_id='".$tchrid."'";
				$cngpass=mysql_query($qry);
				if(mysql_num_rows($cngpass)==1)
				{
					$row=mysql_fetch_array($cngpass);
					if($row['password']==hash("sha512",$_POST['opass']))
					{
	//$qry1="update teacher set password='".$_POST['npass']."' , tchr_name='".$_POST['username']."' where tchr_id='".$tchrid."'";
	$var_pass=hash("sha512",$_POST['npass']);
	$qry1="update teacher set password='".$var_pass."' , tchr_name='".$_POST['username']."' where tchr_id='".$tchrid."'";
						mysql_query($qry1);
						header("location: /project2/php/final_as.php");
					}
					else
					{
						$err['opass']="Password is Wrong";
						$flag=1;
					}
				}
			}
		}
		
			
		$tchrid=$_SESSION['id'];
		$user=$_SESSION['id'];
		$access=$_SESSION['access'];
		$query="select password from teacher where tchrid='".$tchrid."'";
		$password=mysql_query($query);
		if($user)
		{
			$qry2="select tchr_name from teacher where tchr_id='".$tchrid."'";
			$username=mysql_query($qry2);
			$rows=mysql_fetch_array($username);			
			$un=$rows['tchr_name'];
			echo '<table class="tftable" border="15">';
			//echo '<tr>';
			echo '<form action="as.php" method="POST">';
			echo '<tr><td>Username </td><td><input type="text" id="username" name="username" value="'.$un.'" /></td></tr>';
			echo '<tr><td>Enter current password</td><td><input type="password" id="opass" name="opass">';
			if(isset($_POST['opass']))
			echo $err['opass'].'</td></tr>';			
			echo '<tr><td>New Password</td><td><input type="password" id="npass" name="npass">';	
			if(isset($_POST['npass']))
			echo $err['npass'].'</td></tr>';		
			echo '<tr><td>Confirm New Password</td><td><input type="password" id="cnpass" name="cnpass">';
			if(isset($_POST['cnpass']))
			echo $err['cnpass'].'</td></tr>';
			echo '</table>';
			echo '<input type="submit" id="submit" name="submit" value="Submit">';				
				
		}
	}
	echo '</br></br><center><a href="/project2/php/home.php">HOME</a></center>';
?>
</body>
