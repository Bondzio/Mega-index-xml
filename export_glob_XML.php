<?php
include './db_array/db_tmp_glob_arr.php';
require_once('./utility.php');

$dom = new DomDocument('1.0', 'UTF-8');
$newGlobRegXML = $dom->appendChild($dom->createElement('globReg'));
// pre_print_r($tmp_glob_arr['oberBegriff'][0]['unterBegriff'][6]['uname']);
// pre_print_r(count($tmp_glob_arr));// equal to 1471 (= count($word_id));
// test count of unter...


// pre_print_r($tmp_glob_arr['A0005']);
// exit;

foreach ($tmp_glob_arr as $ober_key => $oberBegriff) {
	$ober = $newGlobRegXML->appendChild($dom->createElement('oberBegriff'));
	$ober->setAttribute('xml:id', $ober_key);
	$oname = $ober->appendChild($dom->createElement('oname',trimUTF8BOM($oberBegriff['oname'])));
// 	// link to append to the last line of this funciton;
// 	// $unter = $ober->appendChild($dom->createElement('unterBegriff'));
	if(isset($oberBegriff['unterBegriff'])){

		if(isset($oberBegriff['unterBegriff']['uname'])){
				// should be empty
				// pre_print_r($oberBegriff['unterBegriff']);
		}else{
				// pre_print_r($oberBegriff['unterBegriff']);
			foreach ($oberBegriff['unterBegriff'] as $unter_key => $unterBegriff) {
					// pre_print_r($unter_key);

				$unter = $ober->appendChild($dom->createElement('unterBegriff'));
				$unter->setAttribute('xml:id', $unter_key);
					// $unter->setAttribute('uname', trimUTF8BOM($unterBegriff['uname']));
				$unter->appendChild($dom->createElement('uname', trimUTF8BOM($unterBegriff['uname'])));

					// pre_print_r(array_keys($unterBegriff));
					// pre_print_r($unterBegriff['uname']);
					// pre_print_r($unterBegriff['entry']);
					// $unter = $ober->appendChild($dom->createElement('unterBegriff'));
					// pre_print_r($entry['entry']);


				foreach ($unterBegriff['group'] as $k_group_arr => $v_group_arr) {
					$group = $unter->appendChild($dom->createElement('group'));
					$group->setAttribute('oname', trimUTF8BOM($oberBegriff['oname']));
					$group->setAttribute('uname', trimUTF8BOM($unterBegriff['uname']));
							// pre_print_r(array_keys($v_group_arr['entry']));
					// pre_print_r(array_keys($v_group_arr['entry']));

					foreach ($v_group_arr['entry'] as $k_entry_arr => $v_entry_arr) {
								// pre_print_r($v_entry_arr);
						// foreach ($v_entry_arr as $k_entry => $v_entry) {
						// 				// pre_print_r($v_entry);
						// }

							// pre_print_r($k_group_arr);
						foreach ($v_entry_arr as $k => $v) {
							if(is_array($v)){
								if(empty($v)){
									$v_entry_arr[$k] = '';
								}else{
									$v_entry_arr[$k] = $v['@content'];
											// pre_print_r($v['@content']);
								}
							}
						}

						if(!isset($v_entry_arr['name'])){
											// pre_print_r('<h4>The under entries do not have name tag</h4>');
											// pre_print_r($oberBegriff['oname']);
											// pre_print_r($unterBegriff['uname']);
											// pre_print_r($v_entry_arr);
							$v_entry_arr['name'] = $unterBegriff['uname'];
						}

						if(!isset($v_entry_arr['startLine'])){
										// pre_print_r($v_entry_arr);
							$v_entry_arr['startLine'] = '';
						}
						if(!isset($v_entry_arr['endLine'])){
										// pre_print_r($v_entry_arr);
							$v_entry_arr['endLine'] = '';
						}
										// if(!isset($v_entry_arr['startPage'])){
										// // pre_print_r($v_entry_arr);
										// 	$v_entry_arr['startPage'] = '';
										// }
										// if(!isset($v_entry_arr['endPage'])){
										// // pre_print_r($v_entry_arr);
										// 	$v_entry_arr['endPage'] = '';
										// }
						if(!isset($v_entry_arr['startTerm'])){
										// pre_print_r($v_entry_arr);
							$v_entry_arr['startTerm'] = '';
						} 
						if(!isset($v_entry_arr['endTerm'])){
										// pre_print_r($v_entry_arr);
							$v_entry_arr['endTerm'] = '';
						} 


								// pre_print_r(array_keys($v_entry_arr));
						$name_value = $v_entry_arr['name'];
						$book_value = $v_entry_arr['book'];
						$startPage_value = $v_entry_arr['startPage'];
						$endPage_value = $v_entry_arr['endPage'];
						$startLine_value = $v_entry_arr['startLine'];
						$endLine_value = $v_entry_arr['endLine'];
						$startTerm_value = $v_entry_arr['startTerm'];
						$endTerm_value = $v_entry_arr['endTerm'];

						$entry = $group->appendChild($dom->createElement('entry'));
						$name = $entry->appendChild($dom->createElement('name', $name_value));
						$book = $entry->appendChild($dom->createElement('book', $book_value));
						$startPage = $entry->appendChild($dom->createElement('startPage', $startPage_value));
						$endPage = $entry->appendChild($dom->createElement('endPage', $endPage_value));
						$startLine = $entry->appendChild($dom->createElement('startLine', $startLine_value));
						$endLine = $entry->appendChild($dom->createElement('endLine', $endLine_value));
						$startTerm = $entry->appendChild($dom->createElement('startTerm', $startTerm_value));
						$endTerm = $entry->appendChild($dom->createElement('endTerm', $endTerm_value));

					}
				}

			}
		}




		if(isset($oberBegriff['link'])){
			foreach ($oberBegriff['link'] as $k_link => $v_link) {
				$link = $ober->appendChild($dom->createElement('link', trimUTF8BOM($v_link)));
				$link->setAttribute('target', trimUTF8BOM($k_link));
			}

// 				if(isset($oberBegriff['link']['@content'])){
// 					// pre_print_r($oberBegriff['link']);
// 					$link = $ober->appendChild($dom->createElement('link', trim($oberBegriff['link']['@content'])));
// 					//$oberBegriff['link']['@content']) = array( target = '');
// 					// 
// 					$link->setAttribute('target', '');
// 				}else{
// 					foreach ($oberBegriff['link'] as $link_arr) {
// 						// pre_print_r($link_arr['@content']);
// 						$link = $ober->appendChild($dom->createElement('link', trim($link_arr['@content'])));
// 						$link->setAttribute('target', '');
// 					}
		}
	}
			// else{
// 				//exception: Hypothese 
// 				//don't has links;
// 				pre_print_r($oberBegriff['oname']." don't have link!");
// 			}


};


$dom->formatOutput = true;
$dom->save('./xml/newGlobReg.xml');
