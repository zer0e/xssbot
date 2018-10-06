<?php
require_once("db.php");
require_once("waf.php");
session_start();
if(isset($_SESSION['id']))
    header("Location:index.php");
if(isset($_POST['username']) && isset($_POST['password']))
{
    $query = "select * from user where username='".$_POST['username']."'";
    $result = $mysqli->query($query);
    if(!$result)
    {
        die("Database error!");
    }
    $row = $result->fetch_array();
    if($_POST['password'] && md5($_POST['password'].$salt) === $row['password'])
    {
        echo "<script>alert(\"login suceess!\")</script>";
        $_SESSION['id'] = $row['id'];
        $_SESSION['username'] = $row['username'];
        header("Location:index.php");
    }
    else
    {
        echo "<script>alert(\"login fail!\")</script>";
    }
}


?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>记忆留言板</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
  </head>
  <body>
	<div class="container">
	
		<div class="row">
			<div class="col">
				<div class="jumbotron">
				<h1 class="display-4">记忆留言板</h1>
				<hr class="my">
                <h3>登陆留言板:</h3>
				<form action="login.php" method="POST">
				    <p>username: <input class="form-control" name="username" id="username" type="text" placeholder="请输入用户名"></p>
                    <p>password: <input class="form-control" name="password" id="password" type="password" placeholder="请输入密码"></p>
                    <label>
                       <input type="checkbox" id="check" name="check">请打勾
                    </label>
                    <br>
                    <button class="btn btn-primary btn-lg" type="submit">登陆</button>
				</form>
				</div>
			</div>
			<div class="col-3">
				<div class="jumbotron">
                    <h4>hello <?php 
                        if(isset($_SESSION['username']))
                            echo($_SESSION['username']);
                        else
                            echo "guest";
                    ?>!</h4>
					<hr class="my">
					<font size="3">还没有账户?</font>
					<a class="btn btn-primary btn-sm" href="register.php" role="button" style="float:right">注册</a>
				</div>
				
			</div>
		</div>
	</div>
    <script src="js/jquery-3.3.1.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>