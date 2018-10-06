<?php 
session_start();
require_once("db.php");
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
				<?php
					if(isset($_SESSION['id']))
					{
						print <<<EOT
							<form action="submit.php" method="POST">
							<textarea class="form-control" id="content" name="content" rows="5" style="min-width: 90%;resize:none" maxlength=100></textarea>
							<p></p>
							<button class="btn btn-primary btn-lg" type="submit">提交</button>
							</form> 
EOT;
						echo "<br>";
						$query = "select * from content where username='".$_SESSION['username']."'";
						$result = $mysqli->query($query);
						$row = $result->fetch_array();
						$content = $row['content'];
						if($row['isread'])
							$isread = "yes";
						else
							$isread = "no";
						echo "<p>你的最新一条留言：$content</p>";
						echo "<p>管理员是否查看过本条留言：$isread</p>";
					}
					else
					{
						echo "<h4>您还没有登录哦,亲!</h4>";
					}
					
					
				?>
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
					<?php 
						if(isset($_SESSION['username']))
						{
								echo "<font size='4'>切换用户?</font>";
								echo "<a class=\"btn btn-primary btn-sm\" href=\"logout.php\" role=\"button\" style=\"float:right\">退出</a>";
						}
						else
						{
							echo "<a class=\"btn btn-primary\" href=\"login.php\" role=\"button\" style=\"float:letf\">登陆</a>";
							echo "<a class=\"btn btn-primary\" href=\"register.php\" role=\"button\" style=\"float:right\">注册</a>";		
						}
					?>
				</div>
				
			</div>
		</div>
	</div>
    <script src="js/jquery-3.3.1.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>