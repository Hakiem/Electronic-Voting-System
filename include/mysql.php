<?php

$q = strtolower( $_GET['q'] );
if (!$q) return;

include('../config.php');

// Replace "TABLE_NAME" below with the table you'd like to extract data from
$data = mysql_query("SELECT stud_reg_no FROM votestudents");

while( $row = mysql_fetch_row($data))
{
	if (strpos( strtolower( $row[0] ), $q ) == false) 
	{
		echo $row[0] . "\n";
	}
}

?>