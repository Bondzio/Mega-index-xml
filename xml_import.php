<?php
include './XML2Array.php';

function pre_print_r($var){
		echo "<pre>";
		print_r($var);
		echo "</pre>";
	}



$part2 = new DOMDocument();
$part2->load("./part2.xml");

$globReg = new DOMDocument();
$globReg->load("./globReg.xml");

$part2_arr = XML2Array::createArray($part2);
$globReg_arr = XML2Array::createArray($globReg);

//pre_print_r($part2_arr['globReg']);

