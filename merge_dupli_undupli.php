<?php
include './db_array/db_word_id.php';
include './db_array/db_o_u_duplicate_list_id.php';
include './db_array/db_o_u_unduplicate_list_id.php';
require_once('./utility.php');


$tmp_glob_arr = array_merge($o_u_unduplicate_list_id,$o_u_duplicate_list_id);
ksort($tmp_glob_arr);


if(count($tmp_glob_arr) !== count($word_id)){
	pre_print_r('count($tmp_glob_arr !== count($word_id))');
	pre_print_r('ober num of $tmp_glob_arr : '.count($tmp_glob_arr));
	pre_print_r('ober num of $word_id: '.count($word_id));
	exit;
}


// pre_print_r($tmp_glob_arr);
array_to_file($tmp_glob_arr);
// foreach ($tmp_glob_arr as $key => $value) {pre_print_r($key); }
pre_print_r("<p><h3>Merge dupli & undupli part to one array</h3></p><h3><a href='./export_glob_XML.php'>Next</a></h3>");

