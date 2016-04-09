<style type="text/css">
	input.btn {
	  color:#050;
	  font: bold 15px'trebuchet ms',helvetica,sans-serif;
	  background-color: #fed;
	}
	
	input.btnhov {
  		border-color: #c63 #930 #930 #c63;
	}
</style>
<?php
	//phpinfo();
	//exit();
	include('functions.inc.php');
	DrawHeader('HOME');
	
	//if(isset($_SESSION['regNo']))
	//	unset($_SESSION['regNo']);
	unset($_SESSION['Rez']);
	unset($_SESSION['Shu']);
	//if(isset($_SESSION['studN']))
	//	unset($_SESSION['studN']);
	
	if(isset($_POST['login']))
	{
		if(!empty($_POST['sc']))
		{
			$Code = $_POST['sc'];
			
			//Check if the current voter code has been 
			$result = mysql_query("SELECT stud_reg_no, stud_name, stud_sex FROM votestudents WHERE VoteCode = '$Code' AND HasVoted = 0");
			if(mysql_num_rows($result) == 1)
			{
				$row = mysql_fetch_row($result);
																						
				$_SESSION['Pos'] = "WHERE Standard = 'BOTH' OR Standard = '".$row[2]."'";		
				
				$_SESSION['regNo'] = $row[0];	//2. A session containging the current Voters's registration No.
				$_SESSION['studN'] = $row[1];	//3. A session containing the current Voter's Name
				$_SESSION['G'] = $row[2];	//4. A Session Containing the Current Voter's Gender
				header('location:Ballot.htm');	//Redirect the Voter to the Ballot page
			}
			else
			{
				$res = mysql_query("SELECT stud_reg_no, stud_name, TimeVoted FROM votestudents WHERE VoteCode = '$Code' AND HasVoted = 1");
				if(mysql_num_rows($res) == 1)
				{
					$r = mysql_fetch_row($res);
					$det = new DateTime($r[2]);
					$Msg = "The Code <span style=color:Black>[ ".$Code." ]</span> has already been used by <br>".$r[1]." (".$r[0].") <br> On ".
						$det->format('l j F, Y H:i:s').".";
				}
				else
					$Msg = 'Unknown Code : '.$Code;
			}
		}
		else
			$Msg = "Valid Voters Code Needed to Proceed";
	}
?>

	<tr>
		<td colspan="2">
		<div style="background-image:url(Images/Tackle.png); padding:7px; font-size:13px; height:20px; font-weight:bold; color:Red">
			<a href="login.htm">Administration</a><span id="Entry"><?php echo VitalReturns()?></span><?php echo ' | '.date("l F j, Y");?>
		</div>
		<!-- Start ContentPlaceHolder -->
		<table height="350px" width="100%" style="background-color:#FFF;">
			<tr>
				<td valign="middle" align="center">
					<div>
						<form action="<?php $_SERVER['PHP_SELF'];?>" method="post" name="Default">
							<b>
							Enter Secret Code Here
							<input type="password" size="30" name="sc" />&nbsp;<span id="errmsg"></span>&nbsp;&nbsp;
							<input type="submit" name="login" value="Proceed" 
                            	class="btn" onmouseover="this.className='btn btnhov'" onmouseout="this.className='btn'"/>
							</b>
						</form>
					</div>
				</td>
			</tr>
			<tr>
				<td align="center" style="font-size:13px;font-weight:bold; color:#FF0000;">
					<?php
						if(isset($Msg))
						{
							echo $Msg;
						}
					?>
				</td>
			</tr>
			<tr height="80px">
				<td align="right">
					<table width="100%">
						<tr>
							<td><img src="Images/evoting-logo.jpg" /></td>
							<td align="right"><img src="Images/3.gif" height="80px" width="80px" /></td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
		<!-- End ContentPlaceHolder -->
		</td>
	</tr>

<?php
	Footer();
?>
