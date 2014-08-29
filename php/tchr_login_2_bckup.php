<!DOCTYPE html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title>Teacher Login</title>
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="/project2/css/stud.css">
</head>
<body>
  <form action="/project2/php/tchr_chk_login.php" class="contact" method="post">
    <fieldset class="contact-inner">
      <p class="contact-input">
        <input type="text" name="username" placeholder="UserName" autofocus>
      </p>


	<p class="contact-input">
        <input type="password" name="password" placeholder="Password" autofocus>
      </p>

      

      <p class="contact-submit">
        <input type="submit"  value="Log In">
      </p>
      
      
      <p class="contact-submit">
        <input type="reset" value="Reset">
      </p>
      
      
    </fieldset>
  </form>
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
  
  
  
  

  <section class="about">
    <p class="about-links">
      <a href="/project2/index.php">Home</a>
    </p>
    <p class="about-author">
      &copy; 2013 <a href="#">JITIN</a> -
      <a href="#">DEEPANSHU </a><br>
      <a href="#">DHIRAJ </a><br>
      
    </p>
  </section>
</body>
</html>
