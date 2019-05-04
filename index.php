<?php
	session_start();
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
			<div class="brainfuck">Brainfuck</div>
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
		<div class="centre">
			<table>
				<tr>
					<td>
							<div class="top"><img src="https://asset.msi.com/resize/image/global/product/product_5_20190314100759_5c89b77f26b45.png62405b38c58fe0f07fcef2367d8a9ba1/600.png"></div>
							<div></div>
					</td>
					<td>
							<div class="top"><img src="https://asset.msi.com/resize/image/global/product/product_8_20170630094242_5955ac92e8237.png62405b38c58fe0f07fcef2367d8a9ba1/600.png"></div>
					</td>
					<td>
							<div class="top"><img src="https://asset.msi.com/resize/image/global/product/product_0_20170630095051_5955ae7bc72d7.png62405b38c58fe0f07fcef2367d8a9ba1/600.png"></div>
					</td>
				</tr>
				<tr>
					<td>
							<div class="top"><img src="https://asset.msi.com/resize/image/global/product/product_4_20180409144850_5acb0cd2459a2.png62405b38c58fe0f07fcef2367d8a9ba1/600.png"></div>
					</td>
					<td>
							<div class="top"><img src="https://asset.msi.com/resize/image/global/product/product_6_20170630094902_5955ae0e05ca6.png62405b38c58fe0f07fcef2367d8a9ba1/600.png"></div>
					</td>
					<td>
							<div class="top"><img src="https://asset.msi.com/resize/image/global/product/product_7_20170630094728_5955adb04e84c.png62405b38c58fe0f07fcef2367d8a9ba1/600.png"></div>
					</td>
				</tr>
				<tr>
					<td>
							<div class="top"><img src="https://asset.msi.com/resize/image/global/product/product_8_20190108145456_5c34494035783.png62405b38c58fe0f07fcef2367d8a9ba1/600.png"></div>
					</td>
					<td>
							<div class="top"><img src="https://asset.msi.com/resize/image/global/product/product_9_20180409144126_5acb0b162e43a.png62405b38c58fe0f07fcef2367d8a9ba1/600.png"></div>
					</td>
					<td>
							<div class="top"><img src="https://asset.msi.com/resize/image/global/product/product_9_20170518153151_591d4de726da7.png62405b38c58fe0f07fcef2367d8a9ba1/600.png"></div>
					</td>
				</tr>
			</table>
		</div>
	</div>
</body>
<footer>
	<div><span>© jblack-b & ntothmur</span></div>
	<div><span>Piscine PHP - Rush00 21School</span></div>
</footer>
</html>
