<head>
	<title>Teacher Login</title>
	<link rel="stylesheet" href="/project2/css/stud.css">
</head>
<body>
<div id="wrapper">

	<form name="login-form" class="login-form" action="/project2/php/tchr_chk_login.php" method="post">
	
		<div class="header">
		<h1>Teacher Login</h1>
		
		</div>
	
		<div class="content">
		<input name="username" type="text" class="input username" placeholder="Username" />
		<div class="user-icon"></div>
		<input name="password" type="text" class="input password" placeholder="password" />
		<div class="pass-icon"></div>		
		</div>

		<div class="footer">
		<input type="submit" name="submit" value="Log In" class="button" />
		<input type="reset" name="reset" value="Reset" class="button" />

		</div>
	
	</form>

</div>
<div class="gradient"></div>
</body>
