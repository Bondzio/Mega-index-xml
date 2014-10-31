<?php
include './db_array/db_globRegxml.php';
include './db_array/db_tmpxml.php';
include './db_array/db_o_u_id.php';
require_once('./utility.php');

// put both oname and uname duplicated items to $o_u_duplicate_list
$o_u_duplicate_list = array();
foreach ($o_u_id as $key => $value) {
	if(is_array($value)){
		$o_u_duplicate_list[$key] = $value;
		unset($o_u_id[$key]);
	}
}

/*
$o_arr = $globRegxml['oberBegriff'];
// pre_print_r($o_u_id);
foreach ($o_arr as $ober) {
	$oname = trimUTF8BOM($ober['oname']);
	if(in_array($oname, $o_u_id)){
		$tmp = array_search($oname, $o_u_id);
		$o_u_id[$tmp] = $ober;
	}
}

$o_arr = $tmpxml['oberBegriff'];
foreach ($o_arr as $ober) {
	$oname = trimUTF8BOM($ober['oname']);
	if(in_array($oname, $o_u_id)){
		$tmp = array_search($oname, $o_u_id);
		$o_u_id[$tmp] = $ober;
	}
}

pre_print_r($o_u_id);
*/

// pre_print_r($o_u_duplicate_list);
foreach ($o_u_duplicate_list as $key => $value) {
	pre_print_r($value['oname']);
}
