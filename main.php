#!/usr/bin/php
<?php

	include("database.php");
	$data = ["name"=>"chair","url" => "http", "img" =>"pdsdic.jpg", "number"=>"2"];

	//print($data["name"]["name"]);
	addData($data);
	// printDataBase();