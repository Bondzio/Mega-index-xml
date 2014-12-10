<?php
include './db_array/db_o_u_id.php';
include './db_array/db_word_id.php';
include './db_array/db_duplicate_word.php';
include './db_array/db_duplicate_uname_volcabulary_list.php';
include './db_array/db_u_duplicate.php';
include './db_array/db_duplicate_arr.php';
require_once('./utility.php');



// generate word_id for link. remove "," or "(" in ober.
$pattern = "/(.*?)(,\s|\s\()(.*)/"; 
$word_id_for_link = array();
foreach ($word_id as $key => $value) {
	preg_match($pattern, $value, $matches);
	if(!empty($matches)){
	$word_id_for_link[$key] = $matches[1];
	}
}

array_to_file($word_id_for_link);
// pre_print_r($word_id_for_link);
// exit;


// pre_print_r($duplicate_uname_volcabulary_list);
// put both oname and uname duplicated items to $o_u_duplicate_list
$o_u_duplicate_list = array();
foreach ($o_u_id as $key => $value) {
	if(is_array($value)){
		$o_u_duplicate_list[$key] = $value;
		unset($o_u_id[$key]);
	}
}

// pre_print_r($o_u_duplicate_list);
$o_u_duplicate_list_id = array();
foreach ($o_u_duplicate_list as $key => $value) {
	$o_u_duplicate_list_id[$key]['oname'] = $o_u_duplicate_list[$key]['oname'];
	if(array_key_exists('unterBegriff', $value)){
		foreach ($value['unterBegriff'] as $k => $v) {
			$num = sprintf("_%03d",($k+1));
			$tmp = $key.$num;
			$o_u_duplicate_list_id[$key]['unterBegriff'][$tmp] = $v;
		}
	}

	if(array_key_exists('link', $value)){
		foreach ($value['link'] as $k => $v) {
			$num = array_search($v, $word_id);
			if($num){
				$o_u_duplicate_list_id[$key]['link'][$num] = $v;
			}else{
				// cannot find ober for link words;

				// preg words like "Profit, kommerzieller" and "Indien, Wechselkurs";

				$num = array_search($v, $word_id_for_link);
				if(!empty($num)){
					$o_u_duplicate_list_id[$key]['link'][$num] = $v;
				}else{
					$v_tmp = 0;
					preg_match($pattern, $v, $match);
					if(!empty($match)) {$v_tmp = $match[1]; }
						
					if($v_tmp!==0){
						$num = array_search($v_tmp, $word_id);
						if($num){
							$o_u_duplicate_list_id[$key]['link'][$num] = $v;
						}else{
						// cannot find word id for this link;
							// pre_print_r($v);
						}
					}else{
						// cannot find word id for this link;
						echo "<b>";
						pre_print_r($key);
						pre_print_r($value['oname']);
						echo "</b>";
						pre_print_r($v);

					}
				}

				// pre_print_r('<b>');
				// pre_print_r($value['oname']);
				// pre_print_r('</b>');
				// pre_print_r("	-> $v");
			}
		}
	}
}


// add key 0 to those unterBegriff only has one;
foreach ($duplicate_arr as $key => $value) {
	// pre_print_r($value);exit;
	if(array_key_exists('unterBegriff', $value[0])){
		if(!array_key_exists(0, $value[0]['unterBegriff'])){
			$tmp = $value[0]['unterBegriff'];
			$duplicate_arr[$key][0]['unterBegriff'] = array( 0 => $tmp);
		}
	}

	if(array_key_exists('unterBegriff', $value[1])){
		if(!array_key_exists(0, $value[1]['unterBegriff'])){
			$tmp = $value[1]['unterBegriff'];
			$duplicate_arr[$key][1]['unterBegriff'] = array( 0 => $tmp);
		}
	}
}


foreach ($o_u_duplicate_list_id as $key => $value) {
	$oname = $o_u_duplicate_list_id[$key]['oname'];
	// pre_print_r($o_u_duplicate_list_id[$key]['unterBegriff']);
	if(array_key_exists('unterBegriff', $value)){
		$unter_arr = $o_u_duplicate_list_id[$key]['unterBegriff'];
		foreach ($unter_arr as $k => $v) {
			// pre_print_r($k.' => '.$v);
			$o_u_duplicate_list_id[$key]['unterBegriff'][$k] = array('uname' => $v);

// 			// $u_duplicate contains all both ober&unter duplicate arrs;
			if(array_key_exists(0, $u_duplicate[$oname])){
				if(in_array($v, $u_duplicate[$oname][0])){

				// pre_print_r($k.' => '.$v);
// 				// pre_print_r($duplicate_arr[$key]);
// 				// foreach array 0 and array 1;
					foreach ($duplicate_arr[$key] as $tmp_glob) {
						if(array_key_exists('unterBegriff', $tmp_glob)){
							foreach ($tmp_glob['unterBegriff'] as $unter_k => $unter_v) {
								if($unter_v['uname'] == $v){
									$o_u_duplicate_list_id[$key]['unterBegriff'][$k]['group'] = $unter_v['group'];
								}						
							}
						}
						// else{
						// 	those arr without unterBegriff;
						// 	pre_print_r($tmp_glob);
						// }
					}
			}else{
// 					// if(in_array($v, $u_duplicate[$oname][0])){
// 					// since $v is not in $u_duplicate[$oname][0], so this is not ober&unter duplicated word;
					// pre_print_r($oname." => ".$v);
					foreach ($duplicate_arr[$key] as $tmp_glob) {
						if(array_key_exists('unterBegriff', $tmp_glob)){
						foreach ($tmp_glob['unterBegriff'] as $unter_k => $unter_v) {
							if($unter_v['uname'] == $v){
								$o_u_duplicate_list_id[$key]['unterBegriff'][$k]['group'] = $unter_v['group'];
								}						
							}
						}
				}
		}

				}else{
			// if(array_key_exists(0, $u_duplicate[$oname])){
			// pre_print_r($key);
					foreach ($duplicate_arr[$key] as $tmp_glob) {
						if(array_key_exists('unterBegriff', $tmp_glob)){
							foreach ($tmp_glob['unterBegriff'] as $unter_k => $unter_v) {
								if($unter_v['uname'] == $v){
									$o_u_duplicate_list_id[$key]['unterBegriff'][$k]['group'] = $unter_v['group'];
								}
						}
					}
						// else{
						// 	those arr without unterBegriff;
						// 	pre_print_r($tmp_glob);
						// }
					}

				}
			}
		}
	}


// pre_print_r($o_u_duplicate_list_id);
// pre_print_r($unterBegriff_tmp_glob);
// pre_print_r(count($o_u_duplicate_list_id));  //201
pre_print_r("<p><h3>Merge ober&unter-duplicated words</h3></p><h3><a href='./unduplicate_to_arr.php'>Next</a></h3>");
// pre_print_r($o_u_duplicate_list_id);
array_to_file($o_u_duplicate_list_id);
// $o_u_duplicate_list_id includes all the info of both ober&unter are duplicated words;
