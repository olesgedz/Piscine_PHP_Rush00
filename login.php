<?php
	session_start();

	if ($_POST["submit"] == "Login" && ($_POST["login"] || $_POST["passwd"]))
	{
		if (!file_exists("./private"))
			mkdir("./private");
		if (file_exists("./private/passwd"))
		{
			$lp = unserialize(file_get_contents("./private/passwd"));
			foreach($lp as $log)
			{
				if ($log["login"] == $_POST["login"])
				{
					if ($log['passwd'] === hash('whirlpool', $_POST["passwd"]))
					{
						$_SESSION["auth_login"] = $_POST["login"];
						header('Location: ./index.php');
					}
				}
			}
		}
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Login page</title>
	<style>
		form {
			margin:0 auto;
			width:300px
		}
		input {
			margin-bottom:3px;
			padding:10px;
			width: 350px;
			border:1px solid #CCC
		}
		button {
			padding:10px
		}
		a {
			text-decoration: none;
		}
		.button {
			width: 372px;
		}

	</style>
</head>
<body>
		<form action="login.php" action="" method='post'>
			<input name="login" type="text" value="" placeholder="Username">
			<input name="passwd" type="password" value="" placeholder="Password">
			<input class="button" type="submit" name="submit" value="Login"/>
		</form>
		<form action="register.php">
				<input class="button" type="submit" value="Register page" />
		</form>
</body>
</html>
