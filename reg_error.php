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
		$lp[] = array (
			"login" => $_POST["login"],
			"passwd" => hash('whirlpool', $_POST["passwd"]));
		file_put_contents("./private/passwd", serialize($lp));
		header('Location: ./login.php');
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Brainfuck - Register page</title>
	<link rel="shortcut icon" href="https://www.flaticon.com/premium-icon/icons/svg/287/287371.svg" />
	<style>
		* {
			padding: 0;
			margin: 0;
			box-sizing: border-box;
			outline: none;
		}
		a {
			text-decoration: none;
			color: black;
			font-family: Proxima Nova,Tahoma,Serif,Arial;
		}
		.header{
			display: flex;
			flex-direction: row;
			height: 100px;
			justify-content: space-between;
			border-bottom: 1px solid #e1e1e1;
		}
		.cla{
			width: 24px;
			position: right;
			margin: 4px;
		}
		.buttons{
			display: flex;
			flex-direction: row;
			width: 200px;
			justify-content: space-between;
			margin: 4px;
			margin-right: 50px;
			font-family: Proxima Nova,Tahoma,Serif,Arial;
		}
		.brainfuck{
			margin-top: 30px;
			font-size: 60px;
			text-decoration: none;
			font-family: Proxima Nova,Tahoma,Serif,Arial;
			text-shadow: 2px 2px 2px gray;
		}
		.choose{
			display: flex;
			flex-direction: row;
			width: 1000px;
			justify-content: space-between;
		}
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
		::placeholder{
			color: red;
		}
	</style>
</head>
<body>
		<div class="header">
			<div class="choose">
				<div class="brainfuck"><a href="index.php">Brainfuck</a></div>
			</div>

			<div class="buttons">
				<div class="shoppingcart cla"><img src="https://image.flaticon.com/icons/svg/126/126515.svg"></div>
				<?php
					if ($_SESSION["auth_login"])
					{
				?>
						<div class="accountsettings cla"><a href="profile.php" title="Profile"><img src="https://image.flaticon.com/icons/svg/126/126486.svg"></a></div>
						<div class="cla"><?=$_SESSION["auth_login"]?></div>
						<div class="cla"><a href="logout.php" title="Logout"><img src="https://image.flaticon.com/icons/svg/126/126467.svg"></a></div>
				<?php
					}
					else
					{
				?>
						<div class="accountsettings cla"><a href="login.php"><img src="https://image.flaticon.com/icons/svg/126/126486.svg"></a></div>
						<div class="cla"><a href="login.php">Login</a></div>
				<?php
					}
				?>
			</div>
		</div>
		<form action="register.php" action="" method='post'>
			<input name="login" type="text" value="" placeholder="This username already exist" required>
			<input name="passwd" type="password" value="" placeholder="Password" required>
			<input class="button" type="submit" name="submit" value="Register"/>
		</form>
		<form action="login.php">
				<input class="button" type="submit" value="Login page" />
		</form>
</body>
</html>
