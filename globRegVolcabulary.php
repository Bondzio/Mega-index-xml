<?php
include './db_array/db_globRegxml.php';
include './utility.php';


$globReg_volcabulary = array();

for ($i=0; $i < count($globRegxml['oberBegriff']); $i++) { 
	$globReg_volcabulary[($i+1)] = trimUTF8BOM($globRegxml['oberBegriff'][$i]['oname']);
}


// pre_print_r($globReg_volcabulary);
array_to_file($globReg_volcabulary);
// array_unique($globReg_volcabulary);
// pre_print_r($globReg_volcabulary);

$mega_tohoku = file("./text/tohoku_mega_index.txt");
$mega = array();
foreach ($mega_tohoku as $word) {
	// trim "0d0a" use trimUTF8BOM
	$mega[] = trimUTF8BOM($word);
}

// delete special word "„Das Kapital”" to compare two array
$special_word = "„Das Kapital”";
$pos = array_search($special_word, $mega);
unset($mega[$pos]);
$pos = array_search($special_word, $globReg_volcabulary);
unset($globReg_volcabulary[$pos]);

$mega = array_values($mega);
$globReg_volcabulary = array_values($globReg_volcabulary);

// echo $mega==$globReg_volcabulary?"Same":"Different";

// pre_print_r($mega);
// pre_print_r($globReg_volcabulary);

$diff_m_g = array_diff($mega, $globReg_volcabulary); //empty
$diff_g_m = array_diff($globReg_volcabulary, $mega);
$diff_g_m = array_values($diff_g_m);
pre_print_r($diff_g_m);
array_to_file($diff_g_m);
