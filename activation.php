<?php
$hostname = "moodbox1.db.10857675.hostedresource.com";
$username = "moodbox1";
$dbname = "moodbox1";
mysql_connect($hostname, $username, "mbCorp1@");

mysql_select_db($dbname);
session_start();

if (isset($_GET['code']))
{
	$code = $_GET['code'];
	$code = mysql_real_escape_string($code);
	if(mysql_query("UPDATE users SET active='1' WHERE code='$code'") or die (mysql_error()))
	{
	echo "Your account has now been activated.";
	} else {
		echo "Error";
	}
	
}

?>