<?php

function pre_print_r($var){
		echo "<pre>";
		print_r($var);
		echo "</pre>";
	}



$doc = new DOMDocument();
$doc->load("./part2.xml");
$uname = $doc->getElementsByTagName("oname");

