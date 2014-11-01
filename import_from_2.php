<?php
include './db_array/db_globRegxml.php';
include './db_array/db_tmpxml.php';
include './db_array/db_o_u_id.php';
include './db_array/db_word_id.php';
include './db_array/db_duplicate_word.php';
include './db_array/db_duplicate_uname_volcabulary_list.php';
include './db_array/db_u_duplicate.php';
require_once('./utility.php');


// pre_print_r($word_id);;
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
				$o_u_duplicate_list_id[$key]['link'][$num] = $v;
				// pre_print_r('<b>');
				// pre_print_r($value['oname']);
				// pre_print_r('</b>');
				// pre_print_r("	-> $v");
			}
		}
	}
}


// both id of uname and links are inserted.
// pre_print_r($o_u_duplicate_list_id);
// pre_print_r($u_duplicate);



// pre_print_r($duplicate_word);
// put all duplicate word in $duplicate_arr;
$duplicate_arr = array();
$o_arr = $globRegxml['oberBegriff'];
// pre_print_r($o_u_id);
foreach ($o_arr as $ober) {
	$oname = trimUTF8BOM($ober['oname']);
	if(!in_array($oname, $duplicate_word)){
		$tmp = array_search($oname, $word_id);
		$o_u_id[$tmp] = $ober;
	}else{
		$tmp = array_search($oname, $word_id);
		$duplicate_arr[$tmp][] = $ober;
	}
}

$o_arr = $tmpxml['oberBegriff'];
foreach ($o_arr as $ober) {
	$oname = trimUTF8BOM($ober['oname']);
	if(!in_array($oname, $duplicate_word)){
		$tmp = array_search($oname, $word_id);
		$o_u_id[$tmp] = $ober;
	}else{
		$tmp = array_search($oname, $word_id);
		$duplicate_arr[$tmp][] = $ober;
	}
}


// all the unduplicate words array are put in $o_u_id;
// pre_print_r($o_u_id['A0003']); // unduplicated obers
// Next to reset id for each array;




// pre_print_r($duplicate_arr['A0148']); // duplicatd obers
// pre_print_r($duplicate_arr['A0125'][0]); // duplicatd obers
// pre_print_r($duplicate_arr['A0125'][1]); // duplicatd obers
// pre_print_r($duplicate_arr); // duplicatd obers
// array_to_file($duplicate_arr);


// pre_print_r($u_duplicate);
foreach ($duplicate_arr as $key => $value) {
	$tmp_uname = $duplicate_arr[$key][0];
	if(array_key_exists('unterBegriff', $tmp_uname)){

		if(array_key_exists('uname', $tmp_uname['unterBegriff'])){
			$needle = $tmp_uname['unterBegriff']['uname'];
			// pre_print_r($tmp_uname['oname']);
			if(array_key_exists(0, $u_duplicate[$tmp_uname['oname']])){
				if(in_array($needle, $u_duplicate[$tmp_uname['oname']][0])){
					// pre_print_r($needle);
					// duplicated uname;
					// do something here to merge two uname array;
				}else{
					// since not in array of duplcated uname,
					// no need to merge, just insert to array.
				}
			}
		}else{
			// pre_print_r($tmp_uname);
			foreach ($tmp_uname['unterBegriff'] as $k => $v) {
				if(array_key_exists(0, $u_duplicate[$tmp_uname['oname']])){
					if(in_array($v['uname'], $u_duplicate[$tmp_uname['oname']][0])){
						// pre_print_r($v['uname']);
						// duplicated uname;
						// do something here to merge two uname array;
						}else{
							// duplicated uname;
							// do something here to merge two uname array;
						}
					}
				}
		}
	}else{
		// don't have uname;
		// only has links
		// pre_print_r($tmp_uname);
	}

	// $glb_oname = $duplicate_arr[$key][1]['oname'];
	// pre_print_r($tmp_uname);
}
