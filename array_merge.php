<?php
include './db_globRegxml.php';
include './db_part2xml.php';
include './utility.php';


// $ar1 = array("color" => array("favorite" => "red"), 5);
// $ar2 = array(10, "color" => array("favorite" => "green", "blue"));
// $result = array_merge_recursive($ar1, $ar2);
// pre_print_r($result);



$result =  array_merge_recursive($globRegxml, $part2xml);
// array_to_file($result);

$volcabulary = array();

for ($i=0; $i < count($result['oberBegriff']); $i++) { 
	$volcabulary[] = $result['oberBegriff'][$i]['oname'];
}


// comepare this two output, some word are 
// pre_print_r($volcabulary);
// pre_print_r(array_unique($volcabulary));
// https://www.diffchecker.com/e39cyuaj

$duplicate_word = array_diff_assoc($volcabulary, array_unique($volcabulary));
// array_intersect_assoc()
// array_intersect()
// pre_print_r($duplicate_word);
array_to_file($duplicate_word);
// function here to merge those word;

$unique_volcabulary = array_unique($volcabulary);
$volcabulary_id = array(0=>'');
foreach ($unique_volcabulary as $item) {
	$volcabulary_id[] = $item;
}

array_to_file($volcabulary_id);
pre_print_r($volcabulary_id);



/*
$part2xml structure

array(
	'oberBegriff' => array(),
	'@root' = 'globReg',
	)

////////////////////////////

array['oberBegriff'] == array(
	0 => array(
				'oname' => '',
				'unterBegriff' => array()
	)

	1 => array(
				'oname' => '',
				'unterBegriff' => array()
	)

	...	
)

//////////////////////////////
'unterBegriff' => array(
	0 => array(
				'uname' = '',
				'group' =
				)




)





*/