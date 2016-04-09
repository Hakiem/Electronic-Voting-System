<link href="../stylesheet.css" rel="stylesheet" type="text/css"/>
<?php
	include('../functions.inc.php');
	
	if(isset($_POST['Sa']))
	{
		if(empty($_POST['Sach']))
			$result = mysql_query('SELECT stud_reg_no, stud_name, stud_sex, HasVoted FROM votestudents');
		else
			$result = mysql_query("SELECT stud_reg_no, stud_name, stud_sex, HasVoted FROM votestudents WHERE stud_name LIKE CONCAT('%', '".
								 $_POST['Sach']."', '%') OR stud_reg_no LIKE CONCAT('%', '".$_POST['Sach']."', '%')");
	}
?>
<table width="100%">
	<tr>
		<td>
			<form action='<?php $_SERVER['PHP_SELF']; ?>' method="post">
				<table width="100%">
					<tr>
						<td>
							<b>Reg No. / Name</b>
							<input type="text" size="30" name="Sach"/>
							<input type="submit" name="Sa" value="Search" style="font-size:12px;">
						</td>
					</tr>
				</table>
			</form>
		</td>
	</tr>
	<tr>
		<td>
			<?php
				if(isset($result))
				{
					if(mysql_num_rows($result) > 0)
					{
						$i = 1;
						echo '<table cellpadding=1 cellspacing=1 border=1 style=font-size:14px;width:100%;font-weight:bold;>';
						echo '<tr bgcolor=Black style=color:White;font-weight:bold:font-size:17px;height:20px>';
						echo '<th>_</th><th></th><th>REGISTRATION NO.</th><th>NAME.</th><th>GENDER</th><th>HAS VOTED?</th>';
						while($row = mysql_fetch_row($result))
						{
							if(($i % 2) == 0)
								$bgc = '#FFFFCC';
							else
								$bgc = '#FFFFFF';
							
							if($row[3] == 1)
								$bgc = '#CCFFCC';
							
							echo '<tr bgcolor='.$bgc.'>';
								echo '<td style=width:5%>&nbsp;&nbsp;'.$i.'.</td>';
								echo '<td><a href=Update.php?RegN='.$row[0].'>Edit</a></td>';
								echo '<td style=width:25%>&nbsp;&nbsp;'.$row[0].'</td>';
								echo '<td style=width:40%>&nbsp;&nbsp;'.$row[1].'</td>';
								echo '<td style=width:15%;text-align:center>&nbsp;&nbsp;'.$row[2].'</td>';
								if($row[3] == 1)
									$Ans = 'Yes';
								else
									$Ans = 'No';
								echo '<td style=width:15%;text-align:center>&nbsp;&nbsp;'.$Ans.'</td>';
							echo '</tr>';
							$i += 1;
						}
						echo '</table>';
					}
					else
						echo '<span style=text-align=center;font-size:10;color:Red;font-weight:bold><br>'.
							 '<Br>THERE ARE NOT RECORDS THAT SATISFY THE SEARCH CRITERIA</span>';
				}
			?>
		</td>
	</tr>
</table>