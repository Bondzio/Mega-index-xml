<?php
include './db_array/db_globRegxml.php';
include './db_array/db_tmpxml.php';
require_once('./utility.php');


$result =  array_merge_recursive($globRegxml, $tmpxml);
// pre_print_r("<h3><a href=''>合成したXMLファイルをダウンロードします</a></h3>");
// pre_print_r($result['oberBegriff']);

// // $special_code = array("„", "”")
// $string = bin2hex("„Das Kapital”");
// $fdot = bin2hex("„");
// $fdotlen = strlen($fdot);
// $ldot = bin2hex("”");
// $ldotlen = strlen($ldot);
// if(strpos($string, $fdot) || strpos($string, $ldot)){
// 	if(strpos($string, $fdot)){
// 	}
// }


// pre_print_r(bin2hex("„Das Kapital”"));
// pre_print_r(bin2hex(trimUTF8BOM("„Das Kapital”")));
// pre_print_r(bin2hex("„"));
// pre_print_r(bin2hex("”"));
// pre_print_r(hex2bin(bin2hex("„")));

$volcabulary = array();

for ($i=0; $i < count($result['oberBegriff']); $i++) { 
	$volcabulary[] = trimUTF8BOM($result['oberBegriff'][$i]['oname']);
}

// pre_print_r($volcabulary);

// comepare this two output, some word are 
// pre_print_r(array_unique($volcabulary));
// https://www.diffchecker.com/e39cyuaj

$duplicate_word = array_diff($volcabulary, array_unique($volcabulary));
// array_intersect_assoc() // array_intersect() // array_diff_assoc // array_intersect
// pre_print_r($duplicate_word);
array_to_file($duplicate_word);
// function here to merge those word;
// to be done...

$unique_volcabulary = array_unique($volcabulary);
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
pre_print_r("<h3>ソートした合成の単語リスト（重複なし）</h3>");
pre_print_r($volcabulary_id);

array_to_file($volcabulary_id);
// asort($volcabulary_id);
// pre_print_r($volcabulary_id);
// natcasesort($volcabulary_id);

