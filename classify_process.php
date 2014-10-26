
<?php
include "./utility.php";

$keywds = file("./tmp/tmp.txt");

$key = array();
$hyphen = array();
$arrow = array();

$j = 0;
for ($i=0; $i <count($keywds) ; $i++) { 
	if($keywds[$i][0]=="-" && $keywds[$i][1]==" "){
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


$pattern = "/(.*?)\s([-\s\d]+)$/";
// Let's seperate char&num of key;
$key_num = array();// the numbers related to the key are all stored here;
$key_char = array();// all the key was stored here;
// print out all value of $key;
//for ($i=0; $i < count($key); $i++) {echo $key[$i]."<br />"; }

for ($i=0; $i < count($key); $i++) { 
	preg_match_all($pattern, $key[$i], $matches);
	$key_char[$i] = strip_tags($matches[1][0]);
	$key_num[$i] = $matches[2][0];
}


// Let's seperate char&num of hyphen;
$hyphen_num = array();// the numbers related to the key are all stored here;
$hyphen_char = array();// all the key was stored here;

foreach ($hyphen as $value){foreach ($value as $child) { $temp[] = $child; } };
	for ($i=0; $i < count($temp); $i++) { 
		$subject = $temp[$i];
		preg_match_all($pattern, $subject, $matches);

		$hyphen_char[$hyphen_keys[$i]][] = strip_tags($matches[1][0]);
		$hyphen_num[$hyphen_keys[$i]][] = $matches[2][0];
}
//pre_print_r($hyphen);
// pre_print_r($hyphen_char);
// pre_print_r($hyphen_num);

$arrow_num = array();// the numbers related to the key are all stored here;
//$arrow_num always null;
$arrow_char = array();// all the key was stored here;
for ($i=0; $i < count($arrow_keys); $i++) { 
	$subject = $arrow[$arrow_keys[$i]][$arrow_keys_keys[$i]];
	// pre_print_r(trim($subject));
		$arrow_char[$arrow_keys[$i]] = strip_tags($subject);
		$arrow_num[$arrow_keys[$i]] = ""; 
	}
// pre_print_r($arrow_char);
//pre_print_r($arrow_num);


pre_print_r("<p>読み込み 成功！</p><h3><a href='./xml_export.php'>親索引だけを表示する</a></h3>");
// print all words as html
for ($i=0; $i < count($key_char) ; $i++) { 
	echo "<b>";
	echo $key_char[$i]."</b>";
	echo " ".$key_num[$i]."<br />";
	if(isset($hyphen_char[$i])){
		for ($j=0; $j < count($hyphen_char[$i]); $j++) { 
			echo "<b>".$hyphen_char[$i][$j]."</b> ".$hyphen_num[$i][$j]."<br />";
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