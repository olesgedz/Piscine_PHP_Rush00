<?php
	function dataBaseItemAdd($new_data)
	{
		$file = "./database.json";
		if (!file_exists($file))
		{
			$data[$new_data["name"]] =  $new_data;
			$data = json_encode($data, JSON_PRETTY_PRINT);
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
			$data = json_encode($data, JSON_PRETTY_PRINT);
			file_put_contents($file, $data);
		}
	}

	function  dataBasePrint()
	{
		$file = "./database.json";
		if (file_exists($file))
		{
			$data = json_decode(file_get_contents($file), TRUE);
			print_r($data);
		}
		else
			echo "DataBase doesn't exist\n";
	}

	function dataBaseItemEdit($new_data)
	{
		$file = "./database.json";
		if (file_exists($file))
		{
			$data = json_decode(file_get_contents($file), TRUE);
			foreach($data as $name)
			{
				if ($name["name"] == $new_data["name"])
				{
					$data[$new_data["name"]] =  $new_data;
					$data = json_encode($data, JSON_PRETTY_PRINT);
					file_put_contents($file, $data);
				}
			}
		}
		else
			echo "DataBase doesn't exist\n";
	}

	function dataBaseItemDelete($item)
	{
		$file = "./database.json";
		if (file_exists($file))
		{
			$data = json_decode(file_get_contents($file), TRUE);
			foreach($data as $name)
			{
				if ($name["name"] == $item)
				{
					unset($data[$item]);
					$data = json_encode($data, JSON_PRETTY_PRINT);
					file_put_contents($file, $data);
				}
			}
		}
		else
			echo "DataBase doesn't exist\n";
	}

	function dataBaseGetCategory($type)
	{
		$file = "./database.json";
		$array = array();
		if (file_exists($file))
		{
			$data = json_decode(file_get_contents($file), TRUE);
			foreach($data as $item)
			{
				if(!empty(temp))
				{
					foreach($item["categories"] as $category)
					{
						if ($category == $type)
						{
							$array[] = $item;
						}
					}
				}
				// if ($item["name"] == $item)
				// {
				// 	unset($data[$item]);
				// 	$data = json_encode($data, JSON_PRETTY_PRINT);
				// 	file_put_contents($file, $data);
				// }
			}
			return $array;
		}
		else
			echo "DataBase doesn't exist\n";
	}

	function dataBaseCreatePageFromArray($array)
	{
		foreach($array as $item)
		{
			//echo "$item";
			$name = $item["name"];
			$img = $item["img"];
			echo '<div>
					<p>
						<h1>'.$name.'</h1>
					</p>
					<div>
						<img  src='."\"$img\"".' width="100px" height="100px"/>
					</div>
				</div>';
		}
	}