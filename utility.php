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
	if(false !== fopen('./db_array/'.$fileName, 'w+')){
	    file_put_contents('./db_array/'.$fileName, $text);
	}else{
	    echo "FAIL!";
	}
}


// if string include "efbbbf", delete it.
function trimUTF8BOM($data){ 
	$data = trim($data);
   if(strlen($data) >= 3 && substr($data, 0, 3) == pack('CCC', 239, 187, 191)) {
       return substr($data, 3);
   }
   return $data;
}

