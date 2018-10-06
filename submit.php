<?php
require_once("db.php");
session_start();
if(!isset($_SESSION['id']))
{
    echo "<script>alert(\"You are not logged in yet.\")</script>";
    header("Refresh:0,Url=login.php");
}
elseif(isset($_POST['content']))
{
    //$pattern = "";
    //$content = preg_replace($pattern,"",$_POST['content']);
    $username = $_SESSION['username'];
    $content = $_POST['content'];
    $query = "insert into content (username,content,isread) values ('{$username}','{$content}','0')";
    $result = $mysqli->query($query);
    if($result)
    {
        echo "<script>alert(\"you leave a message,the admin will see the message soon!\")</script>";
        header("Refresh:0,Url=index.php");
    }
    else
        echo("leave message fail! Please contact the admin!");
}

?>