<?php
	function saveSession()
	{
		$file = "./sessions.json";
		if (!file_exists($file))
		{
			$data[$_SESSION["auth_login"]] = $_SESSION;
			$data = json_encode($data, JSON_PRETTY_PRINT);
			file_put_contents($file, $data);
		}
		else
		{
			$flag = 0;
			$data = json_decode(file_get_contents($file), TRUE);
			foreach($data as &$name)
			{
				if ($name["auth_login"] == $_SESSION["auth_login"])
				{
					$name = $_SESSION;
					unset($name);
					$flag = 1;
				}
			}
			if ($flag == 0)
			{
				$data[$_SESSION["auth_login"]] =  $_SESSION;
			}
			$data = json_encode($data, JSON_PRETTY_PRINT);
			file_put_contents($file, $data);
		}
	}
	
	function getSession($log)
	{
		$file = "./sessions.json";
		if (file_exists($file))
		{
			$data = json_decode(file_get_contents($file), TRUE);
			foreach($data as $name)
			{
				if ($name["auth_login"] == $log["login"])
				{
					return ($name);
				}
			}

		}
	}

	function sumTotal()
	{
		$sum = 0;
		//print_r($_SESSION);
		if(!empty($_SESSION))
		{
			foreach($_SESSION["shopping_cart"] as $item)
			{
				$sum +=  $item["item_price"];
			}
		}
		return($sum);
	}