<?php
	session_start();

	if ($_POST["submit"] == "DeleteUser")
		delUser($_POST["user"]);
	else if ($_POST["submit"] == "MakeAdmin")
		makeAdmin($_POST["user"]);
	else if ($_POST["submit"] == "MakeUser")
		makeUser($_POST["user"]);

	function delUser($user)
	{
		$lp = unserialize(file_get_contents("./private/passwd"));
		foreach($lp as &$log)
		{
			// print_r($lp);

			if ($log["login"] == $user)
			{
				unset($lp[$user]);
				file_put_contents("./private/passwd", serialize($lp));
				header('Location: ./profile.php');
			}
		}
	}
	function makeAdmin($user)
	{
		$lp = unserialize(file_get_contents("./private/passwd"));
		foreach($lp as &$log)
		{
			// print_r($lp);

			if ($log["login"] == $user)
			{
				$log["status"] = "admin";
				file_put_contents("./private/passwd", serialize($lp));
				$_SESSION["auth_status"] = "admin";
				unset($log);
				header('Location: ./profile.php');
				exit();
			}
		}
	}
	function makeUser($user)
	{
		$lp = unserialize(file_get_contents("./private/passwd"));
		foreach($lp as &$log)
		{
			if ($log["login"] == $user)
			{
				$log["status"] = "user";
				file_put_contents("./private/passwd", serialize($lp));
				$_SESSION["auth_status"] = "admin";
				unset($log);
				header('Location: ./profile.php');
				exit();
			}
		}
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Brainfuck - Profile</title>
	<link rel="shortcut icon" href="https://www.flaticon.com/premium-icon/icons/svg/287/287371.svg" />
	<link rel="stylesheet" type="text/css" href="style/style.css">
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
	<div class="home">
		<div class="centre_profile">
			<?php
			if ($_SESSION["auth_status"] == "admin")
			{
				?>
			<div class="userprofile usern">Username: <?=$_SESSION["auth_login"]?></div>
			<div class="userprofile st_admin"><?=$_SESSION["auth_status"]?></div>
			<table class="table">
				<tr>
					<td >
						<div class="userprofile">E-mail: <?=$_SESSION["auth_email"]?></div>
					</td>
					<td>
						<form action="change_email.php">
							<input class="buttonchange" type="submit" value="Change email" />
						</form>
					</td>
				</tr>
				<tr>
					<td>
						<div class="userprofile">Phone number: <?=$_SESSION["auth_phone"]?></div>
					</td>
					<td>
						<form action="change_number.php">
							<input class="buttonchange" type="submit" value="Change phone number" />
						</form>
					</td>
				</tr>
				<tr>
					<td>
						<div class="userprofile">Address: <?=$_SESSION["auth_address"]?></div>
					</td>
					<td>
						<form action="change_address.php">
							<input class="buttonchange" type="submit" value="Change address" />
						</form>
					</td>
				</tr>
				</table>
				<div class="userprofile">
					<form action="change_passwd.php">
						<input class="buttonchange" type="submit" value="Change password" />
					</form>
				</div>
				<div class="userprofile">
					<form action="delete_user.php">
						<input class="buttondelete" type="submit" value="Delete account" />
					</form>
				</div>
				<hr>
				<div class="userprofile st_admin">Users edit</div>
				<hr>
				<div class="admusers">
					<?php
						$lp = unserialize(file_get_contents("./private/passwd"));
						foreach($lp as $log)
						{
							if ($log["login"] !== $_SESSION["auth_login"] && $log["login"] !== "admin"){
					?>
						<div class="users">
							<div>Username: <?=$log["login"]?></div>
							<div>E-mail: <?=$log["email"]?></div>
							<div>Phone: <?=$log["phone"]?></div>
							<div>Address: <?=$log["address"]?></div>
							<div>Status: <?=$log["status"]?></div>

							<form action="profile.php" method="post">
								<input type="hidden" name="user" value="<?=$log["login"]?>"/>
								<input class="buttonadm" name="submit" type="submit" value="DeleteUser" />
								<input class="buttonadm" name="submit" type="submit" value="MakeAdmin" />
								<input class="buttonadm" name="submit" type="submit" value="MakeUser" />
							</form>

							<hr>
						</div>

					<?php
						}
					}
						?>
				</div>
			</div>

				<?php
			}
			else
			{
			?>
			<div class="userprofile usern">Username: <?=$_SESSION["auth_login"]?></div>
			<table class="table">
				<tr>
					<td >
						<div class="userprofile">E-mail: <?=$_SESSION["auth_email"]?></div>
					</td>
					<td>
						<form action="change_email.php">
							<input class="buttonchange" type="submit" value="Change email" />
						</form>
					</td>
				</tr>
				<tr>
					<td>
						<div class="userprofile">Phone number: <?=$_SESSION["auth_phone"]?></div>
					</td>
					<td>
						<form action="change_number.php">
							<input class="buttonchange" type="submit" value="Change phone number" />
						</form>
					</td>
				</tr>
				<tr>
					<td>
						<div class="userprofile">Address: <?=$_SESSION["auth_address"]?></div>
					</td>
					<td>
						<form action="change_address.php">
							<input class="buttonchange" type="submit" value="Change address" />
						</form>
					</td>
				</tr>
				</table>
				<div class="userprofile">
					<form action="change_passwd.php">
						<input class="buttonchange" type="submit" value="Change password" />
					</form>
				</div>
				<div class="userprofile">
					<form action="delete_user.php">
						<input class="buttondelete" type="submit" value="Delete account" />
					</form>
				</div>
			</div>

				<?php
			}
			?>
		</div>
	</div>
</body>
<footer>
	<div><span>© jblack-b & ntothmur</span></div>
	<div><span>Piscine PHP - Rush00 21School</span></div>
</footer>
</html>
