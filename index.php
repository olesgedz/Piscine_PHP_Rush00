<?php
	session_start();
	header('Cache-Control: no cache');
	include("install.php");
	include("cart_functions.php");
	include("lib.php");
	if ($_POST["add_to_cart"])
	{
		cartItemAdd();
		saveSession();
	}

	if ($_POST["type_all"])
	{
		$_SESSION["category"] = "all";
		header('Location: ./index.php');
	}

	if ($_POST["type_tech"])
	{
		$_SESSION["category"] = "tech";
		header('Location: ./index.php');
	}

	if ($_POST["type_console"])
	{
		$_SESSION["category"] = "console";
		header('Location: ./index.php');
	}

	if ($_POST["type_camera"])
	{
		$_SESSION["category"] = "camera";
		header('Location: ./index.php');
	}
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
			<div><?=countTotal();?> items</div>
			<div><?=sumTotal();?> $</div>
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
		<div id="buttonstring">
			<form method="post">
				<input type="submit" name="type_all"  class="btn menu" value="all" />
				<input type="submit" name="type_tech"  class="btn menu" value="tech" />
				<input type="submit" name="type_console"  class="btn menu" value="consoles" />
				<input type="submit" name="type_camera"  class="btn menu" value="cameras" />
			</form>
		</div>

		<div class="container">
			<?php
				include("database.php");
				$file = "./database.json";
				if (file_exists($file))
				{
					if ($_SESSION["category"] == "all")
						$data =   dataBaseReturnArray();
					else
						$data =  dataBaseGetCategory($_SESSION["category"]);
					foreach($data as $item)
					{
			?>
						<div>
							<div class="top hitem align"><?=$item["name"]?></div>
							<div class="top align"><img src="<?=$item["img"]?>"></div>
							<div class="top align">Price: <?=$item["price"]?>$</div>
							<form method="post" class="align" action="index.php?action=add&id=<?php echo $item["name"]; ?>">
							<input type="hidden" name="quantity" class="form-control" value="1" />
							<input type="hidden" name="hidden_name" value="<?php echo $item["name"]; ?>" />
							<input type="hidden" name="hidden_price" value="<?php echo $item["price"]; ?>" />
							<input type="submit" name="add_to_cart"  class=" btn btn-success buttonadm " value="Add to Cart" />
							</form>
						</div>
			<?php
					}
				}
			?>
		</div>

		</div>
	</div>
</body>
<footer>
	<div><span>© jblack-b & ntothmur</span></div>
	<div><span>Piscine PHP - Rush00 21School</span></div>
</footer>
</html>
