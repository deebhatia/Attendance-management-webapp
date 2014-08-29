<html>
<head>
<title>Teacher Login..</title>
<link rel="stylesheet" type="text/css" href="/project2/css/style1.css" />
</head>
<body>

<form action="/project2/php/tchr_chk_login.php"method="post" autocomplete="off">
<table class="table1" align="center">
	<tr><td width="95%"><h2 class="h2" align="center">Teacher login</h2></td></tr>
</table>
<table class="table" action="/project2/php/tchr_chk_login.php" align="center">
                  
        <tr>
            <td> <input type="text" name="username" size="20" placeholder="Enter User Name"></td>
        </tr>
             
        <tr>
            <td><input type="password" name="password" size="20"placeholder="Enter Password"></td>
        </tr>
        <tr>
             <td><input class="myButton1" type="submit" value="Log In" </td>
             <td><input class="myButton1" type="reset" value="Reset"> </td>
        </tr>
 </table>
 <?php
		if(isset($_GET['error']))	
		{
			if($_GET['error']==1)
			echo "invalid username";
			else if($_GET['error']==2)
			echo "invalid password";
			else
			echo "<p class=\"p\" align=\"center\">**Wrong username and password\n</p>";
		}
	?> 
</form>

</div>
</body>
</html>
