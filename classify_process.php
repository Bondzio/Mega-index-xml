<?php

/*

$array_one_word ={
	$str_one_key,
	$array_one_key_related_pages; // some words don't have pages
	$array_hyphen,
	$array_arrow,
};
	$array_one_key_related_pages ={1,2,3,4,"6-8"};
	$array_hyphen ={
		$array_hyphen_char,
		$array_hyphen_num
	}
	$array_arrow = {
	
		$array_arrow_char,
		$array_arrow_num,
	}


*/

	function pre_print_r($var){
		echo "<pre>";
		print_r($var);
		echo "</pre>";
	}


	$keywds = file("./text/clean_part2.txt");

/*
// check if it's right
//use utf-8 text file;
for ($i=0; $i <count($keywds) ; $i++) { 
	if($keywds[$i][0]=="-"){
		echo $keywds[$i]."-<br />";
	}elseif($keywds[$i][0]=="#"){
		echo $keywds[$i]."#<br />";	
	}else{
		echo $keywds[$i]."KeyName<br />";
	};
};
*/

$key = array();
$hyphen = array();
$arrow = array();

$j = 0;
for ($i=0; $i <count($keywds) ; $i++) { 
	if($keywds[$i][0]=="-"){
		$hyphen[$j-1][$i] = $keywds[$i];
		$hyphen_keys[] = ($j-1);
		$hyphen_keys_keys[] = $i;
		//echo ($j-1)."<br />";
	}elseif($keywds[$i][0]=="#"){
		$arrow[$j-1][$i] = $keywds[$i];
		$arrow_keys[] = ($j-1);
		$arrow_keys_keys[] = $i;
		//echo ($j-1)."<br />";
	}else{
		//be care of thoes words like „Das Kapital“
		$key[$j] = $keywds[$i];
		//echo $j."<br />";
		$j = $j+1;
	};
};

//for ($i=0; $i < count($key); $i++) {echo $key[$i]."<br />"; }
//pre_print_r($key); //to check hypens&arrows of $key[$i], check $hyphen/$arrow[$i];
//pre_print_r($hyphen); //each key of child array related to $key[$i];
//pre_print_r($arrow); // each key of child array related to $key[$i];
//pre_print_r(array_keys($key));
//pre_print_r(array_keys($hyphen));
//pre_print_r(array_keys($arrow));

/*
// print it out, and check if it's right
for ($i=0; $i < count($key); $i++) { 
	echo "<b>".$key[$i]."</b>";
	@pre_print_r($hyphen[$i]);
	@pre_print_r($arrow[$i]);
}
*/


$pattern = "/(.*?)\s([-\s\d]+)$/";
// Let's seperate char&num of key;
$key_num = array();// the numbers related to the key are all stored here;
$key_char = array();// all the key was stored here;
// print out all value of $key;
//for ($i=0; $i < count($key); $i++) {echo $key[$i]."<br />"; }

for ($i=0; $i < count($key); $i++) { 
	preg_match_all($pattern, $key[$i], $matches);
	$key_char[$i] = $matches[1][0];

	if(strpos($key_char[$i], "<br />")){
		$key_char[$i] = substr($key_char[$i], 0, strpos($key_char[$i], "<br />"));
	}
		$key_num[$i] = $matches[2][0];
}


// Let's seperate char&num of hyphen;
$hyphen_num = array();// the numbers related to the key are all stored here;
$hyphen_char = array();// all the key was stored here;
foreach ($hyphen as $value){foreach ($value as $child) { $temp[] = $child; } };
//$re = '"(.*?)\\s([-\\s\\d]+)$"m'; 
//$re = "/(.*?)([-\s\d]+)?$/m";
//pre_print_r($hyphen_keys);
//pre_print_r($hyphen_keys_keys);
//pre_print_r($hyphen);
for ($i=0; $i < count($temp); $i++) { 
	$subject = $temp[$i];
	preg_match_all($pattern, $subject, $matches);
	$hyphen_char[$hyphen_keys[$i]][] = $matches[1][0];
	$hyphen_num[$hyphen_keys[$i]][] = $matches[2][0];
}
//pre_print_r($hyphen);
//pre_print_r($hyphen_char);
//pre_print_r($hyphen_num);


$arrow_num = array();// the numbers related to the key are all stored here;
$arrow_char = array();// all the key was stored here;
$re = "/(.*\D)\s(\d.*)$/";
for ($i=0; $i < count($arrow_keys); $i++) { 
	//pre_print_r($arrow[$arrow_keys[$i]][$arrow_keys_keys[$i]]);
	$subject = $arrow[$arrow_keys[$i]][$arrow_keys_keys[$i]];
	if(preg_match_all($re, $subject, $matches)){
		$arrow_char[$arrow_keys[$i]] = $matches[1][0];
		$arrow_num[$arrow_keys[$i]] = $matches[2][0];
	}else{
		$arrow_char[$arrow_keys[$i]] = $subject;
		$arrow_num[$arrow_keys[$i]] = ""; }
	}
//pre_print_r($arrow_char);
//pre_print_r($arrow_num);



// print all words as html
for ($i=0; $i < count($key_char) ; $i++) { 
	echo "<b>";
	echo $key_char[$i]." ".$key_num[$i];
	echo "</b><br />";
	if(isset($hyphen_char[$i])){
		for ($j=0; $j < count($hyphen_char[$i]); $j++) { 
			echo $hyphen_char[$i][$j]." ".$hyphen_num[$i][$j]."<br />";
			}
		};
	if(isset($arrow_char[$i])){
			echo $arrow_char[$i]." ".$arrow_num[$i]."<br />";
		};
}

//Export array of all;



$db = array('key_char' => $key_char, 
			'key_num' => $key_num, 
			'hyphen_char' => $hyphen_char, 
			'hyphen_num' => $hyphen_num,
			'arrow_char' => $arrow_char, 
			'arrow_num' => $arrow_num
	);

$file = 'db_array.php';
$text = '<?php $db ='.var_export($db, true).';';
if(false !== fopen('./db_array/'.$file, 'w+')){
	file_put_contents('./db_array/'.$file, $text);
}else{
	echo "FAIL!";
}