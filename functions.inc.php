<?php
	
	include('config.php');
	session_start();
	
	function DrawHeader($PageTitle)
	{
		$K = file('AS.txt');
		?>
			<html>
				<head>
					<title><?php echo $PageTitle.' :: '.$K[0].' :: '.$K[1]; ?></title>
					<link rel="stylesheet" type="text/css" href="stylesheet.css"/>
					<link rel="shortcut icon" href="Images/6.gif" >
					<script type="text/javascript">
						function highlightcell() {
							// first clear all cells in clicked cells row
							var rowCells = this.parentElement.getElementsByTagName("td")
							for (var index = 0; index < rowCells.length; index++) {
								rowCells[index].bgColor = "";
							}
							// now highlight the clicked cell
							this.bgColor="Orange";
						}

						function ClickCell(g)
						{
							document.getElementById(g).checked = 1;
							highlightcell();
						}
					</script>
				</head>
				<body>
					<table width="85%" border="0" align="center" id="table" cellpadding="0" cellspacing="0">
						<tr height="20px" style="background-image:url(Images/bg.jpg); background-repeat:repeat-x; ">
							<td style="width:20%; padding:5px; text-align:right;">
								<a href="/etov"><img src="<?php  echo $K[2];?>" height="150px" style="border-width:0px;"/></a>
							</td>
							<td style=" width:80%; padding-left:5px; text-align:left; font-size:12px; font-weight:bold;">
								<h1><?php echo $K[0].'<br>'.$K[1].'<br>'.$K[3];?></h1>
							</td>
						</tr>
						
		<?php
		return;
	}
	
	function Footer()
	{
		?>
						<tr>
							<td colspan="2" id="footer">
								Version 2.1.4<br>
								We Provide An Absolute Free and Fair Election (+256-703-483949)<br>
								Copyright &copy; 2008-2011 . All Rights Reserved
							</td>
						</tr>
					</table>
				</body>
			</html>
		<?php
		return;
	}
	
	function AdminNav()
	{
		?>
			<link rel="stylesheet" type="text/css" href="menu_style.css"/>
			<div id="container">
				<ul id="navigation-1">
					<li><a href="Administrator.php" title="Home"><b>Admin Home</b></a></li>
					<!-- Infomation about Posts-->
					<li><a href="#" title="Products"><b>Posts</b></a>
						<ul class="navigation-2">
							<li><a href="#" title="Electric Guitars">View All Posts</a></li>
							<li><a href="#" title="Acoustic Guitars">Candidates Per Post</a></li>
						</ul>
					</li>
					<!--Information about Candidates -->
					<li><a href="#" title="Your Account"><b>Candidates</b></a>
						<ul class="navigation-2">
							<li><a href="#" title="Log In">View All Candidates</a></li>
							<li><a href="#" title="Register">Add Candidate</a></li>
						</ul>
					</li>
					<!--Information about Statistics -->
					<li><a href="#" title="Help"><b>Statistics</b></a>
						<ul class="navigation-2">
							<li><a href="#" title="FAQs">FAQs</a></li>
							<li><a href="#" title="Forum">Forum</a></li>
							<li><a href="#" title="Contact Us">Contact Us</a></li>
						</ul>
					</li>
					<!--Information about Results -->
					<li><a href="#" title="Products"><b>Results</b></a>
						<ul class="navigation-2">
							<li><a href="#" title="Electric Guitars">Electric Guitars</a></li>
							<li><a href="#" title="Acoustic Guitars">Acoustic Guitars</a></li>
							<li><a href="#" title="Bass Guitars">Bass Guitars</a></li>
							<li><a href="#" title="Accessories">Accessories</a></li>
						</ul>
					</li>
				</ul>
			</div>
		<?php
	}
	
	function Hours($Nem, $Sex)
	{
		$hours1 = getdate();
		$hours = ($hours1['hours'] + 3);
		
		if($Sex == 'MALE')
			$Title = 'Mr. ';
		else
			$Title = 'Ms. ';
		
		if($hours >= 0 && $hours < 12)
			$str = 'Good Morning '.$Title.$Nem;
		else if($hours >= 12 && $hours < 17)
			$str = 'Good Afternoon '.$Title.$Nem;
		else
			$str = 'Good Evening '.$Title.$Nem;
		
		//return date('G') + 3;
		return strtoupper($str);
	}
	
	function Aours($Nem)
	{
		$hours1 = getdate();
		$hours = ($hours1['hours'] + 3);
		
		if($hours >= 0 && $hours < 12)
			$str = 'Good Morning '.$Nem;
		else if($hours >= 12 && $hours < 17)
			$str = 'Good Afternoon '.$Nem;
		else
			$str = 'Good Evening '.$Nem;
		
		//return date('G') + 3;
		return strtoupper($str);
	}
	
	function ServerLocation()
	{
		$str = 'http://'.$_SERVER['SERVER_NAME'].'/etov/index.htm';
		return $str;
	}
	
	function VitalReturns()
	{
		$Q1 = mysql_query('SELECT COUNT(*) FROM votestudents');
		$R1 = mysql_fetch_row($Q1);
		$K1 = $R1[0];
		$Q2 = mysql_query('SELECT COUNT(*) FROM votestudents WHERE HasVoted = 1');
		$R2 = mysql_fetch_row($Q2);
		$K2 = $R2[0];
		
		$trs = ' | <a href=/etov/Results/>Results</a> | Registered Voters : '.$K1.' | Those that have Voted : '.$K2;
		
		return $trs;
	}
	
	function EndVoting()
	{
		$hours1 = getdate();
		$hours = $hours1['hours'] + 3;
		
		//if($hours < 17)
			//return FALSE;
		//else
			return TRUE;
		//return TRUE;
	}
	
	// Display error messages
	function DisplayErrMsg( $message )
	{
		printf("<BLOCKQUOTE><BLOCKQUOTE><BLOCKQUOTE><H3><FONT COLOR=\"#cc0000\">%s</FONT></H3></BLOCKQUOTE></BLOCKQUOTE></BLOCKQUOTE>\n", $message);
	}

?>