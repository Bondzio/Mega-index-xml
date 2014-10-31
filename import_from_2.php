<?php
include './db_array/db_globRegxml.php';
include './db_array/db_tmpxml.php';
include './db_array/db_o_u_id.php';
include './db_array/db_word_id.php';
include './db_array/db_duplicate_word.php';
include './db_array/db_duplicate_uname_volcabulary_list.php';
require_once('./utility.php');


// pre_print_r($word_id);;
// pre_print_r($duplicate_uname_volcabulary_list);

// put both oname and uname duplicated items to $o_u_duplicate_list
$o_u_duplicate_list = array();
foreach ($o_u_id as $key => $value) {
	if(is_array($value)){
		$o_u_duplicate_list[$key] = $value;
		unset($o_u_id[$key]);
	}
}

// pre_print_r($o_u_duplicate_list);
$o_u_duplicate_list_id = array();
foreach ($o_u_duplicate_list as $key => $value) {
	$o_u_duplicate_list_id[$key]['oname'] = $o_u_duplicate_list[$key]['oname'];
	if(array_key_exists('unterBegriff', $value)){
		foreach ($value['unterBegriff'] as $k => $v) {
			$num = sprintf("_%03d",($k+1));
			$tmp = $key.$num;
			$o_u_duplicate_list_id[$key]['unterBegriff'][$tmp] = $v;
		}
	}

	if(array_key_exists('link', $value)){
		foreach ($value['link'] as $k => $v) {
			$num = array_search($v, $word_id);
			if($num){
				$o_u_duplicate_list_id[$key]['link'][$num] = $v;
			}else{
				pre_print_r('<b>');
				pre_print_r($value['oname']);
				pre_print_r('</b>');
				pre_print_r("	-> $v");
			}
		}
	}
}


// pre_print_r($o_u_duplicate_list_id);
exit;



// pre_print_r($duplicate_word);
$duplicate_arr = array();
$o_arr = $globRegxml['oberBegriff'];
// pre_print_r($o_u_id);
foreach ($o_arr as $ober) {
	$oname = trimUTF8BOM($ober['oname']);
	if(!in_array($oname, $duplicate_word)){
		$tmp = array_search($oname, $word_id);
		$o_u_id[$tmp] = $ober;
	}else{
		$tmp = array_search($oname, $word_id);
		$duplicate_arr[$tmp][] = $ober;
	}
}

$o_arr = $tmpxml['oberBegriff'];
foreach ($o_arr as $ober) {
	$oname = trimUTF8BOM($ober['oname']);
	if(!in_array($oname, $duplicate_word)){
		$tmp = array_search($oname, $word_id);
		$o_u_id[$tmp] = $ober;
	}else{
		$tmp = array_search($oname, $word_id);
		$duplicate_arr[$tmp][] = $ober;
	}
}

// pre_print_r($o_u_id['A0003']); // unduplicated obers
// Next to reset id for each array;

// pre_print_r($duplicate_arr['A0148']); // duplicatd obers
// pre_print_r($duplicate_arr['A0125']); // duplicatd obers
// pre_print_r($duplicate_arr); // duplicatd obers
