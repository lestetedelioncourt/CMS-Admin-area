<?php
	$server = 'localhost';
	$user = '*****';
	$password = '*****';
	$db = '*****';
	
	$conn = mysqli_connect($server, $user,$password,$db);
	
	if(!$conn){
		die("Connection failed!".mysql1_connect_error());
	}

?>