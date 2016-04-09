<style type="text/css">
	body{
		font-family:Calibri;
	}
	.paginate {
		font-family: Calibri;
		font-size: .7em;
	}
	a.paginate {
		border: 1px solid #000080;
		padding: 2px 6px 2px 6px;
		text-decoration: none;
		color: #000080;
	}
	a.paginate:hover {
		background-color: #000080;
		color: #FFF;
		text-decoration: underline;
	}
	a.current {
		border: 1px solid #000080;
		font: bold .7em;
		padding: 2px 6px 2px 6px;
		cursor: default;
		background:#000080;
		color: #FFF;
		text-decoration: none;
	}
	span.inactive {
		border: 1px solid #999;
		font-size: .7em;
		padding: 2px 6px 2px 6px;
		color: #999;
		cursor: default;
	}
</style>
<?php
	mysql_connect('localhost', 'root', 'snh');
	mysql_select_db('ucu');
	
	require_once('paginator.class.php');
	
	$query = "SELECT COUNT(*) as num FROM votestudents";
	$num_rows = mysql_fetch_row(mysql_query($query));
	
	$pages = new Paginator;
	$pages->items_total = $num_rows[0];
	$pages->mid_range = 11;
	$pages->paginate();
	
	echo $pages->display_pages();
	echo '<span style=margin-left:25px>'.$pages->display_jump_menu().$pages->display_items_per_page().'</span><br><br>'; 
	//SELECT title FROM articles WHERE title != '' ORDER BY title ASC $pages->limit
	$sql = mysql_query("select stud_name, stud_reg_no, stud_sex, VoteCode FROM votestudents $pages->limit");

	$i = 1;
	echo "<table border=1>";
	echo "<tr><th>Name</th><th>Registration Number</th><th>Gender</th><th>Vote Code</th></tr>";
	while($Row = mysql_fetch_row($sql)) {
		echo '<tr><td>'.$i.'.'.$Row[0].'</td><td>'.$Row[1].'</td><td>'.$Row[2].'</td><td>'.$Row[3].'</td></tr>';
		$i++;	
	}
	echo '<table><br><br>';
	echo $pages->display_pages();
	echo '<span style=margin-left:25px>'.$pages->display_jump_menu().$pages->display_items_per_page().'</span>';
	echo "<br><br>Page $pages->current_page of $pages->num_pages"; 
?>