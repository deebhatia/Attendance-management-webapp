<head>
	<title>Student Details</title>
	<link rel="stylesheet" href="/project2/css/stud.css">
	
</head>
<body>
<div id="wrapper">

	<form name="login-form" class="login-form" action="/project2/php/home2.php" method="post">
	
		<div class="header">
		<h1> Student Details</h1>
		
		</div>
	
		<div class="content">
		<input name="TeacherID" type="text" class="input stdnt_id" placeholder="TeacherID" />
		<div class="user-icon"></div>
		<input name="TeacherName" type="text" class="input stdnt_name" placeholder="TeacherName" />
		<div class="user-icon"></div>
		<input name="Password" type="text" class="input enroll_no" placeholder="Password" />
		<div class="user-icon"></div>
		</div>

		<div class="footer">
		<input type="submit" name="submit" value="Insert" class="button" />
		<input type="reset" name="reset" value="Reset" class="button" />

		</div>
	
	</form>

</div>
<div class="gradient"></div>
</body>
