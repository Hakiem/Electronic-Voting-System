<?php
	echo '<td align=center width='.$Wid.'% id=table>';
	echo '<img src='.$Row2[4].' height=150px width=150px title="'.$Row2[1].'" /><br>';
	echo '<b style=font-size:9px><span style=font-size:12px;>'.$Row2[1].'</span><br>';
	
	//Get the Number of votes for the Currently Printing Candidate
	$Result3 = mysql_query("SELECT COUNT(*) FROM Casts WHERE CandidateID = '".$Row2[0]."'");
	$Row3 = mysql_fetch_row($Result3);
	echo '<span style=font-size:20px;passing-top:2px;color:Red>TOTAL VOTES : '.$Row3[0].'</span></br>';
	$TV = $Row3[0];
	
	$Col[$i][0] = $Row3[0]; //Load the Current Candidate Total Votes
	$Col[$i][1] = $Row2[0]; //Load the Current CandidateID
	
	$Rez = $mysqli->query("CALL CALL Cal_Male_Female('".$Row2[0]."')");
	$Row4 = $Rez->fetch_array(MYSQLI_NUM);
	
	$Row4 = mysql_fetch_row(mysql_query($str));
	echo '<span style=font-size:15px;padding-top:2px;color:Green>MALE VOTERS : '.$Row4[0].'<br>';
	echo 'FEMALE VOTERS : '.$Row4[1].'<br>';
	echo 'PERCENTAGE : '.$Row4[3].' %</span>';
	
	$i += 1;
	
	//***************************************************************************************************
	
	echo '<td align=center width='.$Wid.'% id=table>';
	echo '<img src='.$Row2[4].' height=150px width=150px title="'.$Row2[1].'" /><br>';
	echo '<b style=font-size:9px><span style=font-size:12px;>'.$Row2[1].'</span><br>';
	
	//Get the Number of votes for the Currently Printing Candidate
	$Result3 = mysql_query("SELECT COUNT(*) FROM Casts WHERE CandidateID = '".$Row2[0]."'");
	$Row3 = mysql_fetch_row($Result3);
	echo '<span style=font-size:20px;passing-top:2px;color:Red>TOTAL VOTES : '.$Row3[0].'</span></br>';
	$TV = $Row3[0];
	
	$Col[$i][0] = $Row3[0]; //Load the Current Candidate Total Votes
	$Col[$i][1] = $Row2[0]; //Load the Current CandidateID
	
	$str = "SELECT COUNT(*) FROM Casts C JOIN votestudents V ON ".
		   "V.stud_reg_no = C.stud_reg_no WHERE CandidateID = '".$Row2[0]."' AND stud_sex = 'MALE'";
	
	$str2 = "SELECT COUNT(*) FROM Casts C JOIN votestudents V ON ".
		    "V.stud_reg_no = C.stud_reg_no WHERE CandidateID = '".$Row2[0]."' AND stud_sex = 'FEMALE'";
	
	$Result4 = mysql_query($str);
	$Row4 = mysql_fetch_row($Result4);
	echo '<span style=font-size:15px;padding-top:2px;color:Green>MALE VOTERS : '.$Row4[0].'<br>';
	$Result5 = mysql_query($str2);
	$Row5 = mysql_fetch_row($Result5);
	echo 'FEMALE VOTERS : '.$Row5[0].'<br>';
	echo 'PERCENTAGE : '.round(($TV / $K[0]) * 100, 2).' %</span>';
	
	$i += 1;
?>
