<?php
	include('../functions.inc.php');
	if(isset($_GET['Mode']) && isset($_GET['PostID']))
	{
		if($_GET['Mode'] == 'Del')
		{
			$P = $_GET['PostID'];
			mysql_query("DELETE FROM Posts WHERE PostID = '$P'");
		}
	}
	
	if(isset($_POST['Reg']))
	{
		$P = strtoupper($_POST['PN']);
		$Rnk = $_POST['R'];
		$St = $_POST['Stan'];
		mysql_query("INSERT INTO Posts (PostName, Rank, Standard) VALUES ('$P', '$Rnk', '$St')");
	}
?>
<link rel="stylesheet" type="text/css" href="../stylesheet.css"/>
<h4>VIEW/ADD POSTS</h4>
<hr>
<?php
	$query = mysql_query('SELECT * FROM Posts ORDER BY Rank ASC');
	if(mysql_num_rows($query) < 1)
		echo "<b style=color:Red font-size:9px>There are no Posts to Display</b>";
	else
	{
		$i = 1;
		echo '<table width=100% border=1 background=../Images/1.jpg>';
		echo '<tr align=center>';
		echo '<th>.</th><th align=left>POST NAME</th><th>STANDARDS</th><th>RANK</th><th>.</th>';
		echo '</tr>';
		while($row = mysql_fetch_row($query))
		{
			echo '<tr  align=center>';
			echo '<td>'.$i.'.</td>';
			echo '<td align=left>'.$row[1].'</td>';
			echo '<td width=25px>'.$row[3].'</td>';
			echo '<td width=10px>'.$row[2].'</td>';
			echo '<td width=10px><a href=AddPost.php?Mode=Del&PostID='.$row[0].'>Remove</a></td>';
			echo '</tr>';
			$i += 1;
		}
		echo '</table>';
	}
?>
<hr>
<b>Add Post</b>
<br>
<form method="post" action="<?php $_SERVER['PHP_SELF'];?>">
	<table cellpadding="5" cellspacing="5">
		<tr>
			<td><b>Post Name</b></td>
			<td><input type="text" name="PN" size="50px" style="font-size:11px;"/></td>
		</tr>
		<tr>
			<td><b>Voting Standards</b></td>
			<td>
				<select name="Stan" style="font-size:11px;width:150px;">
					<option value="Both" selected="selected">Both Gender</option>
					<option value="Female">ONLY Females</option>
					<option value="Male">ONLY Males</option>
				</select>
			</td>
		</tr>

		<tr>
			<td><b>Rank</b></td>
			<td><input type="text" name="R" size="50px" style="font-size:11px;"/></td>
		</tr>
		<tr>
			<td><b></b></td>
			<td>
				<input type="submit" name="Reg" value="Add Post" style="font-size:12px;"/>
			</td>
		</tr>
	</table>
</form>
