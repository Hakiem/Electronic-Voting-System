<!--This is a collection of the E-Ballot Paper-->
<script type="text/javascript">
	function toggle()  
	{  
		if(window.confirm('Are you sure those are the candidates of your choice?') == true)
			return true;
		else
			return false;
	} 

</script>

<?php

	include('functions.inc.php');
	
	if(!isset($_SESSION['regNo']) || !isset($_SESSION['studN']))
		header('location:index.htm');

	$VoterRegNo = $_SESSION['regNo']; 		// Grab the Voter RegNo from a session
	$UserIP = $_SERVER['REMOTE_ADDR']; 		// Grab the Computer IP Address of the current the Remote Voter

	DrawHeader($_SESSION['studN'].' : E-BALLOT PAPER');
	
	mysql_query("UPDATE votestudents SET AccessedBallotPaper = 1 WHERE stud_reg_no = '".$_SESSION['regNo']."'");
	
	$S = '';
	
	if(isset($_POST['Submit']))
	{
		$PostsContainer = $_SESSION['Posts']; 	// Grab the Session that Contains the Posts that have been Displayed
		
		//Loop through the Posts to Initialize an Insertion
		for($i = 0; $i < count($PostsContainer); $i++)
		{
			$pid = $PostsContainer[$i];	//Grab the PostID
			//Use the $pid variable to Grab which Candidate was Checked in that post
			if(isset($_POST[$pid]))
				$CC = $_POST[$pid]; 
			else
				$CC = '0';
			
			$S .= "('$VoterRegNo', '$pid', '$CC', '$UserIP'),";
		}
		
		mysql_query("INSERT INTO Casts (stud_reg_no, PostID, CandidateID, ComputerIP) VALUES ".rtrim($S, ','));
		
		if(mysql_affected_rows() > 0)
		{
			mysql_query("UPDATE votestudents SET HasVoted = 1, TimeVoted = NOW() WHERE stud_reg_no = '".$_SESSION['regNo']."'");
			
			//Prepare Variables to insert into the Events Log Table
			$Desc = strtoupper($_SESSION['studN'].' has Voted Successfully ON '.$_SERVER['REMOTE_ADDR']);
			$Cat = 'Voter';
			mysql_query("INSERT INTO log (EventDesc, CompIP, Cat) VALUES ('$Desc', '$UserIP', '$Cat')");
			unset($_SESSION['Pos']);	//Unset the Session that keeps the Posts viable to be voted for by the current voter
			header('location:thankyou.htm');
		}
	}
	echo mysql_error();
?>
<style>
	input.noimage {
		background-color: #006;
		border: 2px outset #03f;
		color: #fff;
		padding: 4px;
		margin-left: 2px;
		font-size:25px;
	}
	input.noimage:hover {
		background-color:#00CC00;
		border: 2px outset #03f;
		color: #fff;
		padding: 4px;
		margin-left: 2px;
	}
	
	.RadioButt, input.radio
	{
		width: 50px; 
		height: 50px;
		border-bottom:solid 1px Black;
		zoom:200%;
	}
	.Col {background-color:#FFFFCC;}
	.backColor{background-color:#FFFFCC;}

</style>
<tr>
	<td colspan="2">
	<div style="background-image:url(Images/Tackle.png); padding:5px; font-size:13px; height:20px; font-weight:bold; color:Blue">
		<?php  echo Hours($_SESSION['studN'], $_SESSION['G']).' : WELCOME TO OUR E-VOTING SYSTEM';?>
	</div>
	<!-- Start ContentPlaceHolder -->
		<form action="<?php $_SERVER['PHP_SELF'];?>" method="post" id="form1">
			<div>
				<br />
				<input name="Submit" type="submit" value="Click To Submit Ballot Paper" 
					class="noimage" onclick="CheckCheckboxes();" title="CLICK THIS AREA TO CAST YOUR VOTE" />
				&nbsp;&nbsp;
				<span style="color:Red; font-weight:bold; font-size:15px;"><blink>VOTE ONE CANDIDATE PER POST</blink></span>
				<br /><br />
			</div>
			<?php
				if(isset($_SESSION['Pos']))
				{
					$Fb = "SELECT * FROM Posts ".$_SESSION['Pos']." ORDER BY Rank ASC";
					$Result1 = mysql_query($Fb);
				}
				else
					$Result1 = mysql_query("SELECT * FROM Posts ORDER BY Rank ASC");
					
				$i = 1;
				if(mysql_num_rows($Result1) > 0)
				{
					//An Array to keep the PostID's of the Currently Displayed Posts NB. its outside the While Loop to aboid overlooping it
					$PostsArray = array(); 
					while($Row1 = mysql_fetch_row($Result1))
					{
						//The PostID of every post is loaded into the Loop
						$PostsArray[] = $Row1[0]; 
						echo '<b>POST#'.$i.' : '.$Row1[1].'</b><br>';
						
						?>
							<div id="table" 
                            style="height:250px; margin-bottom:2px; background-image:url(../Images/1.jpg); background-repeat:repeat; background-color:#FFF;">
								<!--<div id="table" style="height:350px; margin-bottom:3px;">-->
								<?php
									$Result2 = mysql_query("SELECT * FROM candidate WHERE PostID = '".$Row1[0]."' ORDER BY CandidateName ASC");
									if(mysql_num_rows($Result2) > 0)
									{
										?>
											<input type="checkbox" id="<?php echo $Row1[0].'V'; ?>" style="display:none;" name="Poss[]" />
											<table width="100%" cellpadding="3" cellspacing="3" id="CandTable">
												<tr class="radios" onclick="document.getElementById('<?php echo $Row1[0].'V'; ?>').checked=1" >
													<?php
														$Wid = 100 / mysql_num_rows($Result2);
														while($Row2 = mysql_fetch_row($Result2))
														{
															echo '<td align=center width='.$Wid.
																'% id=table onclick=ClickCell('.$Row2[0].'); >';
															echo '<input type=radio name='.$Row1[0].' value='.$Row2[0].' id='.$Row2[0].' class=RadioButt />';
															echo '<img src='.$Row2[4].' height=210px width=210px title="CLICK THIS PICTURE TO VOTE FOR '.
															      $Row2[1].'" class=tooltip ><br>';
															echo '<b style=font-size:20px;font-weight:bold>'.$Row2[1].'</b>';
															echo '</td>';
														}
													?>
												</tr>
											</table>
										<?php
									}
									else
										echo '<br><br><center><b style=font-size:10px;color:Blue;>There are No Candidates in this Post yet</b></center>';
								?>
							</div>
							<br /><br />
						<?php
						$i += 1;
					}
					//After Loading the Posts into an Array, Fix them into a Session.They will be used later on for processing insertions
					$_SESSION['Posts'] = $PostsArray;
				}
				else
					echo '<br><br><center><b>There are not Posts Captured yet</b></center>';
			?>
		</form>
	<!-- End ContentPlaceHolder -->
	</td>
</tr>

<?php
	Footer();
?>
