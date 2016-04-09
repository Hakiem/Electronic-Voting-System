<?php
	include('../config.php');
	$Result = mysql_query("SELECT * FROM Posts ORDER BY Rank ASC");
	
	if(isset($_POST['Reg']))
	{
		//if(!empty($_FILES['Image']) && ($_FILES['Image']['error'] == 0)) 
		if(!empty($_FILES['image']) && !empty($_POST['CN'])) 
		{
			$uploaddir = $_SERVER['DOCUMENT_ROOT']."/etov/Images/Pass/";
			$filename = $_FILES['image']['name'];
			$path = $uploaddir.$filename;

			//Copy the file to some permanent location
			if(move_uploaded_file($_FILES['image']['tmp_name'], $path))
			{
				$C = strtoupper($_POST['CN']);
				$P = $_POST['Pos'];
				$Kp = '../Images/Pass/'.$filename;
				$Sec = 'Images/Pass/'.$filename;
				
				mysql_query("INSERT INTO candidate (CandidateName, PostID, ImageURL, SecImageURL) VALUES ('$C', '$P', '$Kp', '$Sec')");
				
				$Msg = "Candidate has been successfully Registered";
				
			}
		}
		else
			$Msg = "Image Path / Candidate Name MUST be provided";
	}
?>
<link rel="stylesheet" type="text/css" href="../stylesheet.css"/>
<script type="text/javascript" language="javascript">
	function Validate()
	{
		if(document.getElementById(CN).value == "")
		{
			window.alert("Candidate Name must be Provided");
			document.getElementById(CN).focus();
			return false;
		}
	}
</script>
<h4>ADD A CONTESTING CANDIDATE</h4>
<hr />
<br />
<form action="<?php $_SERVER['PHP_SELF'];?>" method="post" enctype="multipart/form-data">
	<table width="100%" cellpadding="8" cellspacing="8">
		<tr>
			<td align="right"><b>CANDIDATE FULL NAMES</b></td>
			<td><input type="text" name="CN" size="70" style="font-size:11px;" /></td>
		</tr>
		<tr>
			<td align="right"><b>POST</b></td>
			<td>
				<select name="Pos" style="font-size:11px; width:350px;">
					<?php
						while($Row = mysql_fetch_row($Result))
						{
							echo '<option value='.$Row[0].'>'.$Row[1].'</option>';
						}
					?>
				</select>
			</td>
		</tr>
		<tr>
			<td align="right"><b>IMAGE</b></td>
			<td>
				<input type="file" name="image" id="image" style="font-size:11px;"/>
			</td>
		</tr>
		<tr>
			<td></td>
			<td><input type="submit" name="Reg" value="Register Candidate" style="font-size:11px;" onClick="return Validate()"></td>
		</tr>
		<tr>
			<td colspan="2" align="center" style="color:#FF0000; font-size:11px;">
				<?php
					if(isset($Msg)) echo $Msg;
				?>
			</td>
		</tr>
	</table>
</form>