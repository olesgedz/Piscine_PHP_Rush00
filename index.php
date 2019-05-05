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
		<div id="buttonstring">
			<button class="btn active" onclick="filterSelect('all')"> Show all</button>
			<button class="btn" onclick="filterSelect('computers')"> Computers</button>
			<button class="btn" onclick="filterSelect('consoles')"> Consoles</button>
			<button class="btn" onclick="filterSelect('cameras')"> Cameras</button>
			<button class="btn" onclick="filterSelect('cellphones')"> Cell Phones</button>
		</div>

		<div class="container">
			<?php
				$file = "./database.json";
				if (file_exists($file))
				{
					$data = json_decode(file_get_contents($file), TRUE);
					foreach($data as $item)
					{
			?>
						<div class="itemsFilter <?=$item["categories"]?>">
							<div class="top hitem"><?=$item["name"]?></div>
							<div class="top"><img src="<?=$item["img"]?>"></div>
							<div class="top">Price: <?=$item["price"]?></div>
							<form method="post" action="index.php?action=add&id=<?php echo $item["name"]; ?>">
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
		<script type="text/javascript">
		filterSelect("all")
		function filterSelect(c) {
			var x, i;
			x = document.getElementsByClassName("itemsFilter");
			if (c == "all") c = "";
			for (i = 0; i < x.length; i++) {
				RemoveClass(x[i], "show");
				if (x[i].className.indexOf(c) > -1) AddClass(x[i], "show");
			}
		}

		function AddClass(element, name) {
			var i, arr1, arr2;
			arr1 = element.className.split(" ");
			arr2 = name.split(" ");
			for (i = 0; i < arr2.length; i++) {
				if (arr1.indexOf(arr2[i]) == -1) {element.className += " " + arr2[i];}
			}
		}

		function RemoveClass(element, name) {
			var i, arr1, arr2;
			arr1 = element.className.split(" ");
			arr2 = name.split(" ");
			for (i = 0; i < arr2.length; i++) {
			while (arr1.indexOf(arr2[i]) > -1) {
				arr1.splice(arr1.indexOf(arr2[i]), 1);
				}
			}
			element.className = arr1.join(" ");
		}

		var btnContainer = document.getElementById("buttonstring");
		var btns = btnContainer.getElementsByClassName("btn");
		for (var i = 0; i < btns.length; i++) {
			btns[i].addEventListener("click", function(){
				var current = document.getElementsByClassName("active");
				current[0].className = current[0].className.replace(" active", "");
				this.className += " active";
			});
		}
		</script>
		</div>
	</div>
</body>
<footer>
	<div><span>© jblack-b & ntothmur</span></div>
	<div><span>Piscine PHP - Rush00 21School</span></div>
</footer>
</html>
