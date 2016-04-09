<script type="text/javascript">
	function Konfam()  
	{  
		if(window.confirm('Are you you want to Delete?') == true)
			return true;
		else
			return false;
	} 
</script>

<link href="../stylesheet.css" rel="stylesheet" type="text/css"/>
<?php
	include('../functions.inc.php');
	
	if(isset($_GET['AgentID']))
	{
		mysql_query("DELETE FROM login WHERE UserID = '".$_GET['AgentID']."'");
	}
	
	$query = mysql_query("SELECT * FROM login WHERE username <> 'admin'");
	if(mysql_num_rows($query) > 0)
	{
		echo '<h4>LIST OF ALL POLLING AGENTS</h4><br>';
		
		echo '<table cellspacing=1 cellpadding=1 width=50% id=table border=1>';
			echo '<tr><th>.</th><th>.</th><th>Name</th><th>.</th></tr>';
			$i = 1;
			while($row = mysql_fetch_row($query))
			{
				echo '<tr>';
					echo '<td>'.$i.'</td>';
					echo '<td><a href=Default.php?AgentID='.$row[0].' onclick=Konfam()>Remove</a></td>';
					echo '<td>'.$row[1].'</td>';
					echo '<td><a href=ChangePassword.php?AgentID='.$row[0].' target=Content>Change Password</a></td>';
				echo '</tr>';
				$i += 1;
			}
		echo '</table>';
	}
?>
