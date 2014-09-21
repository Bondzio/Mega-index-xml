<?php
include './db_array/db_globRegxml.php';
include './db_array/db_part2xml.php';
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
// array_intersect_assoc() // array_intersect() // array_diff_assoc // array_intersect
// pre_print_r($duplicate_word);
array_to_file($duplicate_word);
// function here to merge those word;

$unique_volcabulary = array_unique($volcabulary);
// pre_print_r($unique_volcabulary);

$string = $unique_volcabulary[734]; //UTF-8
$cha=utf8_decode($string);
var_dump($cha);
$string = $unique_volcabulary[235]; //ASCII
$cha=utf8_decode($string);
var_dump($cha);
// echo $cha;

// http://zh.wikipedia.org/wiki/%E5%BE%B7%E8%AA%9E%E5%AD%97%E6%AF%8D
$volcabulary_id = array(0=>'');
	foreach ($unique_volcabulary as $item) {
		$volcabulary_id[] = $item;
		// $cha=mb_detect_encoding($item);
		// echo $cha."<br />";
	}
unset($volcabulary_id[0]);

array_to_file($volcabulary_id);
// asort($volcabulary_id);
// pre_print_r($volcabulary_id);
// natcasesort($volcabulary_id);


function Sortify($string)
{
    return preg_replace('~&([a-z]{1,2})(acute|cedil|circ|grave|lig|orn|ring|slash|tilde|uml);~i', '$1' . chr(255) . '$2', htmlentities($string, ENT_QUOTES, 'UTF-8'));
}

array_multisort(array_map('Sortify', $volcabulary_id), $volcabulary_id);

// pre_print_r($volcabulary_id);
