<?php
	session_start();
	if (!file_exists("./private"))
		mkdir("./private");
	if (!file_exists("./private/passwd"))
	{
		$passwd_file[] = array("login" => "admin", "passwd" => hash("whirlpool","admin"), "status" => "admin");
		file_put_contents("private/passwd", serialize($passwd_file));
	}
?>
