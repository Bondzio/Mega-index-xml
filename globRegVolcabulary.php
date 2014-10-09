<?php
include './db_array/db_globRegxml.php';
include './utility.php';


$globReg_volcabulary = array();

for ($i=0; $i < count($globRegxml['oberBegriff']); $i++) { 
	$globReg_volcabulary[($i+1)] = trimUTF8BOM($globRegxml['oberBegriff'][$i]['oname']);
}


pre_print_r($globReg_volcabulary);
array_to_file($globReg_volcabulary);
// array_unique($globReg_volcabulary);
// pre_print_r($globReg_volcabulary);



