<?php
	session_start();
	include("database.php");
	include("lib.php");
	include("cart_functions.php");
	$data = ["name"=>"sdd312321sadsads", "price"=>"99", "categories"=>array("tech", "home"),
	"url" => "",
	 "img" =>"https://store.storeimages.cdn-apple.com/4982/as-images.apple.com/is/image/AppleInc/aos/published/images/i/ \
	 ph/iphone/xr/iphone-xr-blue-select-201809?wid=940&hei=1112&fmt=png-alpha&qlt=80&.v=1551226036356", "number"=>"2"];
	$puppy = ["name"=>"puppy", "price"=>"1000", "categories"=>array("tech", "home"),
	"url" => "",
	 "img" =>"https://i0.wp.com/s3.amazonaws.com/wmfeimages/wp-content/uploads/2018/09/27182802/4189366235_060e3e8e6f_z.jpg?fit=640%2C480&ssl=1", "number"=>"2"];

	//print($data["name"]["name"]);
	//dataBaseItemAdd($data);
	orderItemDelete("admin", "toy1");
	 //dataBaseItemEditKey($data, 0);
	// dataBaseItemEdit($puppy);
	//dataBaseItemDelete("lemon");
	//dataBasePrint();
	// $array = dataBaseGetCategory("tech");
	// dataBaseCreatePageFromArray($array);
	//echo "<img src='https://store.storeimages.cdn-apple.com/4982/as-images.apple.com/is/image/AppleInc/aos/published/images/i/ph/iphone/xr/iphone-xr-blue-select-201809?wid=940&hei=1112&fmt=png-alpha&qlt=80&.v=1551226036356'>";
