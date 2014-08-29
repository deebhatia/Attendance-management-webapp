<?php
	session_start();
	session_destroy();
	header("location: /project2/index.php");
?>
