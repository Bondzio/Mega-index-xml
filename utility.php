<?php

function pre_print_r($var){
		echo "<pre>";
		print_r($var);
		echo "</pre>";
}   

//return variable name
// function getVarName($var) {      
//   $tmp = array($var => '');
//   $keys = array_keys($tmp);
//   return trim($keys[0]);
// }

function getVarName($var) {
    foreach($GLOBALS as $var_name => $value) {
        if ($value === $var) {
            return $var_name; } }
    return false;
}



//@arrayName: string of name of $array;
function array_to_file($array){
	$arrayName = getVarName($array);
	$fileName = 'db_'.$arrayName.".php";
	$text = '<?php $'.$arrayName.' ='.var_export($array, true).';';
	if(false !== fopen($fileName, 'w+')){
	    file_put_contents($fileName, $text);
	}else{
	    echo "FAIL!";
	}
}