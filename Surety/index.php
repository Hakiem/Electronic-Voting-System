<link href="../stylesheet.css" rel="stylesheet" type="text/css"/>
<style type="text/css">
	body{background-color:white;}
	#commentForm label.error, #commentForm input.submit { margin-left: 253px; }
	#signupForm { width: 670px; }
	#signupForm label.error {
		margin-left: 10px;
		width: auto;
		display: inline;
	}
	#newsletter_topics label.error {
		display: none;
		margin-left: 103px;
	}
	input.btn {
	  color:#050;
	  font: bold 84%'trebuchet ms',helvetica,sans-serif;
	  background-color: #fed;
	}
	
	input.btnhov {
  		border-color: #c63 #930 #930 #c63;
	}

</style>
<?php
	include('../functions.inc.php');
	
	if(isset($_GET['uid']))
	{
		mysql_query("DELETE FROM surety WHERE SuretyID = '".$_GET['uid']."'");	
	}
	
	if(isset($_POST['login']))
	{
		$un 	= $_POST['un'];
		$pw 	= $_POST['Pass'];
		$cpw 	= $_POST['CPass'];
		if(empty($un) || empty($pw) || empty($cpw))
			$Msg = 'All Fields need to be filled to proceed';
		else
		{
			if($pw == $cpw)
			{
				$userid = md5(rand() * time());
				mysql_query("INSERT IGNORE INTO surety(SuretyID, username, pass) VALUES('$userid', '$un', MD5('$pw'))");
			}
			else
				$Msg = 'Your Passwords should match';
		}
		
	}
?>
<div style="text-align:center; padding-top:20px;">
	<span  style="font-size:20px;"><b>List of all sureties to Access Final Results of the Election Exercise</b></span><br><br>
    Please note that any loss of a password of one of the sureties will deny access to the final results
</div>
<hr style="width:80%; text-align:center;"><br>
<?php
	$R = mysql_query('SELECT * FROM surety ORDER BY username ASC');
	if(mysql_num_rows($R) > 0)
	{
		$i = 1;
		echo '<center><table width=50% border=1 cellpadding=5 cellspacing=5 style=font-size:13px;>';
		echo '<tr style=background-color:Black;color:White><th>.</th><th>Surety Username</th><th>Date Registered</th><th>.</th></tr>';
		
		while($Row = mysql_fetch_row($R))
		{
			echo '<tr>'	;
				echo '<td><b>'.$i.'.</b></td>';
				echo '<td><b>'.$Row[1].'</b></td>';
				echo '<td><b>'.date("d-M-Y g:i (A)", strtotime($Row[3])).'</b></td>';
				echo '<td><a href='.$_SERVER['PHP_SELF'].'?uid='.$Row[0].'><b>Remove</b></a></td>';
			echo '</tr>';
			$i += 1;
		}
		
		echo '</table></center>';
	}
	else
	{
		?>
        	<center>
                <div style="height:40px; border:solid Black 1px; color:Red; font-size:14px; width:80%; padding-top:15px;">
                    <b>There are no Suretis registered.</b>
                </div>
            </center>
        <?php	
	}
?>
<br>
<form action="<?php $_SERVER['PHP_SELF'];?>" method="post" id="commentForm">
    <table width="45%" align="center" cellpadding="5" cellspacing="5" style="border:solid Black 3px; font-size:12px;" border="0">
        <?php
            if(isset($Msg))
                echo '<tr><td colspan=2 align=center style=\'color:Blue; font-weight:Bold; font-size:12px\'>'.$Msg.'</td></tr>';
        ?>
        <tr>
            <td width="40%" align="right"><label for="username"><b>Username</b></label></td>
          <td width="60%"><input type="text" id="username" name="un" style="width:200px;"></td>
        </tr>
        <tr>
            <td align="right"><label for="password"><b>Password</b></label></td>
            <td><input type="password" id="password" name="Pass" style="width:200px;"></td>
        </tr>
        <tr>
            <td align="right"><label for="confirm_password"><b>Confirm Password</b></label></td></td>
            <td><input type="password" id="confirm_password" name="CPass" style="width:200px;"></td>
        </tr>
        <tr>
            <td></td>
            <td><input type="submit" name="login" value="Register" style="font-size:12px" class="btn" 
            	onmouseover="this.className='btn btnhov'" onmouseout="this.className='btn'"/></td>
        </tr>
  </table>
</form>