<?php
	$host = "localhost";
	$username = "root";
	$password = "";
	$db_name = "vote";
	$HTTP_HOST="www.somewhere.com"; // HTTP Host
	$DOCROOT="Voting"; // Path, where application is installed
	
	mysql_connect($host, $username, $password)or die("cannot connect to server");
	mysql_select_db($db_name)or die("cannot select db"); 
?>
