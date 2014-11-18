<?php
include './db_array/db_word_id.php';
include './db_array/db_globRegxml.php';
include './db_array/db_tmpxml.php';
include './db_array/db_duplicate_word.php';
require_once('./utility.php');

$duplicate_arr = array();
$o_arr = $globRegxml['oberBegriff'];

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


// split both globReg & tmpxml to duplicate($o_u_id) & unduplicated($duplicate_arr);
array_to_file($o_u_id);
array_to_file($duplicate_arr);
// all the unduplicate words array are put in $o_u_id;
// pre_print_r($o_u_id['A0003']); // unduplicated obers
// Next to reset id for each array;
pre_print_r("<p></p><h3><a href='./import_from_2.php'>Next</a></h3>");
