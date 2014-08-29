<html>
<head>
	<script type="text/javascript">
		function Red1(){
			var con=confirm("Are you sure to update the Semester");
			if(con==false)
			window.location="/project2/home.php";
			else
			window.location="/project2/php/4.php";
		}
	</script>
</head>
<body>
	<?php
		
		echo '<script>
			Red1()
			</script>';
	?>
</body>	
</html>
