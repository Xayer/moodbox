<?php 

$hostname = "moodbox1.db.10857675.hostedresource.com";
$username = "moodbox1";
$dbname = "moodbox1";

mysql_connect($hostname, $username, "mbCorp1@");

mysql_select_db($dbname);

session_start();

if (isset($_SESSION['id']))
{
	header("Location: index.php");
} else {
	
}

// if user hasnt entered email
if (isset($_POST["email"]) && empty($_POST["email"]))
{
	$err1 = "Please enter your email address.";
} else {
	$err1 = "";
}

// if user hasnt entered passsword
if (isset($_POST["password"]) && empty($_POST["password"]))
{
	$err2 = "Please enter your password.";
} else {
	$err2 = "";
}

if ($err1 == "" && $err2 == "")
{
	// email filtering
	$email = mysql_real_escape_string($_POST["email"]);
	$email = htmlentities($email);
	
	// password filtering
	$password = mysql_real_escape_string($_POST["password"]);
	$password = htmlentities($password);
	$password = md5($password);
	
	$sql = mysql_query("SELECT id,password FROM users WHERE email='$email' AND password='$password'");
	$login_check = mysql_num_rows($sql);
	
	if ($login_check > 0)
	{
		
		while($row = mysql_fetch_array($sql))
		{
			// get vars
			$id = $row["id"];
			$password = $row["password"];
			
			// begin session
			$_SESSION['id'] = $id;
			
			// relocate to home
			header("Location: index.php");
		}
		
	} else {
		
		if (isset($_POST["email"]))
		{
			$error = "Your email and/or password appears to be incorrect.<br /> Please try again.";
		}
	}
}

if (isset($_GET['err']))
{
	$err = preg_replace('#[^0-9]#i', '', $_GET['err']);
	
	if ($err == 1)
	{
		$errDisplay = "Please enter all information.";
	} elseif ($err == 2) {
		$errDisplay = "That email address is already in use.";
		
	} elseif ($err == 3) {
		$errDisplay = "That email address is invalid.";
		
	} elseif ($err == 4) {
		$errDisplay = "";
		
	}
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device_width; initial_scale=.5; maximum_scale=.5;" />
<title>MoodBox - Welcome</title>
<link href="css/welcome.css" rel="stylesheet" type="text/css" />
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="js/welcome.js"></script>
</head>

<body>
    <div id="wrap">
        
        <section>
        
        	<article id="welcome_note">
            
            	<h2>MoodBox</h2>
            
                
            	<h3>Welcome to MoodBox!</h3>
                
                <p>in order to access all our features,
we require you to register an
account if you haven’t got one
already. </p>
				<p>Don’t worry it’s <strong>FREE!</strong></p>

				<div id="welcome">
                    <div class="large_button">
                        <a href="#">Register</a>
                    </div>
                    
                    <div class="large_button">
                        <a href="#">Login</a>
                    </div>
                    <div class="clear"></div>
                    
                <form id="register" name="register" method="POST" action="register.php">
					<?php echo $errDisplay; ?>
                    <input type="text" placeholder="Full name" name="name"/><br /><br />
                	<input type="text" placeholder="Email" name="regemail"/><br /><br />
                   	<input type="password" placeholder="Password" name="regpass"/><br /><br />
                    <input type="submit" value="Register"/>
                </form>
                
                <form id="login" name="login" method="POST">
	               	<input type="text" placeholder="Email" name="email" /><br /><br />
                   	<input type="password" placeholder="Password" name="password" /><br /><br />
                    <input type="submit" value="Login"/>
                </form>
                
                <div class="clear"></div>
				</div>
            
            </article>
        
        </section>
        
        <footer>
        <p><?php echo mysql_result(mysql_query("SELECT COUNT(*) FROM posts"),0)?> posts has been submitted on MoodBox<p>
        <p>Copyright &copy; - MoodBox 1.2 
			<script type="text/javascript">
                var Year = new Date();
                document.write(Year.getFullYear());
            </script>
		</p>
        </footer>
    </div>
    
  <script type="text/javascript">
      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
    
      ga('create', 'UA-40924748-1', 'moodbox.me');
      ga('send', 'pageview');
  </script>
</body>
</html>