<?php
	include('functions.inc.php');
	DrawHeader('ADMINISTRATOR HOME');
	if(!isset($_SESSION['UserN']))
		header('location:login.php');
?>

	<tr>
		<td colspan="2">
		<div style="background-image:url(Images/Tackle.png); padding:5px; font-size:13px; height:20px; font-weight:bold; color:Red">
			<?php echo 'Welcome '.$_SESSION['UserN'].' | Your Role : '.$_SESSION['Role'].' | <a href=logout.htm>Logout</a>';?>
		</div>
		<!-- Start ContentPlaceHolder -->
		<table width="100%">
			<tr>
				<td valign="top" style="background:#FFF;">
					<div>
						<table border="1" height="500px" width="100%" style="background-color:#FFF;">
							<tr>
								<td width="20%" style="border:solid 1px Green; font-size:11px; margin-top:10px;" valign="top">
									<div id="navigation">
										<ul>
											<li><a href="#">Event Logs</a>
												<ul>
													<li><a href="Events/Voters.php" target="Content">Voters Events</a></li>
													<li><a href="Events/Staff.php" target="Content">Staff Events</a></li>
												</ul>
											</li>
											<li><a href="#">Agents</a>
												<ul>
													<li><a href="PollingAgents/Default.php" target="Content">View All Agents</a></li>
													<li><a href="PollingAgents/AddAgent.php" target="Content">Add Agent</a></li>
												</ul>
											</li>
											<li><a href="#">Posts</a>
												<ul>
													<li><a href="Post/AddPost.php" target="Content">View/Add Posts</a></li>
													<li><a href="Post/PostsCandidates.php" target="Content">Posts and Candidates</a></li>
													<!--<li><a href="Post/PostsCriteria.php" target="Content">Posts Voting Criteria</a></li>-->
												</ul>
											</li>
											<li><a href="#">Candidates</a>
												<ul>
													<li><a href="Candidate/ViewCandidate.php" target="Content">View All Candidates</a></li>
													<li><a href="Candidate/AddCandidate.php" target="Content">Add New Candidate</a></li>
												</ul>
											</li>
											<li><a href="#">Voters</a>
												<ul>
													<li><a href="Voters/VoterLists.php" target="Content">Voters' lists</a></li>
													<li><a href="Voters/AddVoter.php" target="Content">Add New Voter</a></li>
													<li><a href="Voters/EditVoter.php" target="Content">Edit Voter</a></li>
												</ul>
											</li>
											<li><a href="#">Results Summary</a>
												<ul>
													<!--<li><a href="ResultsMenu.php" target="Content">Results Menu</a></li> -->
                                                    <!--<li><a href="ResultsMenu.php" target="Content">Results Menu</a></li> -->
													<li><a href="Summary.htm" target="_blank">General Turn-out Summary</a></li>
													<!--<li><a href="Results.htm" target="_blank">General Election Results</a></li> -->
												</ul>
											</li>
                                            <li><a href="#">Election Sureties</a>
												<ul>
                                                    <li><a href="Surety/" target="Content">Add/Edit/View all Sureties</a></li>
												</ul>
											</li>
										</ul>
									</div>
								</td>
								<td width="80%">
									<iframe width="100%" height="500px" name="Content" src="Events/Voters.php" scrolling="auto">
										<h1>
											ADMINISTRATOR'S CONTROL PANEL
										</h1>
									</iframe>
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
