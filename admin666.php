<?php
//取出一条isread为0的未读消息，将content放在网页上，并update isread
require_once("db.php");
error_reporting(0);
if(!isset($_COOKIE['key']) && $_COOKIE['key'] !== "admin123!@#")
{
   die("you are not admin!");
}
    
$query1 = "select * from content where isread = '0' limit 1";
$result = $mysqli->query($query1);
if($result->num_rows == 0)
{
    die("no message unread.");
}
else
{
    $row = $result->fetch_array();
    $contentid = $row['contentid'];
    $content = $row['content'];
    echo($content);
    $query2 = "update content set isread = 1 where contentid ='".$contentid."'";
    $mysqli->query($query2);
}
?>