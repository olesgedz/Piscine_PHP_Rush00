<?php
	session_start();

	if ($_POST["submit"] == "Register" && ($_POST["login"] || $_POST["passwd"]))
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
					header('Location: ./reg_error.php');
					exit();
				}
			}
		}
		$lp[$_POST["login"]] = array (
			"login" => $_POST["login"],
			"passwd" => hash('whirlpool', $_POST["passwd"]),
			"address" => $_POST["address"],
			"email" => $_POST["email"],
			"phone" => $_POST["phone"]

		);
		file_put_contents("./private/passwd", serialize($lp));
		$_SESSION["auth_login"] = $_POST["login"];
		$_SESSION["auth_address"] = $_POST["address"];
		$_SESSION["auth_email"] = $_POST["email"];
		$_SESSION["auth_phone"] = $_POST["phone"];
		header('Location: ./index.php');
		exit();
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Brainfuck - Register page</title>
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
		<form action="register.php" method='post'>
			<input name="login" type="text" value="" placeholder="Username" required>
			<input name="passwd" type="password" value="" placeholder="Password" required>
			<input name="address" type="text" value="" placeholder="Address" required>
			<input name="email" type="email" value="" placeholder="E-mail" required>
			<input name="phone" type="tel" value="" placeholder="Phone number" required>
			<input class="button" type="submit" name="submit" value="Register"/>
		</form>
		<form action="login.php">
				<input class="button" type="submit" value="Login page" />
		</form>
</body>
</html>
