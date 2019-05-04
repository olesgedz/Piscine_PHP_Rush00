#!/usr/bin/php
<?php

	include("database.php");
	$data = ["name"=>"mobile", "categories"=>array("tech", "home"),"url" => "http", "img" =>"pdsdasdasdsadasd", "number"=>"2"];

	//print($data["name"]["name"]);
	dataBaseItemAdd($data);
	//dataBaseItemEdit($data);
	//dataBaseItemDelete("lemon");
	//dataBasePrint();
	print_r($array = dataBaseGetCategory("tech"));
	dataBaseCreatePageFromArray($array);
	