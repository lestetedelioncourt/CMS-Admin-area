<?php
	$server = 'localhost';
	$user = 'LT101';
	$password = 'iWN5TSUFY8KZs98o';
	$db = 'php_course';
	
	$conn = mysqli_connect($server, $user,$password,$db);
	
	if(!$conn){
		die("Connection failed!".mysql1_connect_error());
	}

?>