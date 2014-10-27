<?php
include './db_array/db_globRegxml.php';
include './db_array/db_tmpxml.php';
require_once('./utility.php');

$globReg_o = array();
$tmp_o = array();

for ($i=0; $i < count($globRegxml['oberBegriff']); $i++) { 
	$globReg_o[] = trimUTF8BOM($globRegxml['oberBegriff'][$i]['oname']);
}

for ($i=0; $i < count($tmpxml['oberBegriff']); $i++) { 
	$tmp_o[] = trimUTF8BOM($tmpxml['oberBegriff'][$i]['oname']);
}

array_to_file($globReg_o);
array_to_file($tmp_o);

$merge_arr = array_merge($globReg_o,$tmp_o);
$volcabulary_id = array_unique($merge_arr);
array_unshift($volcabulary_id, "");
unset($volcabulary_id[0]);

$duplicate_word = array_intersect($globReg_o, $tmp_o);
$duplicate_word = array_values($duplicate_word);
array_unshift($duplicate_word, "");
unset($duplicate_word[0]);

$identical_word = array_diff($volcabulary_id, $duplicate_word);
$identical_word = array_values($identical_word);
array_unshift($identical_word, '');
unset($identical_word[0]);

sort($volcabulary_id);
// pre_print_r($identical_word);
array_to_file($duplicate_word);
array_to_file($volcabulary_id);
array_to_file($identical_word);

// pre_print_r("<h3>ソートした合成の単語リスト（重複なし）</h3>");
pre_print_r($volcabulary_id);


exit;
for ($i=1; $i < (count($volcabulary_id)+1); $i++) { 
	// $tmp = mb_strtolower($volcabulary_id[$i], 'UTF-8');
	$tmp = strtolower($volcabulary_id[$i]);
	$word_arr[$tmp[0]][] = $volcabulary_id[$i];
}

foreach ($word_arr as $child) {
	sort($child);
}
pre_print_r($word_arr);

// count($merge_arr)-count(array_unique($globReg_o,$tmp_o)) == count($dupl_arr);

// something is wrong here
// $result =  array_merge_recursive($globRegxml, $tmpxml);
// array_to_file($result);

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

// $volcabulary = array();

// for ($i=0; $i < count($result['oberBegriff']); $i++) { 
// 	$volcabulary[] = trimUTF8BOM($result['oberBegriff'][$i]['oname']);
// }


// comepare this two output, some word are 
// pre_print_r(array_unique($volcabulary));
// https://www.diffchecker.com/e39cyuaj

// $duplicate_word = array_diff($volcabulary, array_unique($volcabulary));
// array_intersect_assoc() // array_intersect() // array_diff_assoc // array_intersect
// pre_print_r($duplicate_word);
// array_to_file($duplicate_word);
// function here to merge those word;
// to be done...

// $unique_volcabulary = array_unique($volcabulary);
// echo $string1 = $unique_volcabulary[734]; //UTF-8
// echo $string2 = $unique_volcabulary[235]; //ASCII
// $string1=utf8_decode($string1);
// $string2=utf8_decode($string2);
// var_dump($string1);
// var_dump($string2);

// http://zh.wikipedia.org/wiki/%E5%BE%B7%E8%AA%9E%E5%AD%97%E6%AF%8D
// $volcabulary_id = array(0=>'');
// 	foreach ($unique_volcabulary as $item) {
// 		$volcabulary_id[] = $item;
// 		$cha=mb_detect_encoding($item);
// 		if($cha == 'ASCII'){
// 			$item = utf8_encode($item);
// 		}
// 		// echo utf8_encode($cha)." : ".$item."<br />";
// 	}
// unset($volcabulary_id[0]);
// pre_print_r($volcabulary_id);

// array_to_file($volcabulary_id);
// asort($volcabulary_id);
// pre_print_r($volcabulary_id);
// natcasesort($volcabulary_id);

