<?php
include './utility.php';
include './db_array/db_word_arr.php';

	// check if oname in db_array/db_u_duplicate.php
	// 	if not import word follow the word list;
	// if in the array, than...;


// $word_id = array('',);
$i = 1;
foreach ($word_arr as $key => $value) {
	foreach ($value as $k => $v) {
		$num = sprintf("%04d",$i);
		$tmp = strtoupper($key).$num;
		$word_id[$tmp] = $v;
		$i++;
	}
}

array_to_file($word_id);
pre_print_r("<p>単語リストを表示する</p><h3><a href='./fetch_duplicate.php'>重複した索引を表示する</a></h3>");
pre_print_r($word_id);
