<head>

	<script>
		function call(){
			alert("Semester updated Successfully");
			window.location="/project2/php/home.php";
		}
	</script>


</head>
<body>
	<?php
	require_once('config5.php');
	$qry="update student set semester=semester-1";	
	mysql_query($qry);	
		echo '<script>
			call()
			</script>';
	?>
	
<body>		
