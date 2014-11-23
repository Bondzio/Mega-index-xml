<?php
include './db_array/db_word_id.php';
include './db_array/db_o_u_duplicate_list_id.php';
include './db_array/db_o_u_unduplicate_list_id.php';
require_once('./utility.php');


$tmp_glob_arr = array_merge($o_u_unduplicate_list_id,$o_u_duplicate_list_id);
ksort($tmp_glob_arr);


if(count($tmp_glob_arr) !== count($word_id)){
	pre_print_r('count($tmp_glob_arr !== count($word_id))');
	pre_print_r('ober num of $tmp_glob_arr : '.count($tmp_glob_arr));
	pre_print_r('ober num of $word_id: '.count($word_id));
	exit;
}

// sort entry in group by book id;
foreach ($tmp_glob_arr as $ober_key => $oberBegriff) {
	pre_print_r($ober_key);
	if(isset($oberBegriff['unterBegriff'])){
				foreach ($oberBegriff['unterBegriff'] as $unter_key => $unterBegriff) {
					pre_print_r($unterBegriff['uname']);
					foreach ($unterBegriff['entry'] as $entry_key => $entry_value) {
						$book_num = $entry_value;
					// pre_print_r('ENTERY_KEY  =>  '.$entry_key);
					pre_print_r('BOOK_NUM  =>  '.$entry_value['book']);
					}
					pre_print_r('_____________________');
				}
					pre_print_r('~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~');
	}
}

// pre_print_r($tmp_glob_arr);
array_to_file($tmp_glob_arr);
// foreach ($tmp_glob_arr as $key => $value) {pre_print_r($key); }
pre_print_r("<p><h3>Merge dupli & undupli part to one array</h3></p><h3><a href='./export_glob_XML.php'>Next</a></h3>");

