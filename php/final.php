<!DOCTYPE html>
<!--[if lt IE 7]> <html class="lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]> <html class="lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]> <html class="lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html lang="en"> <!--<![endif]-->
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title>Notification</title>
  <link rel="stylesheet" href="css/style_final.css">
</head>
<body>
<?php
	session_start();
	echo $_SESSION['check'];
	if(!isset($_SESSION['id']) || !isset($_SESSION['check']))
	header("location:/project2/php/access_denied.php");
	else if(isset($_SESSION['check']) && $_SESSION['check']!=2)
	{
	header("location:/project2/php/access_denied.php");
	}
	else if($_SESSION['check']==2)
	{
		$username=$_SESSION['user'];
		$access=$_SESSION['access'];
		$id=$_SESSION['id'];
		session_unset();
		$_SESSION['user']=$username;
		$_SESSION['access']=$access;
		$_SESSION['id']=$id;
		$_SESSION['check']=1;
	}
?>
  <div class="container">
    <section class="notif notif-notice">
      <h6 class="notif-title">Congratulations!</h6>
      <p>Attendance Taken successfully.</p>
      
    </section>
   
  </div>

  <section class="about">
    <p class="about-links">
      <a href="/project2/php/home.php">Home</a>

    </p>
    
    </p>
  </section>
</body>
</html>
