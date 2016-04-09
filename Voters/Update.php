<link href="../stylesheet.css" rel="stylesheet" type="text/css"/>
<?php
	include('../functions.inc.php');
	$R = $_GET['RegN'];
	$result = mysql_query("SELECT * FROM votestudents WHERE stud_reg_no = '$R'");
	$row = mysql_fetch_row($result);
	
	if(isset($_POST['Updet']))
	{
		$VN = $_POST['Nem'];
		$SX = $_POST['G'];
		mysql_query("UPDATE votestudents SET stud_name = '$VN', stud_sex = '$SX' WHERE stud_reg_no = '$R'");
		$result = mysql_query("SELECT * FROM votestudents WHERE stud_reg_no = '$R'");
		$row = mysql_fetch_row($result);
		header($_SERVER['PHP_SELF']);
		
		if(mysql_affected_rows() == 1)
			$Msg = 'Voter Data Updated Successfully';
		else
			$Msg = 'Error : '.mysql_error();
		
	}
	if(isset($_POST['canc']))
	{
		header('location:EditVoter.php');
	}
	
?>
<table width="100%">
	<tr>
		<td>
			<form action='<?php $_SERVER['PHP_SELF']; ?>' method="post">
				<table width="100%" border="1" cellpadding="5px" cellspacing="5px">
					<tr>
						<td>
							<b>Registration No.</b>
						</td>
						<td>
							<b style="font-style:italic">
								<?php echo $row[0];?>
							</b>
						</td>
					</tr>
					<tr>
						<td>
							<b>Student Name</b>
						</td>
						<td>
							<input type="text" value="<?php echo $row[1];?>" name="Nem" size="80px" style="font-size:12px; background-color:#FFFFCC;" />
						</td>
					</tr>
					<tr>
						<td>
							<b>Gender</b>
						</td>
						<td>
							<?php
								if ($row[2] == 'MALE') 
								{
									$M = 'selected';
									$F = '';
								}
								else
								{
									$M = '';
									$F = 'selected';
								}
							?>
							<select name="G" style="font-size:12px" onchange="this.submit()">
								<option <?php echo $M; ?> value="MALE">MALE</option>
								<option <?php echo $F; ?> value="FEMALE">FEMALE</option>
							</select>
						</td>
					</tr>
					<tr>
						<td>.</td>
						<td>
							<input type="submit" value="Update Voter Data" name="Updet" style="font-size:12px;"/>
                            <input type="submit" value="Cancel" name="canc" style="font-size:12px;"/>
						</td>
					</tr>
					<?php
						if(isset($Msg))
						{
							?>
								<tr>
									<td>.</td>
									<td>
										<span style="font-size:14px; color:Red; font-weight:bold;">
											<?php echo $Msg; ?>
										</span>
									</td>
								</tr>
							<?php
						}
					?>
				</table>
			</form>
		</td>
	</tr>
</table>