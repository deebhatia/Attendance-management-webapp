<head>

<script type="text/javascript">
		function Red1(){
			var con=confirm("Are you sure to update the Semester");
			if(con==false)
			{}
			else
			window.location="/project2/456.php";
		}
</script>


<style>
    .myButton { 
        -moz-box-shadow: 0px 10px 14px -7px #276873;
        -webkit-box-shadow: 0px 10px 14px -7px #276873;
        box-shadow: 0px 10px 14px -7px #276873;
        
        background:-webkit-gradient(linear, left top, left bottom, color-stop(0.05, #599bb3), color-stop(1, #408c99));
        background:-moz-linear-gradient(top, #599bb3 5%, #408c99 100%);
        background:-webkit-linear-gradient(top, #599bb3 5%, #408c99 100%);
        background:-o-linear-gradient(top, #599bb3 5%, #408c99 100%);
        background:-ms-linear-gradient(top, #599bb3 5%, #408c99 100%);
        background:linear-gradient(to bottom, #599bb3 5%, #408c99 100%);
        filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#599bb3', endColorstr='#408c99',GradientType=0);
        background-color:#599bb3;
        -moz-border-radius:8px;
        -webkit-border-radius:8px;
        border-radius:8px;
        display:inline-block;
        color:#ffffff;
        font-family:arial;
        font-size:18px;
        font-weight:bold;
        padding:13px 32px;
        text-decoration:none;
        text-shadow:0px 1px 0px #3d768a;
	margin-left:270px;
	margin-top:15px;
    }
    .myButton:hover {
        
        background:-webkit-gradient(linear, left top, left bottom, color-stop(0.05, #408c99), color-stop(1, #599bb3));
        background:-moz-linear-gradient(top, #408c99 5%, #599bb3 100%);
        background:-webkit-linear-gradient(top, #408c99 5%, #599bb3 100%);
        background:-o-linear-gradient(top, #408c99 5%, #599bb3 100%);
        background:-ms-linear-gradient(top, #408c99 5%, #599bb3 100%);
        background:linear-gradient(to bottom, #408c99 5%, #599bb3 100%);
        filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#408c99', endColorstr='#599bb3',GradientType=0);
        
        background-color:#408c99;
    }
    .myButton:active {
        position:relative;
        top:1px;
    }
</style>
</head>
<body>
<?php
session_start();
if(!isset($_SESSION['id']))
header("location: /project2/php/access_denied.php");
	if(isset($_SESSION['id']) && $_SESSION['access']==1)
	{
		echo "Welcome, ".$_SESSION['user'].'</br>'.'</br>';
		
		echo '<a href="/project2/php/home1.php" class="myButton">Add Student</a></br></br>';
		//echo '<a href="/project2/php/home3.php" class="myButton">Remove Student</a></br></br>';
		echo '<a href="/project2/php/home5.php" class="myButton">Add Teacher</a></br></br>';
		echo '<a href="/project2/php/home7.php" class="myButton">Remove Teacher</a></br></br>';
		echo '<a href="/project2/php/update1.php" class="myButton">Update Teacher</a></br></br>';
		echo '<a href="/project2/php/123.php" class="myButton">Update Semester</a></br></br>';
		
		//echo '<a href="/project2/php/1.php" class="myButton">Decrease Semester</a></br></br>';
		
		
		
		echo '<a href="/project2/php/as.php" class="myButton">Account Settings</a></br></br>';
		echo '<a href="/project2/php/logout.php" class="myButton">LogOut</a></br></br>';
	}
	else
	{
		echo "Welcome, ".$_SESSION['user'];
		echo '</br></br></br><a href="/project2/php/test.php" class="myButton">Take Attendance</a></br></br>';
		echo '<a href="/project2/php/check_att.php" class="myButton">Check Attendance</a></br></br>';
		echo '<a href="/project2/php/update_att.php" class="myButton">Update Attendance</a></br></br>';
		echo '<a href="as.php" class="myButton">Account Settings</a></br></br>';
		echo '<a href="/project2/php/logout.php" class="myButton">Log Out</a></br></br>';
	}
?>
</body>
