<?php
	$host='localhost';
	$username='root';
	$password='';
	$db_name='vote';
	
	$mysqli = new mysqli($host, $username, $password, $db_name)or die('Cannot connect to server');
?>