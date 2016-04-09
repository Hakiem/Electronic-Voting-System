<?php
	
	include('functions.inc.php');
	
	if(!isset($_SESSION['regNo']) || !isset($_SESSION['studN']))
	header('location:index.htm');
	
	
?>