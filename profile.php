<?php
	session_start();

	if ($_POST["submit"] == "DeleteUser")
		delUser($_POST["user"]);
	else if ($_POST["submit"] == "MakeAdmin")
		makeAdmin($_POST["user"]);
	else if ($_POST["submit"] == "MakeUser")
		makeUser($_POST["user"]);
	else if ($_POST["submit"] == "Change")
		changeItem($_POST["oldname"]);
	else if ($_POST["submit"] == "Add")
		addItem($_POST["name"]);
	else if ($_POST["submit"] == "Delete")
		delItem($_POST["name"]);
	else if ($_POST["submit"] == "ChangeOrder")
		changeOrder($_POST["name"], $_POST["itemtc"]);
	else if ($_POST["submit"] == "DeleteOrder")
		deleteOrder($_POST["name"], $_POST["item_name"]);
	else if ($_POST["submit"] == "CreateUser")
		createUser($_POST["name"]);
	else if ($_POST["submit"] == "ChangeUser")
		changeUser($_POST["user"]);

	function delUser($user)
	{
		$lp = unserialize(file_get_contents("./private/passwd"));
		foreach($lp as &$log)
		{
			if ($log["login"] == $user)
			{
				unset($lp[$user]);
				file_put_contents("./private/passwd", serialize($lp));
				header('Location: ./profile.php');
			}
		}
	}
	function changeUser($user)
	{
		$lp = unserialize(file_get_contents("./private/passwd"));
		foreach($lp as &$log)
		{
			if ($log["login"] == $user)
			{
				$log["passwd"] = hash('whirlpool', $_POST["passwd"]);
				$log["address"] = $_POST["address"];
				$log["email"] = $_POST["email"];
				$log["phone"] = $_POST["phone"];
				file_put_contents("./private/passwd", serialize($lp));
				unset($log);
				header('Location: ./profile.php');
				exit();
			}
		}
	}
	function createUser()
	{
		if (file_exists("./private/passwd"))
		{
			$lp = unserialize(file_get_contents("./private/passwd"));
			foreach($lp as $log)
			{
				if ($log["login"] == $_POST["login"])
					header('Location: ./profile.php');
			}
		}
		$lp[$_POST["login"]] = array (
			"login" => $_POST["login"],
			"passwd" => hash('whirlpool', $_POST["passwd"]),
			"address" => $_POST["address"],
			"email" => $_POST["email"],
			"phone" => $_POST["phone"],
			"status" => "user",
		);
		file_put_contents("./private/passwd", serialize($lp));
	}
	function makeAdmin($user)
	{
		$lp = unserialize(file_get_contents("./private/passwd"));
		foreach($lp as &$log)
		{
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
	function changeItem($item)
	{
		include ("database.php");
		$new_data = [
			"name"=>$_POST["name"],
			"price"=>$_POST["price"],
			"categories"=>array($_POST["categories1"], $_POST["categories2"]),
			"url" => $_POST["url"],
			"img" => $_POST["img"],
			 "number"=>$_POST["number"]];
		dataBaseItemEditKey($new_data, $item);
	}
	function addItem($item)
	{
		include ("database.php");
		$new_data = [
			"name"=>$_POST["name"],
			"price"=>$_POST["price"],
			"categories"=>array($_POST["categories1"], $_POST["categories2"]),
			"url" => $_POST["url"],
			"img" => $_POST["img"],
			 "number"=>$_POST["number"]];
		dataBaseItemAdd($new_data);
	}
	function delItem($item)
	{
		include ("database.php");
		dataBaseItemDelete($item);
	}
	function changeOrder($name, $item)
	{
		include ("cart_functions.php");
		$item = [
			"item_name"=>$_POST["item_name"],
			"item_price" => $_POST["item_price"],
			"item_quantity"=>$_POST["item_quantity"]];
		orderItemEdit($name, $item);
	}
	function deleteOrder($name, $item_name)
	{
		include ("cart_functions.php");
		orderItemDelete($name, $item_name);
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
			<div class="shoppingcart cla"><a href = "cart.php"><img src="https://image.flaticon.com/icons/svg/126/126515.svg"></a></div>
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
								<input name="passwd" type="password" value="" placeholder="Password">
								<input name="address" type="text" value="<?=$log["address"]?>" placeholder="Address">
								<input name="email" type="email" value="<?=$log["email"]?>" placeholder="E-mail">
								<input name="phone" type="tel" value="<?=$log["phone"]?>" placeholder="Phone number">
								<input type="hidden" name="user" value="<?=$log["login"]?>"/>
								<input class="buttonadm" name="submit" type="submit" value="DeleteUser" />
								<input class="buttonadm" name="submit" type="submit" value="ChangeUser" />
								<input class="buttonadm" name="submit" type="submit" value="MakeAdmin" />
								<input class="buttonadm" name="submit" type="submit" value="MakeUser" />
							</form>
							<hr>
						</div>
					<?php
						}
					}
					?>
					<div class="userprofile st_admin">Create new user</div>
					<hr>
					<form action="profile.php" method='post'>
							<input name="login" type="text" value="" placeholder="Username" required>
							<input name="passwd" type="password" value="" placeholder="Password" required>
							<input name="address" type="text" value="" placeholder="Address" required>
							<input name="email" type="email" value="" placeholder="E-mail" required>
							<input name="phone" type="tel" value="" placeholder="Phone number" required>
							<input class="buttonadm" type="submit" name="submit" value="CreateUser"/>
					</form>
					<div class="userprofile st_catalog">Catalog edit</div>
					<hr style="border: 2px solid black;">
					<?php

					$file = "./database.json";
					if (file_exists($file))
					{
						$catalog = json_decode(file_get_contents($file), TRUE);
						if ($catalog){
						foreach($catalog as $item)
						{
							$oldname = $item["id"];
					?>
							<div class="catalog">
								<form action="profile.php" method="post">
									Name: <input type="text" name="name" value="<?=$item["name"]?>">
									Price: <input type="text" name="price" value="<?=$item["price"]?>">
									Categories: <input type="text" name="categories1" value="<?=$item["categories"][0]?>">
									<input type="text" name="categories2" value="<?=$item["categories"][1]?>">
									URL: <input type="text" name="url" value="<?=$item["url"]?>">
									Image: <input type="text" name="img" value="<?=$item["img"]?>">
									Number: <input type="text" name="number" value="<?=$item["number"]?>">
									<input type="hidden" name="oldname" value="<?=$oldname?>"/>
									<input class="buttonadm" name="submit" type="submit" value="Change"/>
									<input class="buttonadm" name="submit" type="submit" value="Delete"/>
								</form>
								<hr style="border: 2px solid black;">
							</div>
					<?php
						}
					}
				}
					?>
				<div class="catalog">
					<form action="profile.php" method="post">
						Name: <input type="text" name="name" value="">
						Price: <input type="text" name="price" value="">
						Categories: <input type="text" name="categories1" value="">
						<input type="text" name="categories2" value="">
						URL: <input type="text" name="url" value="">
						Image: <input type="text" name="img" value="">
						Number: <input type="text" name="number" value="">
						<input class="buttonadm" name="submit" type="submit" value="Add"/>
					</form>
					<hr style="border: 2px solid black;">
				</div>
			</div>
			<div class="userprofile st_orders">Users orders</div>
					<hr style="border: 2px solid black;">
					<?php

					$fileorders = "./orders.json";
					if (file_exists($fileorders))
					{
						$orders = json_decode(file_get_contents($fileorders), TRUE);
						if ($orders){
						foreach($orders as $order)
						{
							$name = $order["name"];
					?>

							<div class="orders">
									Name of user: <div><?=$order["name"]?></div>
									<?php
										foreach($order["cart"] as $item)
										{
											$itemtc = $item;
									?>
										<form action="profile.php" method="post" class="orderslist">
											ID: <input type="text" name="item_id" value="<?=$item["item_id"]?>">
											Name: <input type="text" name="item_name" value="<?=$item["item_name"]?>">
											Price: <input type="text" name="item_price" value="<?=$item["item_price"]?>">
											Quantity: <input type="text" name="item_quantity" value="<?=$item["item_quantity"]?>">
											<input type="hidden" name="name" value="<?=$name?>"/>
											<input type="hidden" name="itemtc" value="<?=$itemtc?>"/>
											<input class="buttonadm" name="submit" type="submit" value="ChangeOrder"/>
											<input class="buttonadm" name="submit" type="submit" value="DeleteOrder"/>
										</form>
										<?php
										}
										?>

								<hr style="border: 2px solid black;">
							</div>
					<?php
						}
					}
				}
					?>
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
