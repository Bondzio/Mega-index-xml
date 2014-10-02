<?php 

$volcabulary =array (
	  0 => 'Handelsfreiheit',
	  1 => 'Handel (Händler)',
	  2 => 'Handel, auswärtiger',
	  3 => 'Handelsbilanz',
	  4 => 'Handelskapital',
	  5 => 'Zweck',
	  6 => 'Zyklus, industrieller',
	  7 => '﻿Handelsbilanz',
	);

$unique_volcabulary = array_unique($volcabulary);

echo "<pre>";
var_dump($unique_volcabulary);
echo "</pre>";

$volcabulary_id = array(0=>'');
	foreach ($unique_volcabulary as $item) {
		$volcabulary_id[] = $item;
		$code=mb_detect_encoding($item);
		echo $code." : ".$item."<br />";
	}
