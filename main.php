#!/usr/bin/php
<?php

	include("database.php");
	$data = ["name"=>"iphone", "categories"=>array("tech", "home"),
	"url" => "https://store.storeimages.cdn-apple.com/4982/as-images.apple.com/is/image/AppleInc/aos/published/images/i/ph/iphone/xr/iphone-xr-blue-select-201809?wid=940&hei=1112&fmt=png-alpha&qlt=80&.v=1551226036356",
	 "img" =>"https://store.storeimages.cdn-apple.com/4982/as-images.apple.com/is/image/AppleInc/aos/published/images/i/ph/iphone/xr/iphone-xr-blue-select-201809?wid=940&hei=1112&fmt=png-alpha&qlt=80&.v=1551226036356", "number"=>"2"];

	//print($data["name"]["name"]);
	dataBaseItemAdd($data);
	dataBaseItemEdit($data);
	//dataBaseItemDelete("lemon");
	//dataBasePrint();
	print_r($array = dataBaseGetCategory("tech"));
	dataBaseCreatePageFromArray($array);
	//echo "<img src='https://store.storeimages.cdn-apple.com/4982/as-images.apple.com/is/image/AppleInc/aos/published/images/i/ph/iphone/xr/iphone-xr-blue-select-201809?wid=940&hei=1112&fmt=png-alpha&qlt=80&.v=1551226036356'>";
	