<?php
	include('functions.inc.php');
	DrawHeader('LOGOUT');
	if(!isset($_SESSION['UserN']))
		header('location:login.htm');
?>

	<tr>
		<td colspan="2">
		<div style="background-image:url(Images/Tackle.png); padding:5px; font-size:13px; height:20px; font-weight:bold; color:Red">
			<?php echo '<a href=index.htm><< Home</a>';?>
		</div>
		<!-- Start ContentPlaceHolder -->
			<table height="300px" width="100%" style="background-color:#FFF;">
				<tr>
					<td align="center" valign="middle">
						<?php
							
							echo '<b>Dear '.$_SESSION['UserN'].', you have successfully logged out of your account</b>';
							
							//Prepare Variables to insert into the Events Log Table
							$Desc = strtoupper($_SESSION['UserN'].' <span style=color:Red>['.$_SESSION['Role'].
											']</span> Logged out of their Account ON '.$_SERVER['REMOTE_ADDR']);
							$UserIP = $_SERVER['REMOTE_ADDR']; //Get the IP-Address Used to Log into the System
							$Ca = 'Staff';
							mysql_query("INSERT INTO log (EventDesc, WhenTaken, CompIP, Cat) VALUES ('$Desc', NOW(), '$UserIP', '$Ca')");
							
							unset($_SESSION['UserN']);
							unset($_SESSION['UID']);
							unset($_SESSION['Role']);
						?>
					</td>
				</tr>
			</table>
		<!-- End ContentPlaceHolder -->
		</td>
	</tr>

<?php
	Footer();
?>
