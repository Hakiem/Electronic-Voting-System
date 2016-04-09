<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php header("Refresh: 5;");?>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Electrol Commission </title>
<style type="text/css">
<!--
.style2 {font-size: x-large}
.style3 {font-size: xx-large; }
.style5 {font-family: Tahoma}
.style14 {color: #FFFFFF; font-size: 18px; font-weight: bold; }
.style15 {font-size: 18px; padding-left:5px;}
.style16 {font-family: Tahoma; font-size: 18px; }
.style17 {font-family: Verdana, Arial, Helvetica, sans-serif, Tahoma; font-size: 14px;}
.style6 {font-size: 9px}
-->
</style></head>

<body>
<form id="form1" name="form1" method="post" action="">
  <table width="723" border="1" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td width="109" height="21"><img src="images/islam.gif" width="109" height="82" /></td>
      <td width="608"><div align="center" class="style3">ISLAMIC UNIVERSITY IN UGANDA </div>
      <p align="center" class="style2">ELECTORAL COMMISSION</p></td>
    </tr>
    <tr>
      <td height="21" colspan="2"><div align="center" class="style15"><strong>ELECTION SUMMARY REPORT </strong></div></td>
    </tr>
    
    <tr>
      <td height="51" colspan="2"><table width="631" border="0" align="center" cellpadding="0" cellspacing="1">
<tr>
<td width="847"><table width="719" border="1" cellpadding="0" cellspacing="0" bordercolor="#000000">
<tr>
  <td width="18" bgcolor="#000000"><span class="style15"></span></td>
  <td width="350" height="20" bgcolor="#000000"><div align="center" class="style14">CATEGORY</div></td>
<td colspan="2" bgcolor="#000000"><div align="center" class="style14">GENDER</div></td>
<td width="182" bgcolor="#000000"><div align="center" class="style14">TOTAL</div></td>
</tr>

<tr>
  <td valign="top">&nbsp;</td>
  <td height="24" valign="top">&nbsp;</td>
  <td width="83" valign="top"><div align="center"><span class="style15"><strong>MALE</strong></span></div></td>
  <td width="74" valign="top"><span class="style15"><strong>FEMALE</strong></span></td>
  <td valign="top">&nbsp;</td>
</tr>
<tr>
  <td valign="top"><span class="style16">1</span></td>
  <td height="24" valign="top"><span class="style16">Eligible Voters</span></td>
  <td valign="top"><div align="center" class="style15">
    <?php
include("config.php");
$query = "SELECT  COUNT(stud_sex) FROM votestudents where stud_sex='MALE' "; 
	 
$result = mysql_query($query) or die(mysql_error());

while($row = mysql_fetch_array($result)){
	echo $row['COUNT(stud_sex)'];
	 
}
mysql_close();
?>
  </div></td>
  <td valign="top"><div align="center" class="style15">
    <?php
include("config.php");
$query = "SELECT  COUNT(stud_sex) FROM votestudents where stud_sex='FEMALE' "; 
	 
$result = mysql_query($query) or die(mysql_error());

while($row = mysql_fetch_array($result)){
	echo $row['COUNT(stud_sex)'];
	 
}
mysql_close();
?>
  </div></td>
  <td valign="top"><span class="style15">
    <?php
include("config.php");
$query = "SELECT  COUNT(stud_reg_no) FROM votestudents "; 
	 
$result = mysql_query($query) or die(mysql_error());

while($row = mysql_fetch_array($result)){

$TotalStudents = $row['COUNT(stud_reg_no)'];
	echo "<strong>  </strong> ". $row['COUNT(stud_reg_no)'] ." Students registred.";
	echo "<br />";
}
mysql_close();
?>
  </span></td>
</tr>
<tr>
  <td valign="top"><span class="style16">2</span></td>
  <td height="24" valign="top"><span class="style16">Students who Din't Vote </span></td>
  <td valign="top"><div align="center" class="style15">
    <?php
include("config.php");
$query = "SELECT  COUNT(stud_sex) FROM votestudents where stud_sex='MALE' AND HasGotCode=0 AND HasVoted = 0 AND AccessedBallotPaper = 0 "; 
	 
$result = mysql_query($query) or die(mysql_error());

while($row = mysql_fetch_array($result)){
	echo   $row['COUNT(stud_sex)'];
	 
}
mysql_close();
?>
  </div></td>
  <td valign="top"><div align="center" class="style15">
    <?php
include("config.php");
$query = "SELECT  COUNT(stud_sex) FROM votestudents where stud_sex='FEMALE' AND HasGotCode=0 AND HasVoted = 0 AND AccessedBallotPaper = 0 ";  
	 
$result = mysql_query($query) or die(mysql_error());

while($row = mysql_fetch_array($result)){
	echo $row['COUNT(stud_sex)'];
	 
}
mysql_close();
?>
  </div></td>
  <td valign="top"><span class="style15">
    <?php
include("config.php");
$query = "SELECT  COUNT(stud_reg_no) FROM votestudents where HasGotCode=0 AND HasVoted = 0 AND AccessedBallotPaper = 0 "; 
 
	 
$result = mysql_query($query) or die(mysql_error());

while($row = mysql_fetch_array($result)){
	echo "<strong>  </strong> ". $row['COUNT(stud_reg_no)'] ." Students registred.";
	echo "<br />";
}
mysql_close();
?>
  </span></td>
</tr>
<tr>
  <td valign="top"><span class="style16">3</span></td>
  <td height="24" valign="top"><span class="style16">Students who Turned Up </span></td>
  <td valign="top"><div align="center" class="style15">
    <?php
include("config.php");
$query = "SELECT  COUNT(stud_sex) FROM votestudents where stud_sex='MALE' AND HasGotCode=1"; 
	 
$result = mysql_query($query) or die(mysql_error());

while($row = mysql_fetch_array($result)){
	echo $row['COUNT(stud_sex)'];
}
mysql_close();
?>
  </div></td>
  <td valign="top"><div align="center" class="style15">
    <?php
include("config.php");
$query = "SELECT  COUNT(stud_sex) FROM votestudents where stud_sex='FEMALE' AND  HasGotCode=1";  
	 
$result = mysql_query($query) or die(mysql_error());

while($row = mysql_fetch_array($result)){
	echo $row['COUNT(stud_sex)'];
	
}
mysql_close();
?>
  </div></td>
  <td valign="top"><span class="style15">
    <?php
include("config.php");
$query = "SELECT  COUNT(stud_reg_no) FROM votestudents where HasGotCode=1"; 
 
	 
$result = mysql_query($query) or die(mysql_error());

while($row = mysql_fetch_array($result)){
	echo "<strong>  </strong> ". $row['COUNT(stud_reg_no)'] ." Students registred.";
	echo "<br />";
}
mysql_close();
?>
  </span></td>
</tr>
<tr>
  <td valign="top"><span class="style16">4</span></td>
  <td height="24" valign="top"><span class="style16">Students who Got Codes but didnt Vote </span></td>
  <td valign="top"><div align="center" class="style15">
    <?php
include("config.php");
$query = "SELECT  COUNT(stud_sex) FROM votestudents where stud_sex='MALE' AND HasGotCode=1 AND HasVoted   = 0 AND AccessedBallotPaper=0"; 
	 
$result = mysql_query($query) or die(mysql_error());

while($row = mysql_fetch_array($result)){
	echo $row['COUNT(stud_sex)'];
}
mysql_close();
?>
  </div></td>
  <td valign="top"><div align="center" class="style15">
    <?php
include("config.php");
$query = "SELECT  COUNT(stud_sex) FROM votestudents where stud_sex='FEMALE' AND  HasGotCode=1 AND HasVoted   = 0 AND AccessedBallotPaper=0";
	 
$result = mysql_query($query) or die(mysql_error());

while($row = mysql_fetch_array($result)){
	echo $row['COUNT(stud_sex)'];
}
mysql_close();
?>
  </div></td>
  <td valign="top"><span class="style15">
    <?php
include("config.php");
$query = "SELECT  COUNT(stud_reg_no) FROM votestudents where HasGotCode=1 AND HasVoted   = 0 AND AccessedBallotPaper=0"; 
 
	 
$result = mysql_query($query) or die(mysql_error());

while($row = mysql_fetch_array($result)){
	echo "<strong>  </strong> ". $row['COUNT(stud_reg_no)'] ." Students registred.";
	echo "<br />";
}
mysql_close();
?>
  </span></td>
</tr>
<tr>
  <td valign="top"><span class="style16">5</span></td>
  <td height="24" valign="top"><span class="style16">Students who Accessed Ballots but did'nt Succesfully Cast their Votes. </span></td>
  <td valign="top"><div align="center" class="style15">
    <?php
include("config.php");
$query = "SELECT  COUNT(stud_sex) FROM votestudents where stud_sex='MALE' AND HasGotCode=1 AND HasVoted   = 0 AND AccessedBallotPaper=1"; 
	 
$result = mysql_query($query) or die(mysql_error());

while($row = mysql_fetch_array($result)){
	echo $row['COUNT(stud_sex)'];
	
}
mysql_close();
?>
  </div></td>
  <td valign="top"><div align="center" class="style15">
    <?php
include("config.php");
$query = "SELECT  COUNT(stud_sex) FROM votestudents where stud_sex='FEMALE' AND  HasGotCode=1 AND HasVoted   = 0 AND AccessedBallotPaper=1";
	 
$result = mysql_query($query) or die(mysql_error());

while($row = mysql_fetch_array($result)){
	echo $row['COUNT(stud_sex)'];
	
}
mysql_close();
?>
  </div></td>
  <td valign="top"><span class="style15">
    <?php
include("config.php");
$query = "SELECT  COUNT(stud_reg_no) FROM votestudents where HasGotCode=1 AND HasVoted   = 0 AND AccessedBallotPaper=1"; 
 
	 
$result = mysql_query($query) or die(mysql_error());

while($row = mysql_fetch_array($result)){
	echo "<strong>  </strong> ". $row['COUNT(stud_reg_no)'] ." Students registred.";
	echo "<br />";
}
mysql_close();
?>
  </span></td>
</tr>
<tr>
  <td valign="top"><span class="style15">6</span></td>
  <td height="24" valign="top"><span class="style16">Students who Voted Succesfully </span></td>
  <td valign="top"><div align="center" class="style15"><span class="style5">
    <?php
include("config.php");
$query = "SELECT  COUNT(GEN) FROM vote where GEN='MALE'"; 
	 
$result = mysql_query($query) or die(mysql_error());

while($row = mysql_fetch_array($result)){
	echo $row['COUNT(GEN)'];
	
}
mysql_close();
?>
  </span></div></td>
  <td valign="top"><div align="center" class="style15"><span class="style5">
    <?php
include("config.php");
$query = "SELECT  COUNT(GEN) FROM vote where GEN='FEMALE'";
	 
$result = mysql_query($query) or die(mysql_error());

while($row = mysql_fetch_array($result)){
	echo $row['COUNT(GEN)'];
	
}
mysql_close();
?>
  </span></div></td>
  <td valign="top"><span class="style16">
    <?php
include("config.php");
$query = "SELECT  COUNT(REG) FROM vote"; 
 
	 
$result = mysql_query($query) or die(mysql_error());

while($row = mysql_fetch_array($result)){
$WhoVoted =$row['COUNT(REG)'];
echo $row['COUNT(REG)'];

}
mysql_close();
?>
  </span></td>
</tr>
<tr>
  <td height="24" colspan="5" valign="top">&nbsp;</td>
  </tr>
<tr>
  <td height="24" colspan="2" valign="top"><span class="style16">General Percentage</span></td>
  <td colspan="3" valign="top"><span class="style17 style15"><?php echo round($WhoVoted/$TotalStudents*100,3); ?>%</span></td>
  </tr>
<tr>
  <td height="24" colspan="5" valign="top">&nbsp;</td>
  </tr>
<tr>
  <td height="24" colspan="2" valign="top"><span class="style16">Total Votes in the Ballot Box </span></td>
  <td colspan="3" valign="top"><span class="style16">
    <?php
include("config.php");
$query = "SELECT  COUNT(REG) FROM vote"; 
 
	 
$result = mysql_query($query) or die(mysql_error());

while($row = mysql_fetch_array($result)){
$WhoVoted =$row['COUNT(REG)'];
echo $row['COUNT(REG)'];

}
mysql_close();
?>
  </span></td>
  </tr>
<tr>
  <td height="24" colspan="5" valign="top">&nbsp;</td>
  </tr>
<tr>
  <td height="24" colspan="2" valign="top"><div align="left"><strong>Source</strong>: Polling Server </div></td>
  <td height="24" colspan="3" valign="top"><span class="style6">&copy; 2010 Islamic University in Uganda , All Rights Reserved Department of ICT </span></td>
  </tr>
</table></td>
</tr>
</table>      </td>
    </tr>
  </table>
</form>
</body>
</html>
