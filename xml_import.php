<?php
include './XML2Array.php';
include './xmlstr_to_array.php';

function pre_print_r($var){
		echo "<pre>";
		print_r($var);
		echo "</pre>";
	}



// $part2 = new DOMDocument();
// $part2->load("./part2.xml");

// $globReg = new DOMDocument();
// $globReg->load("./globReg.xml");

//$part2_arr = XML2Array::createArray($part2);
//$globReg_arr = XML2Array::createArray($globReg);


$part2 = file_get_contents("./globReg.xml");
$result = xmlstr_to_array($part2);
pre_print_r($result);

