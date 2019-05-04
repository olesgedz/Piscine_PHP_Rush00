<?php
	session_start();

	if ($_POST["submit"] === "Change" && ($_POST["email"] && $_POST["passwd"]))
	{
		$lp = unserialize(file_get_contents("./private/passwd"));
		foreach($lp as $log)
		{
			if ($log["login"] == $_SESSION["auth_login"])
			{
				if ($log['passwd'] === hash('whirlpool', $_POST["passwd"]))
				{
					$log[$_SESSION["login"]] = array ("email" => $_POST["email"]);
					file_put_contents("./private/passwd", serialize($lp));
					$_SESSION["auth_email"] = $_POST["email"];
					header('Location: ./profile.php');
					exit();
				}
			}
		}
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Brainfuck - Change e-mail</title>
	<link rel="shortcut icon" href="https://www.flaticon.com/premium-icon/icons/svg/287/287371.svg" />
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
		<form action="change_email.php" method='post'>
			<input name="email" type="email" value="" placeholder="New e-mail" required>
			<input name="passwd" type="password" value="" placeholder="Password" required>
			<input class="button" type="submit" name="submit" value="Change"/>
		</form>
</body>
</html>
