<?php
include './db_array/db_tmp_glob_arr.php';
require_once('./utility.php');

$dom = new DomDocument('1.0', 'UTF-8');
$newGlobRegXML = $dom->appendChild($dom->createElement('globReg'));
// pre_print_r($tmp_glob_arr['oberBegriff'][0]['unterBegriff'][6]['uname']);
// pre_print_r(count($tmp_glob_arr));// equal to 1471 (= count($word_id));
// test count of unter...

foreach ($tmp_glob_arr as $ober_key => $oberBegriff) {
	$ober = $newGlobRegXML->appendChild($dom->createElement('oberBegriff'));
	$ober->setAttribute('xml:id', $ober_key);
	$oname = $ober->appendChild($dom->createElement('oname',trimUTF8BOM($oberBegriff['oname'])));
// 	// link to append to the last line of this funciton;
// 	// $unter = $ober->appendChild($dom->createElement('unterBegriff'));
if(isset($oberBegriff['unterBegriff'])){
	
	if(isset($oberBegriff['unterBegriff']['uname'])){
				// should be empty
				pre_print_r($oberBegriff['unterBegriff']);
			}else{
				// pre_print_r($oberBegriff['unterBegriff']);
				foreach ($oberBegriff['unterBegriff'] as $unter_key => $unterBegriff) {
					$unter = $ober->appendChild($dom->createElement('unterBegriff'));
					$unter->setAttribute('xml:id', $unter_key);
					// $unter->setAttribute('uname', trimUTF8BOM($unterBegriff['uname']));
					$unter->appendChild($dom->createElement('uname', trimUTF8BOM($unterBegriff['uname'])));

					// pre_print_r(array_keys($unterBegriff));
					// pre_print_r($unterBegriff['uname']);
					// pre_print_r($unterBegriff['entry']);
// 					// $unter = $ober->appendChild($dom->createElement('unterBegriff'));
// 					// pre_print_r($entry['entry']);

					$group_limit = 3;
					if(count($unterBegriff['entry']) > $group_limit){

						// pre_print_r(count($unterBegriff['entry']));
						$group_arr = array_chunk($unterBegriff['entry'], $group_limit);
						// pre_print_r(array_keys($group_arr)); 
						foreach ($group_arr as $k_group_arr => $v_group_arr) {

							$group = $unter->appendChild($dom->createElement('group'));
							$group->setAttribute('oname', trimUTF8BOM($oberBegriff['oname']));
							$group->setAttribute('uname', trimUTF8BOM($unterBegriff['uname']));
							// pre_print_r(count($v_group_arr)); // should < 3;
							foreach ($v_group_arr as $k_entry => $v_entry) {
							// pre_print_r(array_keys($v_entry));
								// pre_print_r($v_entry);

								if(count(array_keys($v_entry)) != 8){
									// pre_print_r($v_entry);
									// name book startPage endPage startLine endLine startTerm endTerm
								}

								foreach ($v_entry as $k => $v) {
									if(is_array($v)){
										if(empty($v)){
											$v_entry[$k] = '';
										}else{
											// pre_print_r($oberBegriff['oname']);
											// pre_print_r($unterBegriff['uname']);
											// pre_print_r($v_entry);
											// pre_print_r($k); pre_print_r($v);
											// pre_print_r($v['@content']);
											$v_entry[$k] = $v['@content'];
										}
									}
								}


								if(!isset($v_entry['name'])){
									// pre_print_r('<h4>The under entries do not have name tag</h4>');
									// pre_print_r($oberBegriff['oname']);
									// pre_print_r($unterBegriff['uname']);
											// pre_print_r($v_entry);
									$v_entry['name'] = $unterBegriff['uname'];
								}

								if(!isset($v_entry['startLine'])){
									// pre_print_r($v_entry);
									$v_entry['startLine'] = '';
								}
								if(!isset($v_entry['endLine'])){
									// pre_print_r($v_entry);
									$v_entry['endLine'] = '';
								}
								if(!isset($v_entry['startTerm'])){
									// pre_print_r($v_entry);
									$v_entry['startTerm'] = '';
								} 
								if(!isset($v_entry['endTerm'])){
									// pre_print_r($v_entry);
									$v_entry['endTerm'] = '';
								} 

								// pre_print_r($v_entry['name']);

								// pre_print_r(array_keys($v_entry));
								$name_value = $v_entry['name'];
								$book_value = $v_entry['book'];
								$startPage_value = $v_entry['startPage'];
								$endPage_value = $v_entry['endPage'];
								$startLine_value = $v_entry['startLine'];
								$endLine_value = $v_entry['endLine'];
								$startTerm_value = $v_entry['startTerm'];
								$endTerm_value = $v_entry['endTerm'];

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
					}else{
					// if(count($unterBegriff['entry']) > $group_limit){
						foreach ($unterBegriff['entry'] as $k_entry_arr => $v_entry_arr) {

							$group = $unter->appendChild($dom->createElement('group'));
							$group->setAttribute('oname', trimUTF8BOM($oberBegriff['oname']));
							$group->setAttribute('uname', trimUTF8BOM($unterBegriff['uname']));
							// pre_print_r($v_group_arr);
							if(count(array_keys($v_entry)) != 8){
								// pre_print_r($v_entry);
								// name book startPage endPage startLine endLine startTerm endTerm
							}

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



									if(!isset($v_entry['name'])){
										// pre_print_r('<h4>The under entries do not have name tag</h4>');
										// pre_print_r($oberBegriff['oname']);
										// pre_print_r($unterBegriff['uname']);
												// pre_print_r($v_entry);
										$v_entry['name'] = $unterBegriff['uname'];
									}

									if(!isset($v_entry['startLine'])){
										// pre_print_r($v_entry);
										$v_entry['startLine'] = '';
									}
									if(!isset($v_entry['endLine'])){
										// pre_print_r($v_entry);
										$v_entry['endLine'] = '';
									}
									if(!isset($v_entry['startTerm'])){
										// pre_print_r($v_entry);
										$v_entry['startTerm'] = '';
									} 
									if(!isset($v_entry['endTerm'])){
										// pre_print_r($v_entry);
										$v_entry['endTerm'] = '';
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


					// foreach ($unterBegriff['entry'] as $k_entry => $v_entry) {}


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
