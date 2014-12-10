<?php
include './db_array/db_o_u_id.php';
include './db_array/db_word_id.php';
include './db_array/db_duplicate_word.php';
include './db_array/db_duplicate_uname_volcabulary_list.php';
include './db_array/db_u_duplicate.php';
include './db_array/db_duplicate_arr.php';
include './db_array/db_unduplicate_arr.php';
include './db_array/db_word_id_for_link.php';
require_once('./utility.php');

foreach ($unduplicate_arr as $key => $value) {
	if(array_key_exists('unterBegriff', $value)){
		if(!array_key_exists(0, $value['unterBegriff'])){
			$tmp = $value['unterBegriff'];
			$unduplicate_arr[$key]['unterBegriff'] = array( 0 => $tmp); }
		}
	}


// pre_print_r($unduplicate_arr['A0005']);
// change 3 entry as 1 entry arr, add all entries to one;
	foreach ($unduplicate_arr as $key => $value) {
		// if(array_key_exists('unterBegriff', $value)){
		// 	$unter_arr = $value['unterBegriff'];

		// 	foreach ($unter_arr as $k => $v) {
		// 	}
		// }

		if(array_key_exists('link', $value)){
			if(!array_key_exists(0, $value['link'])){
			// pre_print_r($value['link']);
				$unduplicate_arr[$key]['link'] = array( 0 => $value['link']);
			}else{
			// pre_print_r(array_keys($value['link']));
				foreach ($value['link'] as $key_link => $value_link) {
					$unduplicate_arr[$key]['link'][] = $value_link;
				}
			// pre_print_r($value['link']);
			}
		}

		if(array_key_exists('@attributes', $value)){
		// pre_print_r($unduplicate_arr[$key]['@attributes']);
			unset($unduplicate_arr[$key]['@attributes']);
		}
	}


	pre_print_r('-------------------------------------------------------------------------------');
	// pre_print_r($unduplicate_arr);

	foreach ($unduplicate_arr as $key => $value) {
	// if($key == 'A0007'){

// set unterBegriff id;
		if(array_key_exists('unterBegriff', $value)){
		// pre_print_r(array_keys($value['unterBegriff']));
			foreach ($value['unterBegriff'] as $k => $v ) {
				$num = sprintf("_%03d",($k+1));
				$tmp = $key.$num;
				$unduplicate_arr[$key]['unterBegriff'][$tmp] = $v;
				unset($unduplicate_arr[$key]['unterBegriff'][$k]);
			}
		}


	// change link word id to refer to word id list;
		if(array_key_exists('link', $value)){
		// pre_print_r($value['link']);
			if(array_key_exists(0, $value['link'])){
				foreach ($value['link'] as $k_link => $v_link) {
				// pre_print_r($v_link['@content']);
					unset($unduplicate_arr[$key]['link'][$k_link]);
					$link_id = array_search($v_link['@content'], $word_id);

					if($link_id){
					// pre_print_r($link_id);
						$unduplicate_arr[$key]['link'][$link_id] = $v_link['@content'];
					}else{
						// do something to find....id;
						$link_id = array_search($v_link['@content'], $word_id_for_link);
						if($link_id){
							$unduplicate_arr[$key]['link'][$link_id] = $v_link['@content'];
						}else{
							$pattern = "/(.*?)(,\s|\s\()(.*)/"; 
								preg_match($pattern, $v_link['@content'], $matches);
								if(!empty($matches)){
									$link_id = array_search($matches[1], $word_id);
									if($link_id){
										$unduplicate_arr[$key]['link'][$link_id] = $v_link['@content'];
									}else{
										$link_id = array_search($matches[1], $word_id_for_link);
										if($link_id){
											$unduplicate_arr[$key]['link'][$link_id] = $v_link['@content'];
										}else{
												// pre_print_r('<h3>link words don\'t have word id</h3>');
												// pre_print_r($value['oname']);
												// pre_print_r('=> '.$v_link['@content']);
										}
									}
								}else{

									pre_print_r('<h3>link words don\'t have word id</h3>');
									pre_print_r($value['oname']);
									pre_print_r('=> '.$v_link['@content']);

								}


							}
						}

				// $unduplicate_arr[$key]['link'][] = 
					}

				}
			}
		}
// }

// pre_print_r($unduplicate_arr);
		$o_u_unduplicate_list_id = $unduplicate_arr;
		unset($unduplicate_arr);
		array_to_file($o_u_unduplicate_list_id);
		pre_print_r("<p><h3>Merge non-duplicated words</h3></p><h3><a href='./merge_dupli_undupli.php'>Next</a></h3>");


		exit;
		foreach ($o_u_unduplicate_list_id as $ober_key => $oberBegriff) {
			if(isset($oberBegriff['unterBegriff'])){
				foreach ($oberBegriff['unterBegriff'] as $unter_key => $unterBegriff) {
					pre_print_r($unter_key);
				}

			}		}
