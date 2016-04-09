<?php
	include('functions.inc.php');
	DrawHeader('LOGIN');
	if(isset($_POST['login']))
	{
		$U = stripslashes($_POST['UN']);
		$P = stripslashes($_POST['Pass']);
		
		if(!empty($U) && !empty($P))
		{
			$result = mysql_query("SELECT * FROM login WHERE username = '$U' AND pass = md5('$P')");
			if(mysql_num_rows($result) < 1)
				$Msg = 'Wrong Username and Password Combination';
			else
			{
				$row = mysql_fetch_row($result);
				$_SESSION['UID'] = $row[0]; //Grab the UserID
				$_SESSION['UserN'] = $row[1]; //Grab the Username 
				$_SESSION['Role'] = $row[4]; //Grab the User Role as Well
				
				mysql_query("UPDATE login SET LastLogin = NOW() WHERE UserID = '".$row[0]."'");
				
				//Prepare Variables to insert into the Events Log Table
				$Desc = strtoupper($_SESSION['UserN'].' <span style=color:Red>['.$_SESSION['Role'].']</span> Logged into their Account on '.$_SERVER['REMOTE_ADDR']);
				$UserIP = $_SERVER['REMOTE_ADDR']; //Get the IP-Address Used to Log into the System
				$Ca = 'Staff';
				mysql_query("INSERT INTO log (EventDesc, WhenTaken, CompIP, Cat) VALUES ('$Desc', NOW(), '$UserIP', '$Ca')");
				
				if($row[4] == 'Administrator')
					header('location:Administrator.htm');
				else
					header('location:Agent.htm');
			}
		}
		else
			$Msg = 'Username and Password Fields Should not be Blank';
	}
?>

	<tr>
		<td colspan="2">
		<div style="background-image:url(Images/Tackle.png); padding:5px; font-size:13px; height:20px; font-weight:bold; color:Red">
			<a href="index.htm"><< Back</a><span id="Entry"><?php echo VitalReturns()?></span>
		</div>
		<!-- Start ContentPlaceHolder -->
		<table height="300px" width="100%" style="background-color:#FFF;">
			<tr>
				<td valign="middle" align="center">
					<div>
						<form action="<?php $_SERVER['PHP_SELF'];?>" method="post" id="form1" onsubmit="return Length_TextField_Validator()">
							<table width="34%" align="center" cellpadding="5" cellspacing="5">
								<?php
									if(isset($Msg))
										echo '<tr><td colspan=2 align=center style=\'color:Blue; font-weight:Bold; font-size:11px\'>'.$Msg.'</td></tr>';
								?>
								<tr>
									<td width="24%"><b>Username</b></td>
								  <td width="76%"><input type="text" name="UN"></td>
								</tr>
								<tr>
									<td><b>Password</b></td>
									<td><input type="password" name="Pass"></td>
								</tr>
								<tr>
									<td></td>
									<td><input type="submit" name="login" value="Login" style="font-size:11px" /></td>
								</tr>
						  </table>
						</form>
					</div>
				</td>
			</tr>
			<tr height="80px">
				<td align="right">
					<img src="Images/3.gif" height="80px" width="80px" />
				</td>
			</tr>
		</table>
		<!-- End ContentPlaceHolder -->
		</td>
	</tr>

<?php
	Footer();
?>
