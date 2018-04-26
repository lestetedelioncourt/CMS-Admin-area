<?php
	$server = 'localhost';
	$user = '*****';
	$password = '*****';
	$db = '*****';
	
	$conn = mysqli_connect($server, $user,$password,$db);
	
	if(!$conn) {
		die("Connection failed!".mysqli_connect_error());
	}

?>
