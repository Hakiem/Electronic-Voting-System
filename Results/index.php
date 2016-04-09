<?php
	
	include('../functions.inc.php'); 
	DrawHeader('RESULTS PAGE');
	
	if(!isset($_SESSION['Shu']))
		$Sur = array();
	else
		$Sur = $_SESSION['Shu'];
	
	if(isset($_POST['login']))
	{
		$U = stripslashes($_POST['UN']);
		$P = stripslashes($_POST['Pass']);
		
		if(!empty($U) && !empty($P))
		{
			$result = mysql_query("SELECT * FROM surety WHERE username = '$U' AND pass = MD5('$P')");
			//$result = mysql_query("SELECT * FROM surety WHERE username = '$U' AND pass = '$P'");
			if(mysql_num_rows($result) < 1)
				$Msg = 'Wrong Username and Password Combination';
			else
			{
				$row = mysql_fetch_row($result);
				if(!in_array($row[0], $Sur))
					$Sur[count($Sur) - 1] = $row[0];
					
				mysql_query("UPDATE surety SET LastLogin = NOW() WHERE SuretyID = '".$row[0]."'");
			}
		}
		else
			$Msg = 'Username and Password Fields Should not be Blank';
	}
	
	$_SESSION['Shu'] = $Sur;
	$Su = mysql_fetch_row(mysql_query('SELECT COUNT(*) FROM surety'));
	
	if(count($_SESSION['Shu']) == $Su[0])
	{
		$_SESSION['Rez'] = 'Auth_C';
		header('location:Results_Menu.htm');
	}
?>
	<tr>
		<td colspan="2">
		<div style="background-image:url(Images/Tackle.png); padding:5px; font-size:13px; height:20px; font-weight:bold; color:Red">
			<a href="/etov/">HOME</a><span id="Entry"> &raquo; RESULTS SECTION - EVOTING SYSTEM</span>
		</div>
		<!-- Start ContentPlaceHolder -->
		<table height="300px" width="100%" style="background-color:#FFF;">
			<tr>
				<td valign="middle" align="center">
                	<div style="font-size:20px;">
                    	<b>RESULTS SECTION - EVOTING SYSTEM</b><hr style="width:50%; text-align:center;">
                    </div>
                    <div style="color:Red; font-weight:bold;">
                    	<?php echo count($_SESSION['Shu']).'/'.$Su[0].' Sureties authenticated to Open the Grand Results';?>
                    </div>
                    <br />
					<div>
						<form action="<?php $_SERVER['PHP_SELF'];?>" method="post" id="form1" onsubmit="return Length_TextField_Validator()">
							<table width="34%" align="center" cellpadding="5" cellspacing="5" style="font-size:13px;">
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
                    <div style="font-size:10px;">
                    	<!--<b>Summary</b><hr style="width:50%; text-align:center;"> -->
                        <?php
							$T = mysql_query('SELECT * FROM surety ORDER BY username ASC');
							if(mysql_num_rows($T) > 0)
							{
								$i = 1;
								echo '<table border=0 width=50% style=border:solid black 3px;>';
								echo '<th></th><th>Surety Name</th><th>Is Authenticated?<th>';
									while($V = mysql_fetch_row($T))
									{
										echo '<tr style=border-bottom:solid black 1px;>';
											echo '<td>'.$i.'.</td>';
											echo '<td>'.strtoupper($V[1]).'.</td>';
											echo '<td align=center valign=middle>';
												if(in_array($V[0], $Sur))
													echo '<img alt=auth src=../Images/green_tick.png width=20px height=20px /> (YES)';
												else
													echo '<img alt=wrong src=../Images/red_tick.png width=20px height=20px /> (NO)';
											echo '</td>';
										echo '</tr>';
										$i += 1;
									}
								echo '</table>';
							}
						?>
                    </div>
				</td>
			</tr>
			<tr height="80px">
				<td align="right">
					<img src="../Images/3.gif" height="80px" width="80px" />
				</td>
			</tr>
		</table>
		<!-- End ContentPlaceHolder -->
		</td>
	</tr>

<?php
	Footer();
?>