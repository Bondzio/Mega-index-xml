<?php
include './db_array/db_word_id.php';
include './db_array/db_o_u_duplicate_list_id.php';
include './db_array/db_o_u_unduplicate_list_id.php';
require_once('./utility.php');


$tmp_glob_arr = array_merge($o_u_unduplicate_list_id,$o_u_duplicate_list_id);
ksort($tmp_glob_arr);


// pre_print_r($tmp_glob_arr['A0005']);
// exit;

if(count($tmp_glob_arr) !== count($word_id)){
	pre_print_r('count($tmp_glob_arr !== count($word_id))');
	pre_print_r('ober num of $tmp_glob_arr : '.count($tmp_glob_arr));
	pre_print_r('ober num of $word_id: '.count($word_id));
	exit;
}

// sort entry in group by book id;
foreach ($tmp_glob_arr as $ober_key => $oberBegriff) {
	// pre_print_r($ober_key);
	// pre_print_r(array_keys($oberBegriff));
	if(isset($oberBegriff['unterBegriff'])){
				foreach ($oberBegriff['unterBegriff'] as $unter_key => $unterBegriff) {
					if(array_key_exists('@attributes', $unterBegriff)){
						unset($unterBegriff['@attributes']);
					}

					if(array_key_exists('group', $unterBegriff)){
						if(array_key_exists(0, $unterBegriff['group'])){
							foreach ($unterBegriff['group'] as $group_key => $group_value) {
								if(array_key_exists('@attributes', $group_value)){
									unset($group_value['@attributes']);
								}
							// pre_print_r($unter_value);
								// $entry_keys = array_keys($group_value['entry']);


								// pre_print_r(array_keys($group_value));
								if(!array_key_exists('entry', $group_value)){
									pre_print_r($ober_key);
								}

								// pre_print_r($group_value);
								if(!isset($group_value['entry'][0])){
									// pre_print_r($group_value['entry']);
									// pre_print_r($tmp_glob_arr[$ober_key]['unterBegriff'][$unter_key]['group'][$group_key]['entry']);
									$tmp_glob_arr[$ober_key]['unterBegriff'][$unter_key]['group'][$group_key]['entry'] = array($group_value['entry']) ;
									// pre_print_r(array_keys($tmp_glob_arr[$ober_key]['unterBegriff'][$unter_key]['group'][$group_key]));
								}else{
									// pre_print_r(array_keys($group_value['entry']));
									// pre_print_r($group_value['entry']);
									// foreach ($group_value['entry'] as $entry_k => $entry_v) {
									// 	pre_print_r(array_keys($entry_v));
									// }
								}
							}
						}else{
							// pre_print_r($unter_key);
							// pre_print_r($unterBegriff['group']);
							// pre_print_r('~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~');
							$tmp_group = $unterBegriff['group'];
							if(array_key_exists('@attributes', $tmp_group)){
								unset($tmp_group['@attributes']);
							}
							// pre_print_r(array_keys($tmp_group));

							if(!isset($tmp_group['entry'][0])){
								$one_entry = $tmp_group['entry'];
								$tmp_group['entry'] = array( 0 => $one_entry);
							}
							$tmp_glob_arr[$ober_key]['unterBegriff'][$unter_key]['group'] = array( 0 =>$tmp_group);
						}

						if(array_key_exists('@attributes', $unterBegriff['group'])){
							unset($unterBegriff['group']['@attributes']);
						}
					}
					// pre_print_r('_____________________');
				}
					// pre_print_r('~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~');
	}
}








// pre_print_r($tmp_glob_arr);
array_to_file($tmp_glob_arr);
// foreach ($tmp_glob_arr as $key => $value) {pre_print_r($key); }
pre_print_r("<p><h3>Merge dupli & undupli part to one array</h3></p><h3><a href='./export_glob_XML.php'>Next</a></h3>");
