<link rel="stylesheet" type="text/css" href="../stylesheet.css"/>
<?php
	
	include('../functions.inc.php');
	
	$query = mysql_query("SELECT * FROM Candidate WHERE CandidateID = '".$_GET['XYZ']."'");
	$q2 = mysql_query("SELECT * FROM Posts");
	
	$Start = 1;
	
	if(isset($_POST['Update']))
	{
		$N = strtoupper($_POST['CN']);
		$M = $_POST['Pos'];
		
		mysql_query("UPDATE Candidate SET CandidateName = '$N', PostID = '$M' WHERE CandidateID = '".$_GET['XYZ']."'");
		$Start = 2;
	}
	
	if($Start == 1)
	{
		if(mysql_num_rows($query) > 0)
		{
			$row1 = mysql_fetch_row($query);
			?>
				<h4>EDITING CANDIDATE BASIC INFORMATION</h4>
				<hr>
				<form action="<?php $_SERVER['PHP_SELF'];?>" method="post">
					<table id="table" width="80%" cellpadding="8px" cellspacing="8px">
						<tr>
							<td>
								<b>Candidate Name</b>
							</td>
							<td>
								<input type="text" size="50" style="font-size:11px;" value="<?php  echo $row1[1]; ?>" name="CN" />
							</td>
						</tr>
						<tr>
							<td>
								<b>Post</b>
							</td>
							<td>
								<select name="Pos" style="font-size:11px; width:350px;">
									<?php
										while($Row = mysql_fetch_row($q2))
										{
											if($Row[0] == $row1[2])
												echo '<option value='.$Row[0].' selected=selected>'.$Row[1].'</option>';
											else
												echo '<option value='.$Row[0].'>'.$Row[1].'</option>';
										}
									?>
								</select>
							</td>
						</tr>
						<tr>
							<td></td>
							<td><input type="submit" value="update" name="Update" style="font-size:11px;"/></td>
						</tr>
					</table>
				</form>
			<?php
		}
		else
			echo '<h4>There is No Candidate to Edit</h4><br>';
	}
	else
	{
		echo '<h4>UPDATE SUCCESSFULL</h4><br>Candidate Data was updated Successfully.';
		echo ' <a href=ViewCandidate.php target=Content> << Back to Candidate List</a>';
	}
?>