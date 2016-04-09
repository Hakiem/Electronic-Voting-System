<?php

function drawChart($chartData)
{
   global $tableSize;
   $maxValue = 0;

   // First get the max value from the array
   foreach ($chartData as $item) 
   {
      if ($item['value'] > $maxValue) $maxValue = $item['value'];
   }

   // Now set the theoretical maximum value depending on the maxValue
   $maxBar = 1;
   while ($maxBar < $maxValue) $maxBar = $maxBar * 10;

   // Calculate 1px value as the table is 300px
   $pxValue = ceil($maxBar / $tableSize);

   // Now display the table with bars
   echo '<table width=100%><tr><th>CANDIDATE</th><th>GRAPH</th><th>VOTES</th></tr>';
   
	   foreach ($chartData as $item) 
	   {
		  $width = ceil($item['value'] / $pxValue);
			echo '<tr><td width=800><b>'.$item['title'].'</b></td>';
			echo '<td width="'.($maxBar * $pxValue).'">
			 <img src="style/barbg.gif" alt="'.$item['title'].'" width="'.($width).'" height="45" /></td>';
			echo '<td><b>'.$item['value'].'</b></td></tr>';
	   }
   echo '</table>';
}

?>