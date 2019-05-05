<?php
	session_start();
	include("install.php");
	print_r($_SESSION);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Brainfuck</title>
	<link rel="shortcut icon" href="https://www.flaticon.com/premium-icon/icons/svg/287/287371.svg" />
	<link rel="stylesheet" type="text/css" href="style/style.css">
</head>
<body>
	<div class="header">
		<div class="choose">
		<div class="brainfuck"><a href="index.php">Brainfuck</a></div>
		</div>

		<div class="buttons">
			<div class="shoppingcart cla"><a href = "cart.php"> <img src="https://image.flaticon.com/icons/svg/126/126515.svg"></a></div>
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
		<div class="centre">
			<table>
			<?php
				include("database.php");
				$array = dataBaseGetCategory("tech");
				$i = 0;
				foreach($array as $item)
				{
					if (i % 3 != 1)
					{
						echo "<td>";
					}
					$name = $item["name"];
					$img = $item["img"];
			?>
				<td>
					<p>
						<h1><?php echo "$name" ?></h1>
					</p>
					<div class="top">
						<img  src=<?php echo"\"$img\""?>/>
					</div>
				</td>
			<?php
				if (i % 3 != 1)
				{
					echo "</td>";
				}
				$i++;
			}
			?>
			</table>
		</div>
	</div>
</body>
<footer>
	<div><span>© jblack-b & ntothmur</span></div>
	<div><span>Piscine PHP - Rush00 21School</span></div>
</footer>
</html>