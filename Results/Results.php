<style>
	.BoldWinner
	{
		color:Red;
		font-weight:bold;
		font-size:20px;
	}
</style>

<?php

	//echo 'http://'.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
	//if(!isset($_SESSION['UserN']))
	//	header('location:login.php');

	//header("Refresh: 5;");
	include('functions.inc.php');
	include('../config1.php');
	
	if(!isset($_SESSION['Rez']))
		header('Location:/etov/Results/');
	
	$P = $_GET['cgi'];
	$result = mysql_query("SELECT PostName FROM Posts WHERE PostID = '$P'");
	$row = mysql_fetch_row($result);
	
	//Read the Total Number of Successful Voters
	$K = mysql_fetch_row(mysql_query('SELECT COUNT(DISTINCT(stud_reg_no)) FROM casts'));
	if($K[0] == 0)
		$KL = 1;
	else
		$KL = $K[0];
	
	DrawHeader('VIEWING RESULTS FOR '.$row[0]);
	$Col = array();
	
	function FetchWinner($Cid, $TVS)	//Read in the CandidateID and the Total Number of Votes that they have got....In this Case the Winner
	{
		//Fetch the Winners Photo and Results Displayed - In this Case, the Only Candidate
		$WinnerRow = mysql_fetch_row(mysql_query("SELECT * FROM Candidate WHERE CandidateID = '".$Cid."'"));
		echo '<tr style=background-color:Black;color:White;font-size:18px;>';
			echo '<td colspan=3 align=center height=30px><blink><b>WINNER</b></blink></td>';
		echo '</tr>';
		echo '<tr>';
			echo '<td align=left valign=top><img src=../Images/fire.gif width=200px height=200px/></td>';
			echo '<td align=center valign-middle>';
				echo '&nbsp;&nbsp;<img src='.$WinnerRow[3].' height=200px width=200px title="THE WINNER IS '.$WinnerRow[1].'" /><br><br>';
				echo '<b>WINNER : <span class=BoldWinner>'.$WinnerRow[1].'</span> - VOTE(S) : <span class=BoldWinner>'.$TVS.' </span></b>';
			echo '</td>';
			echo '<td align=right valign=top><img src=../Images/fire.gif width=200px height=200px/></td>';
		echo '</tr>';
	}
?>
	<tr>
		<td colspan="2" align="center">
			<div style="background-image:url(../Images/Tackle.png); padding:5px; font-size:15px; height:20px; font-weight:bold; color:Red">
				<?php echo 'VIEWING RESULTS FOR THE POST OF '.$row[0];?>
			</div>
		<!-- Start ContentPlaceHolder -->
		<table width="100%" bgcolor="#FFFFFF">
			<tr>
				<td valign="top">
                	<div id="ReloadDiv">
					<div id="table" style="margin-bottom:2px; background-image:url(../Images/1.jpg); background-repeat:repeat;">
						<?php
							$Result2 = mysql_query("SELECT * FROM candidate WHERE PostID = '$P' ORDER BY CandidateName ASC");
							if(mysql_num_rows($Result2) > 0)
							{
								?>
									<table width="100%" cellpadding="2" cellspacing="2">
										<tr>
											<?php
												$Wid = 100 / mysql_num_rows($Result2); //This is to Determine an Equal width to all the Cells
												
												$i = 0; //This will help build the two-dimensional Array to Determine winner
												
												while($Row2 = mysql_fetch_row($Result2))
												{
													echo '<td align=center width='.$Wid.'% id=table>';
													echo '<img src='.$Row2[3].' height=150px width=150px title="'.$Row2[1].'" /><br>';
													echo '<b style=font-size:9px><span style=font-size:12px;>'.$Row2[1].'</span><br>';
													
													//Get the Number of votes for the Currently Printing Candidate
													$Result3 = mysql_query("SELECT COUNT(*) FROM Casts WHERE CandidateID = '".$Row2[0]."'");
													$Row3 = mysql_fetch_row($Result3);
													echo '<span style=font-size:20px;passing-top:2px;color:Red>TOTAL VOTES : '.$Row3[0].'</span></br>';
													$TV = $Row3[0];
													
													$Col[$i][0] = $Row3[0]; //Load the Current Candidate Total Votes
													$Col[$i][1] = $Row2[0]; //Load the Current CandidateID
													
													$str = "SELECT COUNT(*) FROM Casts C JOIN votestudents V ON ".
														   "V.stud_reg_no = C.stud_reg_no WHERE CandidateID = '".$Row2[0]."' AND stud_sex = 'MALE'";
													
													$str2 = "SELECT COUNT(*) FROM Casts C JOIN votestudents V ON ".
														   "V.stud_reg_no = C.stud_reg_no WHERE CandidateID = '".$Row2[0]."' AND stud_sex = 'FEMALE'";
													
													$Row4 = mysql_fetch_row(mysql_query($str));
													echo '<span style=font-size:15px;padding-top:2px;color:Green>MALE VOTERS : '.$Row4[0].'<br>';
													$Row5 = mysql_fetch_row(mysql_query($str2));
													echo 'FEMALE VOTERS : '.$Row5[0].'<br>';
													echo 'PERCENTAGE : '.round(($TV / $KL) * 100, 2).' %</span>';
													
													$i += 1;
												}
											?>
										</tr>
									</table>
								<?php
							?>
						</div>
						<!-- The Winners Section Table-->
						<div id="table" style="height:280px; margin-bottom:8px; background-image:url(../Images/1.jpg); background-repeat:repeat;">
							<table width="100%" border="0" cellpadding="0" cellspacing="0">
								<?php
									if(count($Col) >= 2)
									{
										//First Sort the Array
										sort($Col);
										
										//Then Check if the Last Value (Total Votes) of the Array is the same as its second last to the left
										//If yes, then there is no winner
										$K = count($Col) - 1;
										
										if($Col[$K - 1][0] == $Col[$K][0])
										{
											echo '<tr><td align=center valign-middle height=250px>';
											echo '<b style=color:Red;font-size:20px>SAME VOTE COUNT. NO WINNER</b>';
											echo '</td></tr>';
										}
										else
										{
											//Fetch the Winners Photo and Results Displayed - In this Case, all the Candidates on the Post
											//Fetch the Last Candidate in the Array after Sorting the Array
											FetchWinner($Col[$K][1], $Col[$K][0]);
										}
									}
									else
									{
										//Fetch the Winners Photo and Results Displayed - In this Case, the Only Candidate
										FetchWinner($Col[0][1], $Col[0][0]);
									}
								?>
							</table>
						</div>
					<?php
					}
						else
							echo '<br><br><center><b style=font-size:15px;color:Blue;>There are No Candidates to Display in this Post yet</b></center><br><br><br>';
					?>
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
