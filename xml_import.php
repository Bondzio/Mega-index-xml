<?php
include './XML2Array.php';

function pre_print_r($var){
		echo "<pre>";
		print_r($var);
		echo "</pre>";
	}



$doc = new DOMDocument();
$doc->load("./part2.xml");
// $unames = $doc->getElementsByTagName("oname");
// $uname = $unames->item(0)->nodeValue;
// pre_print_r($uname);


$array = XML2Array::createArray($doc);
pre_print_r($array['globReg']);

