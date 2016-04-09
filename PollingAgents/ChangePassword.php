<link href="../stylesheet.css" rel="stylesheet" type="text/css"/>
<?php
	include('../functions.inc.php');
	
	if(isset($_POST['Change']))
	{
		
	}
	
	if(!isset($_GET['AgentID']))
	{
		echo '<h4>THERE ARE NO AGENTS TO CHANGE PASSWORDS FOR</h4><br>';
	}
	else
	{
		$row = mysql_fetch_row(mysql_query("SELECT * FROM login WHERE UserID = '".$_GET['AgentID']."'"));
		echo '<h4>CHANGE PASSWORD FOR AGENT : '.$row[1].'</h4><br>';
		?>
			<form method="post" action="<?php $_SERVER['PHP_SELF'];?>">
				<table cellpadding="6" cellspacing="6">
					<tr>
						<td><b>Old Password</b></td>
						<td><input type="password" size="30" name="op" style="font-size:11px;" /></td>
					</tr>
					<tr>
						<td><b>New Password</b></td>
						<td><input type="password" size="30" name="op" style="font-size:11px;" /></td>
					</tr>
					<tr>
						<td><b>Confirm New Password</b></td>
						<td><input type="password" size="30" name="op" style="font-size:11px;" /></td>
					</tr>
					<tr>
						<td></td>
						<td><input type="submit" name="Change" style="font-size:11px;" value="Change Password" /></td>
					</tr>
				</table>
			</form>
		<?php
	}
?>
