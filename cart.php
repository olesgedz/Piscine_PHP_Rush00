<?php
	session_start(); 
	header('Cache-Control: no cache');
	include("database.php");
	include("cart_functions.php");
	include("lib.php");
	if ($_POST["add_to_cart"])
	{
		cartItemAdd();
		saveSession();
	}
	if($_GET["action"] == "delete")
	{
		cartItemDelete();
		saveSession();
	}

	if($_GET["action"] == "validate")
	{
		cartItemValidate();
		saveSession();
	}

 ?>
 <!DOCTYPE html>
 <html>
	  <head>
	  		<meta charset="UTF-8">
		   <title> Shopping Cart </title>
		   <link rel="shortcut icon" href="https://image.flaticon.com/icons/svg/822/822699.svg" />
			<link rel="stylesheet" type="text/css" href="style/style.css">
	  </head>
	  <body>
	  <div class="header">		<div class="choose">
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
		<div>
		   <br />
		   <div class="centr">
		   <div class="container" style="width:700px;">
				<?php

				if(($i = dataBaseItemCount()) > 0)
				{
					//$i = 3; //fix that !!!!!!!!!!!!!!!!!!!
					$array = dataBaseReturnArray();
				foreach($array as $row )
				{
				?>
				<div class="col-md-4">
					 <form method="post" action="cart.php?action=add&id=<?php echo $row["name"]; ?>">
						  <div style="border:1px solid #333; background-color:#f1f1f1; border-radius:5px; padding:16px;" align="center">
							   <img src="<?php echo $row["image"]; ?>" class="img-responsive" /><br />
							   <h4 class="text-info"><?php echo $row["name"]; ?></h4>
							   <h4 class="text-danger">$ <?php echo $row["price"]; ?></h4>
							   <input type="text" name="quantity" class="form-control" value="1" />
							   <input type="hidden" name="hidden_name" value="<?php echo $row["name"]; ?>" />
							   <input type="hidden" name="hidden_price" value="<?php echo $row["price"]; ?>" />
							   <input type="submit" name="add_to_cart" style="margin-top:5px;" class="btn btn-success" value="Add to Cart" />
						  </div>
					 </form>
				</div>
				<?php
					 }
				}
				?>
				<div style="clear:both"></div>
				<br />
				<div class="table-responsive">
					 <table class="table table-bordered">
							<tr>
								<th width="40%">Item Name</th>
								<th width="10%">Quantity</th>
								<th width="20%">Price</th>
								<th width="15%">Total</th>
								<th width="5%">Action</th>
							</tr>
							<?php
							if(!empty($_SESSION["shopping_cart"]))
							{
								$total = 0;
								foreach($_SESSION["shopping_cart"] as $keys => $values)
								{
							?>
							<tr>
							<td><?php echo $values["item_name"]; ?></td>
							<td><?php echo $values["item_quantity"]; ?></td>
							<td>$ <?php echo $values["item_price"]; ?></td>
							<td>$ <?php echo number_format($values["item_quantity"] * $values["item_price"], 2); ?></td>
							<td><a href="cart.php?action=delete&id=<?php echo $values["item_id"]; ?>"><span class="text-danger">Remove</span></a></td>
							</tr>
							<?php
									$total = $total + ($values["item_quantity"] * $values["item_price"]);
							}
							?>
							<tr>
								<td colspan="3" align="right">Total</td>
								<td align="right">$ <?php echo number_format($total, 2); ?></td>
								<td></td>
							</tr>
							<?php
							}
						?>
					 </table>
					 <form method="post" action="cart.php?action=validate">
						 <input type="submit" name="validate"  class=" btn btn-success buttonadm " value="validate" />
					</form>
				</div>
		</div>
						</div>
		<br />
	</body>
 </html>
