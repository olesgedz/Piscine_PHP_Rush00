<?php
	//session_start();

	if (!file_exists("./private"))
		mkdir("./private");
	if (!file_exists("./private/passwd"))
	{
		$passwd_file["admin"] = array(
			"login" => "admin",
			"passwd" => hash("whirlpool","admin"),
			"address" => "Moscow",
			"email" => "kratyuk@mail.ru",
			"phone" => "8-925-111-86-76",
			"status" => "admin"
		);
		file_put_contents("private/passwd", serialize($passwd_file));
	}
?>
