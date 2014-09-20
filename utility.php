<?php

function pre_print_r($var){
		echo "<pre>";
		print_r($var);
		echo "</pre>";
}   

function array_to_file($fileName, $array, $arrayName){
	// $file = './db_part2.php';
	$text = '<?php $'.$arrayName.' ='.var_export($array, true).';';
	if(false !== fopen($fileName, 'w+')){
	    file_put_contents($fileName, $text);
	}else{
	    echo "FAIL!";
	}
}