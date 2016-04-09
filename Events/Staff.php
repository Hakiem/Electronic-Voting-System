<link rel="stylesheet" type="text/css" href="../stylesheet.css"
<?php
	header("Refresh: 5;");
	include('../functions.inc.php');
	
	$result = mysql_query("SELECT * FROM log WHERE Cat = 'Staff' ORDER BY WhenTaken DESC");
	if(mysql_num_rows($result) > 0)
	{
		echo '<h4>EVENTS LOG FOR STAFF</h4><br>';
		
		echo '<table width=100% border=1 style=font-size:11px>';
		$i = 1;
		
		while($row = mysql_fetch_row($result))
		{
			echo '<tr><td><b>';
			$D = new DateTime($row[2]);
			echo $i.' : '.$row[1].' ON '.$D->format('l j F, Y H:i:s');
			echo '</b></td></tr>';
			$i += 1;
		}
		
		echo '</table>';
	}
	else
	{
		echo '<table width=100% height=100px><tr><td align=center valign=middle>';
		echo '<h4>THERE ARE NO STAFF EVENTS TO DISPLAY YET</h4><br>';
		echo '</td></tr></table>';
	}
?>