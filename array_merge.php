<?php
include './db_array/db_globRegxml.php';
include './db_array/db_part23xml.php';
include './utility.php';


// $ar1 = array("color" => array("favorite" => "red"), 5);
// $ar2 = array(10, "color" => array("favorite" => "green", "blue"));
// $result = array_merge_recursive($ar1, $ar2);
// pre_print_r($result);



$result =  array_merge_recursive($globRegxml, $part23xml);
// array_to_file($result);
// pre_print_r($result);




// remove "„" "”"
pre_print_r(bin2hex("„Das Kapital”"));
pre_print_r(bin2hex(trimUTF8BOM("„Das Kapital”")));
pre_print_r(bin2hex("„"));
pre_print_r(bin2hex("”"));

$volcabulary = array();

for ($i=0; $i < count($result['oberBegriff']); $i++) { 
	$volcabulary[] = trimUTF8BOM($result['oberBegriff'][$i]['oname']);
	// $tmp = trimUTF8BOM($result['oberBegriff'][$i]['oname']);
	// $volcabulary[] = $result['oberBegriff'][$i]['oname'];
}


// comepare this two output, some word are 
pre_print_r($volcabulary);
// pre_print_r(array_unique($volcabulary));
// https://www.diffchecker.com/e39cyuaj

$duplicate_word = array_diff_assoc($volcabulary, array_unique($volcabulary));
// array_intersect_assoc() // array_intersect() // array_diff_assoc // array_intersect
// pre_print_r($duplicate_word);
array_to_file($duplicate_word);
// function here to merge those word;
// to be done...

$unique_volcabulary = array_unique($volcabulary);
// pre_print_r($unique_volcabulary);

// echo $string1 = $unique_volcabulary[734]; //UTF-8
// echo $string2 = $unique_volcabulary[235]; //ASCII
// $string1=utf8_decode($string1);
// $string2=utf8_decode($string2);
// var_dump($string1);
// var_dump($string2);

// http://zh.wikipedia.org/wiki/%E5%BE%B7%E8%AA%9E%E5%AD%97%E6%AF%8D
$volcabulary_id = array(0=>'');
	foreach ($unique_volcabulary as $item) {
		$volcabulary_id[] = $item;
		$cha=mb_detect_encoding($item);
		if($cha == 'ASCII'){
			$item = utf8_encode($item);
		}
		// echo utf8_encode($cha)." : ".$item."<br />";
	}
unset($volcabulary_id[0]);
// pre_print_r($volcabulary_id);

array_to_file($volcabulary_id);
// asort($volcabulary_id);
// pre_print_r($volcabulary_id);
// natcasesort($volcabulary_id);

