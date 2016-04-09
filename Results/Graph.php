<link href="style/style.css" rel="stylesheet" type="text/css" />
<?php
	header("Refresh: 5;");
	require_once('../functions.inc.php'); 
	require_once('chart.php');
	
	$tableSize = 500;
	
	if(!isset($_SESSION['Rez']))
		header('Location:/etov/Results/');
	
	$P = $_GET['cgi'];
	$result = mysql_query("SELECT PostName FROM Posts WHERE PostID = '$P'");
	$row = mysql_fetch_row($result);
	
	DrawHeader('VIEWING GRAPH FOR POST OF '.$row[0]);
	
	$Result2 = mysql_query("SELECT * FROM candidate WHERE PostID = '$P' ORDER BY CandidateName ASC");
	
	$Col = array();
	$data = array();
	
	if(mysql_num_rows($Result2) > 0)
	{
		$i = 0; 
		while($Row2 = mysql_fetch_row($Result2))
		{
			$Result3 = mysql_query(
				"SELECT CandidateName, COUNT(*) AS Votes FROM Casts C JOIN Candidate J ON J.CandidateID =  C.CandidateID WHERE C.CandidateID = '".
				$Row2[0]."' GROUP BY CandidateName");
			echo mysql_error();
			$Row3 = mysql_fetch_row($Result3);
			
			$Col[$i][0] = $Row3[1]; //Load the Current Candidate Total Votes
			$Col[$i][1] = $Row2[1]; //Load the Current CandidateName
			
			$i += 1;
		}
	}
	
	for($j = 0; $j < count($Col); $j++)
	{
		$data[$j]['title'] =  $Col[$j][1];
		$data[$j]['value'] =  $Col[$j][0];
	}
?>
	<tr>
		<td colspan="2">
		<div style="background-image:url(Images/Tackle.png); padding:5px; font-size:13px; height:20px; font-weight:bold; color:Red">
			<a href="/etov/">HOME</a><span id="Entry"> &raquo; RESULTS SECTION - EVOTING SYSTEM</span>
		</div>
		<!-- Start ContentPlaceHolder -->
		<table height="300px" width="100%" style="background-color:#FFF;">
			<tr>
				<td valign="middle" align="center">
                    <div style="font-size:20px;"><br><b><?php echo 'VIEWING GRAPH FOR POST OF '.$row[0]; ?></b><br><Br>
                        <div id="result">
                            <?php drawChart($data); ?>
                        </div>   
                    </div>
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
?>