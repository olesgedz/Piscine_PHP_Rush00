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
			$data = json_decode(file_get_contents($file), TRUE);
			foreach($data as &$name)
			{
				print($name["auth_login"])."\n";
				print($_SESSION["auth_login"])."dasdsa"."\n";
				if ($name["auth_login"] == $_SESSION["auth_login"])
				{
					echo "adasdsdad";
					$name = $_SESSION;
					unset($name);
					return (0);
				}
			}
			$data = json_encode($data, JSON_PRETTY_PRINT);
			file_put_contents($file, $data);
		}
	}