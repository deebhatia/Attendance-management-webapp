<head>
	<title>Student Details</title>
	<link rel="stylesheet" href="/project2/css/stud.css">
</head>
<body>
<div id="wrapper">

	<form name="login-form" class="login-form" action="/project2/php/home4.php" method="post">
	
		<div class="header">
		<h1>Remove the Student </h1>
		
		</div>
	
		<div class="content">
		<input name="StudentID" type="text" class="input stdnt_id" placeholder="StudentID" />
		<div class="user-icon"></div>
		<input name="StudentName" type="text" class="input stdnt_name" placeholder="StudentName" />
		<div class="user-icon"></div>
		<input name="EnrollmentNo" type="text" class="input enroll_no" placeholder="EnrollmentNo" />
		<div class="user-icon"></div>
		<input name="Semester" type="text" class="input semester" placeholder="Semester" />
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
