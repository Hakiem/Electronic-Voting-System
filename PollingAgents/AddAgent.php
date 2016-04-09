<link href="../stylesheet.css" rel="stylesheet" type="text/css"/>
<?php
	include('../functions.inc.php');
	if(isset($_POST['reg']))
	{
		if(!empty($_POST['an']) && !empty($_POST['pas']))
		{
			//First Check if the Username Exists already. If Yes, then choose another one
			$result = mysql_query("SELECT * FROM login WHERE username = '".$_POST['an']."'");
			if(mysql_num_rows($result) == 1) //If the username chosen already exists
				$Msg = 'Username already in Use. Please choose another one';
			else
			{
				$N = $_POST['an'];
				$P = $_POST['pas'];
				mysql_query("INSERT INTO login (username, pass) VALUES ('$N', md5('$P'))");
				$Msg = $N.' HAS BEEN REGISTERED AS AN AGENT SUCCESSFULLY';
			}
		}
		else
			$Msg = "Agent Username and Password Needed";
	}
	
?>
<form action="<?php  $_SERVER['PHP_SELF'];?>" method="post">
	<h4>ADD NEW AGENT TO ISSUE OUT VOTING CODES</h4>
	<span style="color:Red; font-weight:bold; font-size:11px;">CAUTION : PLEASE LET THE AGENT CHOOSE THEIR OWN USERNAME AND PASSWORD</span>
	<table cellpadding="5" cellspacing="5" width="100%">
		<tr>
			<td><b>Agent Username</b></td>
			<td><input type="text" name="an" size="50"/></td>
		</tr>
		<tr>
			<td><b>Password</b></td>
			<td><input type="password" name="pas" size="50"/></td>
		</tr>
		<tr>
			<td></td>
			<td><input type="submit" name="reg" size="50" value="Add Agent"/></td>
		</tr>
		<?php
		
			if(isset($Msg))
			{
				echo '<tr><td colspan=2 style=font-size:11px;color:Blue>';
				echo $Msg;
				echo '</td></tr>';
			}
		?>
	</table>
</form>