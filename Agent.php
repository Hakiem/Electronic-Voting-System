<script type="text/javascript" src="include/jquery-1.2.6.pack.js"></script>
<script type='text/javascript' src='include/jquery.autocomplete.pack.js'></script>
<!-- Autocomplete Formatting -->
<link rel="stylesheet" type="text/css" href="include/jquery.autocomplete.css" />
<script type="text/javascript">
	$().ready(function() {
		$("#mereg").autocomplete("include/mysql.php", {
			width: 460,
			selectFirst: false
		});
		
	});
	
	function notEmpty(elem, helperMsg){
		if(elem.value.length == 0){
			alert(helperMsg);
			elem.focus();
			return false;
		}			
		return true;
	}
</script>
<?php
	include('functions.inc.php');
	include("config1.php");
	
	DrawHeader('AGENTS HOME');
	if(!isset($_SESSION['UserN']))
		header('location:login.htm');
	
	if(isset($_POST['mereg']))
	{
		$result = $mysqli->query("CALL AccessCode('".$_POST['mereg']."', '".$_SESSION['UserN']."')");
		$row = $result->fetch_array(MYSQLI_NUM);
		$R = $row[0];
		if($R != 1)
		{
			$N = $row[1];
			$U = $row[2]; 
		}
	}
?>

	<tr>
		<td colspan="2" align="center">
		<div style="background-image:url(Images/Tackle.png); padding:5px; font-size:13px; height:20px; font-weight:bold; color:Red">
			<?php print Aours($_SESSION['UserN']).' | Your Role : '.
				$_SESSION['Role'].' | <a href=Summary.htm target=_blank>View General Summary</a> | <a href=logout.htm>Logout</a>';?>
		</div>
		<!-- Start ContentPlaceHolder -->
		<table height="300px" width="100%" border="0">
			<tr> 
				<td>
					<!--The Table where we insert all our Student registration Numbers-->
					<table height="200px" width="50%" align="center" border="1"  background="Images/1.jpg">
						<tr>
							<td>
								<form id="form1" name="form1" method="post" action="<?php $_SERVER['PHP_SELF']; ?> ">
									<table width="70%" height="130" border="0" align="center">
										<tr>
											<td height="33" colspan="2" valign="top">
												<div align="center"><strong>Enter the Registration number of the student you want to Generate a Code for </strong></div>
											</td>
										</tr>
										<tr>
											<td height="16" colspan="2">&nbsp;</td>
										</tr>
										<tr>
											<td height="26" colspan="2">
												<input name="mereg" type="text" id="mereg" size="70"/>
											</td>
										</tr>
										<tr>
											<td width="340" height="34">&nbsp;</td>
											<td width="74"><input type="submit" name="Submit" value=" &nbsp;&nbsp;Accept&nbsp;&nbsp;" /></td>
										</tr>
									</table>
								</form>
							</td>
						</tr>
					</table>
				</td>
			</tr>
			<!--The row where we are going to display all the informaton for the next step-->
			<tr height="100px">
				<td>
					<!--The Table where we are going to Display our Results After thy have been Created-->
					<table width="100%">
						<tr>
							<td>
								<b style="font-size:15px;font-weight:bold;color:#333333;">
									<?php 
										if(isset($R))
										{
											if($R != 1) 
												echo 'CODE GENERATED FOR :   '.$R;
											else
												echo 'STUDENT DOESN\'T EXIST IN OUR DATALIST';
										}
									?>
								</b>
							</td>
							<td><b style="font-size:40px;font-weight:bold;color:#FF0000;"><?php if(isset($U)) echo $U;?></b></td>
						</tr>
						<tr>
							<td><b style="font-size:15px;font-weight:bold;"><?php  if(isset($N)) echo 'VOTERS NAME : '.$N;?></b></td>
							<td>
								<span style="color:Green;font-size:10px;font-weight:bold;">
									<?php
										$q = mysql_query("SELECT * FROM votestudents WHERE AgentName = '".$_SESSION['UserN']."'");
										echo 'You have Generated '.mysql_num_rows($q).' different Voting Code(s)';
									?>
								</span>
							</td>
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
