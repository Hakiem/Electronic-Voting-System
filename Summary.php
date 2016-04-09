<?php
	header("Refresh: 5;");

	include('functions.inc.php');
	include('config1.php');
	
	DrawHeader('GENERAL ELECTION VOTERS SUMMARY : ');
	if(!isset($_SESSION['UserN']))
		header('location:login.php');
		
	$result = $mysqli->query('CALL Summary()');
	$row = $result->fetch_array(MYSQLI_NUM);
?>

	<tr>
		<td colspan="2">
		<div style="background-image:url(Images/Tackle.png); padding:5px; font-size:20px; height:20px; font-weight:bold; color:Red; text-align:center">
			GENERAL ELECTION VOTERS SUMMARY<?php echo ' :: '.date("l F j, Y");?>
		</div>
		<!-- Start ContentPlaceHolder -->
		<table width="100%" style="background-color:#FFF;">
			<tr>
				<td valign="top">
					<div>
						<table width="100%" cellpadding="8" cellspacing="0" id="table" border="1" style="font-weight:bold;">
							<tr style="background-color:#000000; color:#FFFFFF; font-weight:bold;">
								<td width="55%">CRITERIA</td>
								<td width="15%" align="center">MALE</td>
								<td width="15%" align="center">FEMALE</td>
								<td width="15%" align="center">TOTAL</td>
							</tr>
							<tr>
								<td>REGISTERED VOTERS</td>
								<td align="center"><?php echo $row[0]; ?></td>
								<td align="center"><?php echo $row[1]; ?></td>
								<td align="center"><?php echo $row[0] + $row[1]; ?></td>
							</tr>
							<tr>
								<td>VOTERS THAT HAVE TURNED UP</td>
								<td align="center"><?php echo $row[2]; ?> </td>
								<td align="center"><?php echo $row[3]; ?> </td>
								<td align="center"><?php echo $row[2] + $row[3]; ?> </td>
							</tr>
							<tr>
								<td>VOTERS THAT HAVE <span style="color:Red; font-weight:bold;">NOT</span> TURNED UP</td>
								<td align="center"><?php echo $row[4]; ?></td>
								<td align="center"><?php echo $row[5]; ?></td>
								<td align="center"><?php echo $row[4] + $row[5]; ?></td>
							</tr>
							<tr>
								<td>GOT ACCESS-CODE BUT HAVN'T CASTED YET</td>
								<td align="center"><?php echo $row[6]; ?></td>
								<td align="center"><?php echo $row[7]; ?></td>
								<td align="center"><?php echo $row[6] + $row[7]; ?></td>
							</tr>
							<tr>
								<td>ACCESSED E-BALLOT, NOT CASTED YET</td>
								<td align="center"><?php echo $row[8]; ?></td>
								<td align="center"><?php echo $row[9]; ?></td>
								<td align="center"><?php echo $row[8] + $row[9]; ?></td>
							</tr>
							<tr>
								<td>VOTERS WHO HAVE VOTED SUCCESSFULLY</td>
								<td align="center"><?php echo $row[10]; ?></td>
								<td align="center"><?php echo $row[11]; ?></td>
								<td align="center"><?php echo $row[10] + $row[11]; ?></td>
							</tr>
							<tr>
								<td colspan="2" align="right">GENERAL PERCENTAGE</td>
								<td colspan="2" align="left"><?php echo $row[12].'%';  ?></td>
							</tr>
							<tr>
								<td colspan="4" style="font-size:25px;font-weight:bold; color:Red;">
									<?php echo 'TOTAL VOTES IN THE E-BALLOT BOX : '.$row[13]; ?>
								</td>
							</tr>
						</table>
					</div>
				</td>
			</tr>
			<!--
			<tr height="80px">
				<td align="right">
					<img src="Images/3.gif" height="80px" width="80px" />
				</td>
			</tr>
			-->
		</table>
		<!-- End ContentPlaceHolder -->
		</td>
	</tr>

<?php
	Footer();
?>
