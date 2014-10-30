<?php
include './utility.php';
include './db_array/db_word_arr.php';




$i = 0;
$counter = array();
foreach ($word_arr as $key => $value) {
	$i = $i + count($value);
	$counter[$key] = $i;
}

pre_print_r($counter);
pre_print_r($word_arr);


	// check if oname in db_array/db_u_duplicate.php
	// 	if not import word follow the word list;
	// if in the array, than...;



