<?php
	include('../functions.inc.php');
?>
<link rel="stylesheet" type="text/css" href="../stylesheet.css"/>
<?php
	$Result1 = mysql_query("SELECT * FROM Posts ORDER BY Rank ASC");
	echo '<h4>VIEW CANDIDATES PER POST ('.mysql_num_rows($Result1).' Posts)</h4><hr>';
	$i = 1;
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
											echo '<b><a href=CandidateDetails.php?XY='.$Row2[0].'>'.$Row2[1].'</a></b>';
											echo '</td>';
										}
									?>
								</tr>
							</table>
						<?php
					}
					else
						echo '<br><center><b style=font-size:9px;color:Blue;>There are No Candidates in this Post yet</b></center>';
				?>
			</div>
		<?php
		$i += 1;
	}
?>