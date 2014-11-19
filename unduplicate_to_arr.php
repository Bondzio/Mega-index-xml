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

// change 3 entry as 1 entry arr, add all entries to one;
foreach ($unduplicate_arr as $key => $value) {
	if(array_key_exists('unterBegriff', $value)){
		$unter_arr = $value['unterBegriff'];

		foreach ($unter_arr as $k => $v) {
			if(array_key_exists(0, $v['group'])){
				$unduplicate_arr[$key]['unterBegriff'][$k]['group']['entry'] = array();
				foreach ($v['group'] as $k_group => $v_group) {
					foreach ($v_group as $k_entry => $v_entry) {
						if($k_entry == 'entry'){
							// pre_print_r($v_entry);
							if(array_key_exists(0, $v_entry)){
								foreach ($v_entry as $k_sub_entry => $v_sub_entry) {
									// pre_print_r($v_sub_entry);
									$unduplicate_arr[$key]['unterBegriff'][$k]['group']['entry'][] = $v_sub_entry;
									// unset($unduplicate_arr[$key][0]['unterBegriff'][$k]['group'][$k_group]['entry']);
									}
								}else{
									// pre_print_r($v_entry);
									$unduplicate_arr[$key]['unterBegriff'][$k]['group']['entry'][] = $v_entry;
								}
						}
						unset($unduplicate_arr[$key]['unterBegriff'][$k]['group'][$k_group]['entry']);
					}
						unset($unduplicate_arr[$key]['unterBegriff'][$k]['group'][$k_group]);
				}
			}else{
				// if(array_key_exists(0, $v['group'])){
				// pre_print_r($v['group']['entry']);
				// pre_print_r(count($unduplicate_arr[$key][1]['unterBegriff']));

				$tmp = array(0 => $v['group']['entry']);
				foreach ($unduplicate_arr[$key]['unterBegriff'] as $k_tmp => $v_tmp) {
				unset($unduplicate_arr[$key]['unterBegriff'][$k_tmp]['group']['entry']);
				$unduplicate_arr[$key]['unterBegriff'][$k_tmp]['group']['entry'] = $tmp;

				}
			}
		}
	}

	if(array_key_exists('link', $value)){
		// pre_print_r($value['link']);
		if(!array_key_exists(0, $value['link'])){
			// pre_print_r($value['link']['@content']);
			// pre_print_r($value['link']);
			$unduplicate_arr[$key]['link'] = array( 0 => $value['link']);
		}
	}





}


foreach ($unduplicate_arr as $key => $value) {
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
						// pre_print_r($v_link['@content']);
						// do something to find....id;
						$link_id = array_search($v_link['@content'], $word_id_for_link);
						if($link_id){
							$unduplicate_arr[$key]['link'][$link_id] = $v_link['@content'];
						}else{
							$pattern = "/(.*?)(,\s|\s\()(.*)/"; 
							preg_match($pattern, $v_link['@content'], $matches);
								if(!empty($matches)){
									$link_id = array_search($matches[1], $word_id_for_link);
									if($link_id){
										$unduplicate_arr[$key]['link'][$link_id] = $v_link['@content'];
									}else{

									// pre_print_r('<h3>link words don\'t have word id</h3>');
									// pre_print_r($value['oname']);
									// pre_print_r('=> '.$v_link['@content']);

									}
								}else{

									// pre_print_r('<h3>link words don\'t have word id</h3>');
									// pre_print_r($value['oname']);
									// pre_print_r('=> '.$v_link['@content']);

								}


						}
				}

				// $unduplicate_arr[$key]['link'][] = 
			}

		}
	}
}


// pre_print_r($unduplicate_arr);
$o_u_unduplicate_list_id = $unduplicate_arr;
unset($unduplicate_arr);
array_to_file($o_u_unduplicate_list_id);
pre_print_r("<p><h3>Merge non-duplicated words</h3></p><h3><a href='./merge_dupli_undupli.php'>Next</a></h3>");
