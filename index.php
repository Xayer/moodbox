<?php 

$hostname = "moodbox1.db.10857675.hostedresource.com";
$username = "moodbox1";
$dbname = "moodbox1";

mysql_connect($hostname, $username, "mbCorp1@");

mysql_select_db($dbname);

session_start();

$id = $_SESSION['id'];
$id = mysql_real_escape_string($id);

if (isset($_SESSION['id'])) {
	$header =
			'<nav id="navigation">
			<ul>
			
				<li><img id="header_compose" src="images/icons/post.png" /><div id="status"></li>
				  
				  <li><a href="logout.php"><img id="header_logout" src="images/icons/logout.png" /></a></li>
			</ul>
			
			<div class="clear"></div>
			
			<form name="status-form" id="status-box" method="POST">
						<legend>Submit Mood</legend>
					  <textarea id="mood" rows="3" cols="34" name="post" required="required"></textarea>
					  
					  <select name="mood">
						 <option value="happy">Happy</option>
						 <option value="sad">Sad</option>
						 <option value="confused">Confused</option>
						 <option value="exicited">Exicited</option>
						 <option value="cute">Cute</option>
					  </select>
					  
					  <input id="submit" type="submit" value="Post" name="status-submit">
					</form>
			</nav>';
}

else {

	$header ='
			<div id="welcome">
				<a href="login.php">
					<div class="large_button" style="color:white; font-weight:900">
						Register
					</div>
				</a>
				
				<a href="login.php">
					<div class="large_button" style="color:white; font-weight:900">
						Login
					</div>
				</a>
				
				<div class="clear"></div>
			</div>';

}

if (isset($_POST['post']))
{
	$post = htmlentities($_POST['post']);
	$mood = htmlentities($_POST['mood']);
	
	$agent = $_SERVER['HTTP_USER_AGENT'];
	if (preg_match("/iPhone/", $agent)) {
		$browser = "iPhone";
	} else if (preg_match("/Android/", $agent)) {
		$browser = "Android";
	} else if (preg_match("/IEMobile/", $agent)) {
		$browser = "Windows M";
	} else if (preg_match("/Chrome/", $agent)) {
		$browser = "Chrome";
	} else if (preg_match("/MSIE/", $agent)) {
		$browser = "Explorer";
	} else if (preg_match("/Firefox/", $agent)) {
		$browser = "Firefox";
	} else if (preg_match("/Safari/", $agent)) {
		$browser = "Safari";
	} else if (preg_match("/Opera/", $agent)) {
		$browser = "Opera";
	}
	
	if ($browser == "iPhone")
	{
		$device = "i";
	} elseif($browser == "Android") {
		$device = "a";
	} else {
		$device = "0";
	}
	
	if ($post == ""){ echo "please enter a mood"; }
	
	else { mysql_query("INSERT INTO posts (author, status, mood, date, device) VALUES ('$id', '$post', '$mood', now(), '$device')");}
	header('Location: index.php');
}

$res = mysql_query("SELECT id, author, status, mood, date, device FROM posts ORDER BY date DESC LIMIT 15");
while ($row = mysql_fetch_array($res))
{
	$moodId = $row['id'];
	$mood = $row['mood'];
	$status = $row['status'];
	$userPostId = $row['author'];
	$date = $row['date'];
	$device = $row['device'];
	
	$sqlGetUserInfo = mysql_query("SELECT id,firstname,lastname FROM users WHERE id='$userPostId' LIMIT 1");
	while ($row = mysql_fetch_array($sqlGetUserInfo))
	{
		$firstname = $row['firstname'];
		$lastname = $row['lastname'];
		
		$author = "$firstname $lastname";
	}
	
	if ($device == "0")
	{
		$device = "";
	}
	
	if ($device == "i")
	{
		$device = '<abbr title="Sent from iPhone"><img src="images/devices/iphone.png" id="postDevice" /></abbr>';
	}
	
	if ($device == "a")
	{
		$device = '<abbr title="Sent from Andriod"><img src="images/devices/droid.png" id="postDevice" /></abbr>';
	}
	
	if ($id == $userPostId)
	{
		$options = '
		<a class="options"">Reply</a>
		<a class="options"">Edit</a>
		<a class="options" href="includes/delete.php?id=' . $moodId . '">Delete</a>';
	} else {
		$options = '
		<a class="options"">Reply</a>
		<a class="options"">Repost</a>
		<a class="options"">Flag</a>';
	}
	
	$posts .= '
		
		<div class="post">
			
			<div class="post_header"><img src="images/smiley/' . $mood . '.png" />
			<strong>' . $device . ' <a href="#">' . $author . '</a></strong></div>
			
			<p>' . $status . '</p>
			
			<span class="date">' . $date . '</span>
			<div class="clear"></div>
			<span>' . $options . '</span>
			
			<div class="clear"></div>
			
		</div>
	';
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device_width; initial_scale=.75; maximum_scale=.75;" />
<title>MoodBox - Welcome</title>
<link href="css/welcome.css" rel="stylesheet" type="text/css" />
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="js/welcome.js"></script>
</head>

<body>
    <div id="wrap">
    
        <header id="header">
        
            <div id="logo">
            	<img src="images/logo.png"  />
            </div>
            
            <?php echo $header; ?>
        
        </header>
        
        <section id="posts">
        
			<?php echo $posts; ?>
        
        </section>
        
        <footer>
        <p><?php echo mysql_result(mysql_query("SELECT COUNT(*) FROM posts"),0)?> posts has been submitted<p>
        <p>© Copyright - MoodBox 1.2 <script type="text/javascript">
                var Year = new Date();
                document.write(Year.getFullYear());
            </script></p>
        </footer>
    </div>
    
    <script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-40924748-1', 'moodbox.me');
  ga('send', 'pageview');

</script>
</body>
</html>
