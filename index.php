<?php
	session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Brainfuck</title>
	<link rel="stylesheet" type="text/css" href="style/style.css">
</head>
<body>
	<div class="header">
		<div class="choose">
			<div class="brainfuck">Brainfuck</div>
		</div>

		<div class="buttons">
			<div class="shoppingcart cla"><img src="https://image.flaticon.com/icons/svg/126/126515.svg"></div>
			<div class="accountsettings cla"><a href="login.php"><img src="https://image.flaticon.com/icons/svg/126/126486.svg"></a></div>
		</div>
	</div>
	<div class="home">
		<div class="centre">
			<?php
				include("main.php");
			?>
		</div>
	</div>
</body>
<footer>
	<div><span>© jblack-b & ntothmur</span></div>
	<div><span>Piscine PHP - Rush00 21School</span></div>
</footer>
</html>
