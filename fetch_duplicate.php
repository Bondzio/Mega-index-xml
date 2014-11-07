<?php
include './db_array/db_globRegxml.php';
include './db_array/db_tmpxml.php';
include './db_array/db_duplicate_word.php';
include './db_array/db_volcabulary_id.php';
include './db_array/db_word_id.php';
require_once('./utility.php');

//$tmpxml;
//$globRegxml;

function get_duplicate($target_arr,$dupli_word_list){
	$duplicate_array = array();

	for ($i=0; $i < count($target_arr['oberBegriff']); $i++) { 
		$target_oname = trimUTF8BOM($target_arr['oberBegriff'][$i]['oname']);
		if(in_array($target_oname, $dupli_word_list)){
			$duplicate_array[] = $target_arr['oberBegriff'][$i];
			}
		}
		return $duplicate_array;
};



$glob_dupli_arr = get_duplicate($globRegxml,$duplicate_word);
$tmp_dupli_arr = get_duplicate($tmpxml,$duplicate_word);

// oname id is defined by $duplicate_word.php, [id] => A0010
// uname id is defined by , [id] => A0010_001


// oname & uname are the same, add to entry/group
// oname are the same, uname is different, need a uname id

// add number key for unterBergriff only has one unterBegriff;
function add_unterBegriff_key($arr){
	for ($i=0; $i < count($arr); $i++) { 
		if(array_key_exists('unterBegriff', $arr[$i])){
		if(array_key_exists('uname', $arr[$i]['unterBegriff'])){
			$tmp_value = $arr[$i]['unterBegriff'];
			$arr[$i]['unterBegriff'] = NULL;
			$arr[$i]['unterBegriff'][0] = $tmp_value;
		}}else{
			// [43] => Array ([oname] => Existenz [link] => Array ([@content] => Dasein [@attributes] => Array ([target] => )
			// pre_print_r('word only has links, do not has unter');
			// pre_print_r($arr[$i]);
		}
	}
	return $arr;
}

$tmp_dupli_arr = add_unterBegriff_key($tmp_dupli_arr);
$glob_dupli_arr = add_unterBegriff_key($glob_dupli_arr);
// pre_print_r($tmp_dupli_arr);



function check_if_oname($arr1, $arr2){
	for ($i=0; $i < count($arr1); $i++) { 
		if($arr1[$i]['oname'] !== $arr2[$i]['oname']){
			echo "oname of $i is not identical";
		}else{
			echo "$i is identical<br />";
		}
	}
}


// should be 0~199
// pre_print_r(check_if_oname($tmp_dupli_arr,$glob_dupli_arr));

function fetch_uname($arr){
	$container = array();
	for ($i=0; $i < count($arr); $i++) { 
		if(array_key_exists('unterBegriff', $arr[$i])){
			for ($j=0; $j < count($arr[$i]['unterBegriff']); $j++) { 
				$keyName = $arr[$i]['oname'];
				$container[$keyName]['unterBegriff'][] = $arr[$i]['unterBegriff'][$j]['uname'];
			}};

		if(array_key_exists('link', $arr[$i])){
			$keyName = $arr[$i]['oname'];
			if(array_key_exists(0, $arr[$i]['link'])){
				for ($k=0; $k < count($arr[$i]['link']); $k++) { 
					if(!array_key_exists('@content', $arr[$i]['link'][$k])){
						pre_print_r($arr[$i]['link']); 
						}
					$container[$keyName]['link'][] = $arr[$i]['link'][$k]['@content'];
					// pre_print_r($arr[$i]['link'][$k]);
				} }else{
					$container[$keyName]['link'][] = $arr[$i]['link']['@content']; }
			} }
		return $container;
	}

$a = fetch_uname($tmp_dupli_arr);
$b = fetch_uname($glob_dupli_arr);
$c = array_merge_recursive($a,$b);

function get_duplicates( $array ) {
    return array_unique( array_diff_assoc( $array, array_unique( $array ) ) );
}

$u_duplicate = array();
foreach ($c as $key => $value) {
	foreach ($value as $sub_child) {
		$u_duplicate[$key][] = get_duplicates($sub_child);
	}
}

// unset those words has empty uname and link
// value[0] is uname
// value[1] is link

foreach ($u_duplicate as $key => $value) {
	if(empty($value[0])){
		unset($u_duplicate[$key][0]);
	}
	if(empty($value[1])){
		unset($u_duplicate[$key][1]);
	}
}

// pre_print_r(count($u_duplicate));
// pre_print_r($u_duplicate);
array_to_file($u_duplicate);


for ($i=0; $i < count($u_duplicate); $i++) { 
	if(empty($u_duplicate[$i])){
		unset($u_duplicate[$i]);
	}
}

function unique_uname_link($arr){
	$container=array();
	foreach ($arr as $key => $child) {
		foreach ($child as $child_key => $child_arr) {
			$container[$key][$child_key] = array_unique($child_arr);
		}}
		return $container;
	}


$duplicate_uname_volcabulary_list = unique_uname_link($c);
// pre_print_r(count($duplicate_uname_volcabulary_list));
// pre_print_r($duplicate_uname_volcabulary_list);
array_to_file($duplicate_uname_volcabulary_list);
$o_u_id = $word_id;

// insert those $duplicate_uname_volcabulary_list to $volcabulary_id;
// exit;

foreach ($duplicate_uname_volcabulary_list as $key => $value) {
	if(array_key_exists('unterBegriff', $value)){
		natcasesort($value['unterBegriff']); 
		$value['unterBegriff'] = array_values($value['unterBegriff']);
	}

	if(array_key_exists('link', $value)){
		natcasesort($value['link']); 
		$value['link'] = array_values($value['link']);
	}

	foreach ($o_u_id as $k => $v) {
		if($key == $o_u_id[$k]){
			$o_u_id[$k] = $value;
			$o_u_id[$k]['oname'] = $key;
		}
	}
}

// pre_print_r(count($o_u_id));
pre_print_r("<p>xxx</p><h3><a href='./import_from_2.php'>Next</a></h3>");
pre_print_r($o_u_id);
array_to_file($o_u_id);
// $tmp = $k.sprintf("_%03d",$j);

