<!DOCTYPE html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title>Notification</title>
  <link rel="stylesheet" href="css/style_final.css">
</head>
<body>
<?php
	session_start();
	if(!isset($_SESSION['id']))
	header("location:/project2/php/access_denied.php");
	else
	{
	if(isset($_SESSION['check']))
				$user=$_SESSION['id'];
				$access=$_SESSION['access'];
				unset($_SESSION['check']);
				$_SESSION['id']=$user;
				$_SESSION['access']=$access;
	}
?>
  <div class="container">
    <section class="notif notif-notice">
      <h6 class="notif-title">Congratulations!</h6>
      <p>Password updated successfully</p>
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
