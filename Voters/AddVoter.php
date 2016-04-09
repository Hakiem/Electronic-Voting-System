<link rel="stylesheet" type="text/css" href="../stylesheet.css"/>
<?php

	include('../functions.inc.php');
	if(isset($_POST['Reg']))
	{
		if(empty($_POST['RegNo']) || empty($_POST['name']))
		{
			$Msg = 'Unique Registration Number and Name Needed';
		}
		else
		{
			$R = $_POST['RegNo'];
			$N = strtoupper($_POST['name']);
			$G = $_POST['Gen'];
			
			$result = mysql_query("INSERT INTO votestudents (stud_reg_no, stud_name, stud_sex) VALUES ('$R', '$N', '$G')");
			if(mysql_affected_rows() == 1)
				$Msg = 'VOTER REGISTERED SUCCESSFULLY';
			else
				$Msg = 'STUDENT WASN\'T SUCCESSFULLY REGISTERED WITH REGISTRATION NO <span style=color:Blue>['.$R
					.']</span>. <br> USE A UNIQUE NON-EXISTING REGISTRATION No FROM THE CURRENT REGISTER';
		}
	}
		
?>
<h4>ADD A NEW VOTER TO THE VOTERS REGISTER</h4>
<form id="form1" action="<?php $_SERVER['PHP_SELF'];?>" method="post">
	<table id="table" width="100%" cellpadding="8" cellspacing="8" style="font-size:13px;">
		<?php
			if(isset($Msg))
				print '<tr><td colspan=2 align=center style=color:Red;font-weight:bold;font-size:12px>'.$Msg.'</td></tr>';
		?>
		<tr>
			<td width="30%"><b>REGISTRATION NUMBER</b></td>
			<td width="70%"><input type="text" name="RegNo" size="60px" ></td>
		</tr>
		<tr>
			<td><b>STUDENT NAME</b></td>
			<td><input type="text" name="name" size="60px" ></td>
		</tr>
		<tr>
			<td><b>GENDER</b></td>
			<td>
				<select name="Gen" style="width:150px; font-size:11px; height:20px;">
					<option value="MALE">MALE</option>
					<option value="FEMALE">FEMALE</option>
				</select>
			</td>
		</tr>
		<tr>
			<td></td>
			<td><input type="submit" name="Reg" value="Register Student" style="font-size:12px;"/></td>
		</tr>
	</table>
</form>