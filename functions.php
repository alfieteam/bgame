<?php
//	define("DB_HOST","db2.ho.ua");
//	define("DB_USER","bizgame");
//	define("DB_PASS","11091991");
//	define("DB_NAME","bizgame");
	define("DB_HOST","localhost");
	define("DB_USER","root");
	define("DB_PASS","");
	define("DB_NAME","bgame");

	function connect(){
		$link = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME) or die(mysqli_error());
		return $link;
	}
?>