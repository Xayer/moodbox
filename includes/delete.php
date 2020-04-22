<?php

$hostname = "moodbox1.db.10857675.hostedresource.com";
$username = "moodbox1";
$dbname = "moodbox1";

mysql_connect($hostname, $username, "mbCorp1@");

mysql_select_db($dbname);

session_start();

$id = $_SESSION['id'];
$id = mysql_real_escape_string($id);

$postId = $_GET['id'];

$sqlGetPosts = mysql_query("SELECT id,author FROM posts WHERE id=$postId LIMIT 1");
while ($row = mysql_fetch_array($sqlGetPosts))
{
    $author = $row['author'];
}

if ($author == $id)
{
    mysql_query("DELETE FROM posts WHERE id=$postId");
    
    header("Location: ../index.php");
} else {
    
    echo "fuck off hacker";
}

?>