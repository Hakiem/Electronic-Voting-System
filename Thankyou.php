
<?php
	include('functions.inc.php');
	if(!isset($_SESSION['regNo']))
		header('location:index.htm');
	echo '<META HTTP-EQUIV=refresh CONTENT=5;URL='.ServerLocation().'>';
	DrawHeader('SUCCESSFULLY VOTED');
?>

	<tr>
		<td colspan="2" align="center">
		<div style="background-image:url(Images/Tackle.png); padding:5px; font-size:13px; height:20px; font-weight:bold; color:Red">
			YOU HAVE SUCCESSFULLY CAST YOUR VOTE
		</div>
		<!-- Start ContentPlaceHolder -->
			<table width="100%" height="300px">
				<tr>
					<td align="center">
						<div style="width:70%; height:170px; background-image:url(Images/1.jpg); padding:10px; font-weight:bold;" id="table">
							<img src="Images/congratstext.gif"><BR>
							THANK YOU <span style="color:Red;"><?php  echo $_SESSION['studN'];?></span><br>
							FOR PARTICIPATING IN THE VOTING EXERCISE<BR>
							YOUR VOTE WILL BE KEPT CONFIDENTIAL<BR><BR>
							<span style="color:Red;">Please leave the Computer for the next Voter</span>
						</div>
					</td>
				</tr>
				<tr>
					<td align="center">
						<img src="Images/i-voted-today.gif" width="146" height="148"/>
					</td>
				</tr>
			</table>
		<!-- End ContentPlaceHolder -->
		</td>
	</tr>

<?php
	Footer();
	
	if(isset($_SESSION['regNo']))
		unset($_SESSION['regNo']);
	
	if(isset($_SESSION['studN']))
		unset($_SESSION['studN']);
	
	//session_destroy();
?>
