<?php
	
	include('../functions.inc.php'); 
	DrawHeader('RESULTS MENU');
	
	unset($_SESSION['Sch']);
	
	if(!isset($_SESSION['Rez']))
		header('Location:/etov/Results/');
?>
	<tr>
		<td colspan="2">
		<div style="background-image:url(../Images/Tackle.png); padding:5px; font-size:13px; height:20px; font-weight:bold; color:Red">
			<a href="/etov/">HOME</a><span id="Entry"> &raquo; <span id="Entry"> RESULTS' POSTS MENU</span>
		</div>
		<!-- Start ContentPlaceHolder -->
		<table height="300px" width="100%" style="background-color:#FFF;">
			<tr>
				<td valign="middle" align="center">
					<h4>LIST OF POSTS BEING CONTESTED FOR</h4><hr style="text-align:center; width:50%;">
					<span style="color:Red; font-weight:bold; font-size:11px;">INSTRUCTIONS : CLICK ON THE POST TO VIEW FINAL RESULTS</span><br><br>
					<?php
						//$query = mysql_query("SELECT PostID, PostName, Rank, ".
						//					 "(SELECT COUNT(*) FROM Candidate V WHERE V.PostID = P.PostID) FROM Posts P ORDER BY Rank DESC");
						
						$query = mysql_query(
							"SELECT P.PostID, PostName, Rank, CAST(GROUP_CONCAT(CandidateID) AS CHAR(90)) AS CandID".
							" FROM Posts P JOIN Candidate C ON P.PostID = C.PostID".
							" ORDER BY Rank, P.PostID, PostName");
						
						$i = 1;
						echo '<table border=0 cellspacing=5 cellpadding=5 style=font-size:16px>';
						while($row = mysql_fetch_row($query))
						{
							//echo '<b>'.$i.'. <a href=Results.php?cgi='.$row[0].' target=_blank>'.$row[1].'</a> ('.$row[3].')</b><br>';
							$C = explode(",", $row[3]);
							$CandNo = 0;
							
							foreach($C as $Do)
								$CandNo += 1;
							
							echo '<tr>';
								echo '<td align=center valign=middle>';
									echo '<b>'.$i.'. <a href=Results-'.$row[0].'.htm target=_blank title=\'CLICK TO VIEW DETAILS FOR POST OF '.$row[1].' \' >'
										 .$row[1].'</a> ('.$CandNo.')</b>';
								echo '</td>';
								echo '<td>';
									echo '<a href=Graph-'.$row[0].'.htm target=_blank>'.
								 		'<img src=Images/graph_icon.gif height=25px title=\'VIEW GRAPH FOR POST OF ' .
										$row[1].'\' width=25px style=border-width:0px;/></a></b> ';
								 echo '</td>';
							echo '</tr>';
							$i += 1;
						}
						echo '</table>';
					?>
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
	//unset($_SESSION['Rez']);
?>