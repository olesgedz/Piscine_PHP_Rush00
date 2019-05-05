<?php

	function cartItemAdd()
	{
		session_start();
		$flag = 0;
		$i = 0;
		$count = count($_SESSION["shopping_cart"]);
		if (!empty($_SESSION["shopping_cart"]))
		{
			foreach ($_SESSION["shopping_cart"] as &$item)
			{
				if ($item["item_id"] == $_GET["id"])
				{
					$item['item_quantity'] += $_POST["quantity"];
					$flag = 1;
					unset($item);
				}
			}
		}
		if ($flag == 0)
		{
			$item_array = array(  
								'item_id'               =>     $_GET["id"],  
								'item_name'               =>     $_POST["hidden_name"],  
								'item_price'          =>     $_POST["hidden_price"],  
								'item_quantity'          =>     $_POST["quantity"]  
							);  
			$_SESSION["shopping_cart"][$count] = $item_array;
		}
	}

	function cartItemDelete()
	{
		session_start();
		foreach($_SESSION["shopping_cart"] as $keys => $values)  
		{
			if($values["item_id"] == $_GET["id"])  
			{
					unset($_SESSION["shopping_cart"][$keys]);
			}
		}
	}
?>