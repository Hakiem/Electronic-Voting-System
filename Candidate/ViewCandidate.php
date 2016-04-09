<?php
	include('../config.php');
	
	if(isset($_GET["XYZ"]))
	{
		//First Delete the Candidate Image from the Folder
		$Riz = mysql_query("SELECT ImageURL FROM Candidate WHERE CandidateID = '".$_GET['XYZ']."'");
		$V = mysql_fetch_row($Riz);
		if(is_file($V[0]))
			unlink($V[0]);
		
		//Then Delete the whole Candidate
		mysql_query("DELETE FROM Candidate WHERE CandidateID = '".$_GET['XYZ']."'");
	}
?>
<link rel="stylesheet" type="text/css" href="../stylesheet.css"/>
<script type="text/javascript" src="../Scripts/javascripts.js"></script>
<?php
	$Result1 = mysql_query("SELECT * FROM Posts ORDER BY Rank ASC");
	echo '<h4>VIEW CANDIDATES PER POST ('.mysql_num_rows($Result1).' Posts)</h4><hr>';
	$i = 1;
	if(mysql_num_rows($Result1) > 0)
	{
		while($Row1 = mysql_fetch_row($Result1))
		{
			echo '<b>POST#'.$i.' : '.$Row1[1].'</b><br>';
			?>
				<div id="table" style="height:150px; margin-bottom:8px; background-image:url(../Images/1.jpg); background-repeat:repeat;">
					<?php
						$Result2 = mysql_query("SELECT * FROM candidate WHERE PostID = '".$Row1[0]."' ORDER BY CandidateName ASC");
						if(mysql_num_rows($Result2) > 0)
						{
							?>
								<table width="100%" cellpadding="3" cellspacing="3">
									<tr>
										<?php
											$Wid = 100 / mysql_num_rows($Result2);
											while($Row2 = mysql_fetch_row($Result2))
											{
												echo '<td align=center width='.$Wid.'%>';
												echo '<img src='.$Row2[3].' height=100px width=100px /><br>';
												echo '<b style=font-size:10px><span style=font-size:12px;>'.$Row2[1].'</span><br>';
												echo '<a href=Edit.php?XYZ='.$Row2[0].' target=Content>Edit</a> | ';
												echo '<a href=ViewCandidate.php?XYZ='.$Row2[0].' onclick=return ValidatePermission()>Remove</a>';
												echo '</b></td>';
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
			<?php
			$i += 1;
		}
	}
	else
		echo '<br><br><center><b>There are not Posts Captured yet</b></center>';
?>