<?php
require_once("db.php");
require_once("waf.php");
session_start();
if(isset($_SESSION['username']))
{
    echo "<script>alert(\"You have already registered.\")</script>";
    header("Refresh:0,Url=index.php");
}elseif(isset($_POST['username']) && isset($_POST['password']))
{
    $username = $_POST['username'];
    $password = $_POST['password'];
    if(strlen($username) < 4 || strlen($password) < 4)
    {
        echo "<script>alert(\"username or password too short!\")</script>";
    }
    else
    {
        $query1 = "select * from user where username='".$_POST['username']."'";
        if($mysqli->query($query1)->num_rows)
        {
            echo "<script>alert(\"There is a same username in database!\")</script>";
        }
        else
        {
            $password = md5($_POST['password'].$salt);
            $query2 = "insert into user (username, password) values ('{$username}', '{$password}')";
            $result = $mysqli->query($query2);
            if($result)
            {
                echo "<script>alert(\"register suceess!\")</script>";
                header("Refresh:0,Url=login.php");
            }
        }
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
                <h3>注册用户:</h3>
				<form action="register.php" method="POST">
				    <p>username: <input class="form-control" name="username" id="username" type="text" placeholder="请输入用户名"></p>
                    <p>password: <input class="form-control" name="password" id="password" type="password" placeholder="请输入密码"></p>
                    <label>
                       <input type="checkbox" id="check" name="check">请打勾
                    </label>
                    <br>
                    <button class="btn btn-primary btn-lg" type="submit">注册</button>
                    <label id="tips"></label>
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
                    <font size="4">已有账户?</font>
					<a class="btn btn-primary btn-sm" href="login.php" role="button" style="float:right">登陆</a>
				</div>
				
			</div>
		</div>
	</div>
    <script src="js/jquery-3.3.1.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>