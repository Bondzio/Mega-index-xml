<?php
include './db_array/db_volcabulary_id.php';
require_once('./utility.php');
$alphabet = 'a';
$alphabet_arr = array();
for ($i=1; $i < (count($volcabulary_id)+1); $i++) { 
	$tmp = mb_strtolower($volcabulary_id[$i], 'UTF-8');
	if($tmp[0]!= $alphabet){
		$alphabet = $tmp[0];
		$alphabet_arr[] = $alphabet;
	}
}

$alphabet_arr = array_values(array_unique($alphabet_arr));
// array_to_file($alphabet_arr);
pre_print_r($alphabet_arr);