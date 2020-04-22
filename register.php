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

function emailExists($emailAddr)
{
	$sqlEmail = mysql_query("SELECT email FROM users WHERE email='$emailAddr'");
	return mysql_num_rows($sqlEmail);
}

if (isset($_POST['name']) && isset($_POST['regemail']) && isset($_POST['regpass']))
{
	if ($_POST['name'] != "" && $_POST['regemail'] != "" && $_POST['regpass'] != "")
	{
		$name = htmlentities($_POST['name']);
		$email = htmlentities($_POST['regemail']);
		$password = htmlentities($_POST['regpass']);
		
		if (emailExists($email))
		{
			header("Location: login.php?err=2");
		} else {
			if (filter_var($email, FILTER_VALIDATE_EMAIL))
			{
				// VALID EMAIL
				$nameEx = explode(" ", $name);
				
				$firstname = ucfirst($nameEx[0]);
				$lastname = ucfirst($nameEx[1]);
				
				$code = md5(rand());
				
				$password = md5($password);
				
				$to = $email;
				$subject = "Activate your account";
				$message = "<a href=\"http://moodbox.me/zelta/activation.php?code=$code\">Click here to activate your Moodbox account</a>";
				$from = "yourmum@moodbox.me";
				$headers = "From:" . $from;
				mail($to,$subject,$message,$headers);
				
				if (mysql_query("INSERT INTO users (username,firstname,lastname,password,email,active,code,date)
				VALUES ('#','$firstname','$lastname','$password','$email','0','$code',now())"))
				{
					$_SESSION['id'] = mysql_insert_id();
					
					header("Location: index.php?welcome=1");
				} else {
					echo "fuck you";
				}
				
			} else {
				header("Location: login.php?err=3");
			}
		}
		
	} else {
		header("Location: login.php?err=1");
	}
}

?>