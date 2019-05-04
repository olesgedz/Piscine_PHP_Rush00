<?php
	function addData($new_data)
	{
		$file = "./database.json";
		if (!file_exists($file))
		{
			$data[$new_data["name"]] =  $new_data;
			$data = json_encode($data, JSON_PRETTY_PRINT);
			print_r($data);
			file_put_contents($file, $data);
		}
		else
		{
			$data = json_decode(file_get_contents($file), TRUE);
			foreach($data as $name)
			{
				if ($name["name"] == $new_data["name"])
				{
					echo "already exists";
					return (0);
				}
			}
			$data[$new_data["name"]] =  $new_data;
			print_r($ok);
			$data = json_encode($data, JSON_PRETTY_PRINT);
			file_put_contents($file, $data);
		}
	}

	function  printDataBase()
	{
		$file = "./database.json";
		if (!file_exists($file))
		{
			$data = json_decode(file_get_contents($file), TRUE);
			print_r($data["ok"]);
		}
	}
