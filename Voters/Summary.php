<?php
	header("Refresh: 5;");

	include('functions.inc.php');
	DrawHeader('GENERAL ELECTION VOTERS SUMMARY : ');
	if(!isset($_SESSION['UserN']))
		header('location:login.php');
?>

	<tr>
		<td colspan="2">
		<div style="background-image:url(Images/flip.jpg); padding:5px; font-size:13px; height:20px; font-weight:bold; color:Red; text-align:center">
			GENERAL ELECTION VOTERS SUMMARY
		</div>
		<!-- Start ContentPlaceHolder -->
		<table width="100%">
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
								<td align="center">
									<?php
										$row = mysql_fetch_row(mysql_query("SELECT COUNT(*) FROM votestudents WHERE stud_sex = 'MALE'"));
										echo $row[0];
										$a1 = $row[0];
									?>
								</td>
								<td align="center">
									<?php
										$row = mysql_fetch_row(mysql_query("SELECT COUNT(*) FROM votestudents WHERE stud_sex = 'FEMALE'"));
										echo $row[0];
										$a2 = $row[0];
									?>
								</td>
								<td align="center">
									<?php
										echo $a1 + $a2;
										$TotalVoters = ($a1 + $a2);
									?>
								</td>
							</tr>
							<tr>
								<td>VOTERS THAT HAVE TURNED UP</td>
								<td align="center">
									<?php
										$row = mysql_fetch_row(mysql_query("SELECT COUNT(*) FROM votestudents WHERE stud_sex = 'MALE' AND HasGotCode = 1"));
										echo $row[0];
										$a1 = $row[0];
									?>
								</td>
								<td align="center">
									<?php
										$row = mysql_fetch_row(mysql_query("SELECT COUNT(*) FROM votestudents WHERE stud_sex = 'FEMALE' AND HasGotCode = 1"));
										echo $row[0];
										$a2 = $row[0];
									?>
								</td>
								<td align="center">
									<?php
										echo $a1 + $a2;
									?>
								</td>
							</tr>
							<tr>
								<td>VOTERS THAT HAVE <span style="color:Red; font-weight:bold;">NOT</span> TURNED UP</td>
								<td align="center">
									<?php
										$row = mysql_fetch_row(mysql_query("SELECT COUNT(*) FROM votestudents WHERE stud_sex = 'MALE' AND HasGotCode = 0"));
										echo $row[0];
										$a1 = $row[0];
									?>
								</td>
								<td align="center">
									<?php
										$row = mysql_fetch_row(mysql_query("SELECT COUNT(*) FROM votestudents WHERE stud_sex = 'FEMALE' AND HasGotCode = 0"));
										echo $row[0];
										$a2 = $row[0];
									?>
								</td>
								<td align="center">
									<?php
										echo $a1 + $a2;
									?>
								</td>
							</tr>
							<tr>
								<td>GOT ACCESS-CODE BUT HAVN'T CASTED YET</td>
								<td align="center">
									<?php
										$qry = "SELECT COUNT(*) FROM votestudents WHERE stud_sex = 'MALE' AND".
											   " HasGotCode = 1 AND HasVoted = 0 AND AccessedBallotPaper = 0";
										$row = mysql_fetch_row(mysql_query($qry));
										echo $row[0];
										$a1 = $row[0];
									?>
								</td>
								<td align="center">
									<?php
										$qry = "SELECT COUNT(*) FROM votestudents WHERE stud_sex = 'FEMALE' AND  HasGotCode = 1 AND ".
											   "HasVoted = 0 AND AccessedBallotPaper=0";
										$row = mysql_fetch_row(mysql_query($qry));
										echo $row[0];
										$a2 = $row[0];
									?>
								</td>
								<td align="center">
									<?php
										echo $a1 + $a2;
									?>
								</td>
							</tr>
							<tr>
								<td>ACCESSED E-BALLOT, NOT CASTED YET</td>
								<td align="center">
									<?php
										$qry = "SELECT COUNT(*) FROM votestudents where stud_sex = 'MALE' AND HasGotCode = 1".
											   " AND HasVoted = 0 AND AccessedBallotPaper = 1";
										$row = mysql_fetch_row(mysql_query($qry));
										echo $row[0];
										$a1 = $row[0];
									?>
								</td>
								<td align="center">
									<?php
										$qry = "SELECT COUNT(*) FROM votestudents where stud_sex = 'FEMALE' AND HasGotCode = 1".
											   " AND HasVoted = 0 AND AccessedBallotPaper = 1";
										$row = mysql_fetch_row(mysql_query($qry));
										echo $row[0];
										$a2 = $row[0];
									?>
								</td>
								<td align="center">
									<?php
										echo $a1 + $a2;
									?>
								</td>
							</tr>
							<tr>
								<td>VOTERS WHO HAVE VOTED SUCCESSFULLY</td>
								<td align="center">
									<?php
										$row = mysql_fetch_row(mysql_query("SELECT COUNT(*) FROM votestudents where stud_sex = 'MALE' AND HasVoted = 1"));
										echo $row[0];
										$a1 = $row[0];
									?>
								</td>
								<td align="center">
									<?php
										$row = mysql_fetch_row(mysql_query("SELECT COUNT(*) FROM votestudents where stud_sex = 'FEMALE' AND HasVoted = 1"));
										echo $row[0];
										$a2 = $row[0];
									?>
								</td>
								<td align="center">
									<?php
										echo $a1 + $a2;
										$VotedSuccess = ($a1 + $a2);
									?>
								</td>
							</tr>
							<tr>
								<td colspan="2" align="right">GENERAL PERCENTAGE</td>
								<td colspan="2" align="left"><?php echo round(($VotedSuccess / $TotalVoters) * 100, 2).'%';  ?></td>
							</tr>
							<tr>
								<td colspan="4"></td>
							</tr>
							<tr>
								<td colspan="4" style="font-size:25px;font-weight:bold; color:Red;">
									<?php  
										$row = mysql_fetch_row(mysql_query("SELECT DISTINCT(COUNT(stud_reg_no)) FROM Casts "));
										echo 'TOTAL VOTES IN THE E-BALLOT BOX : '.$row[0];
									?>
								</td>
							</tr>
						</table>
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
