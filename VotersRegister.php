
<?php
	header("Refresh: 5;");
	include('functions.inc.php');
	DrawHeader('VOTERS THAT HAVE VOTED SUCCESSFULLY');
	$result = mysql_query("SELECT * FROM votestudents");
?>

	<tr>
		<td colspan="2">
		<div style="background-image:url(Images/Tackle.png); padding:5px;font-size:13px; height:20px; font-weight:bold; color:Red;text-align:center;">
			<?php 
				echo 'VOTERS REGISTER (TOTAL : '.mysql_num_rows($result).')';
			?>
		</div>
		<!-- Start ContentPlaceHolder -->
			<?php
				if(mysql_num_rows($result) > 0)
				{
					$i = 1;
					echo '<table cellpadding=1 cellspacing=1 border=1 style=font-size:14px;width:100%;font-weight:bold;>';
					echo '<tr bgcolor=Black style=color:White;font-weight:bold:font-size:17px;height:20px>';
					echo '<th>_</th><th>VOTER\'S REGISTRATION NO.</th><th>VOTER\'S NAME.</th><th>VOTER\'S GENDER</th>';
					while($row = mysql_fetch_row($result))
					{
						if(($i % 2) == 0)
							$bgc = '#FFFFCC';
						else
							$bgc = '#FFFFFF';
						
						echo '<tr bgcolor='.$bgc.'>';
							echo '<td style=width:5%>&nbsp;&nbsp;'.$i.'.</td>';
							echo '<td style=width:25%>&nbsp;&nbsp;'.$row[0].'</td>';
							echo '<td style=width:55%>&nbsp;&nbsp;'.$row[1].'</td>';
							echo '<td style=width:15%;text-align:center>&nbsp;&nbsp;'.$row[2].'</td>';
						echo '</tr>';
						$i += 1;
					}
					echo '</table>';
				}
				else
					echo '<h6 style=text-align:center>THERE ARE NO RECORDS YET</h6><hr>';
			?>
		<!-- End ContentPlaceHolder -->
		</td>
	</tr>

<?php
	Footer();
?>
