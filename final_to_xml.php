<?php
include './utility.php';
include './db_array/db_part2xml.php';
// include './merged_xml.php';


// for ($i=0; $i < count($result['oberBegriff']); $i++) { 
// 	$volcabulary[] = $result['oberBegriff'][$i]['oname'];
// }

$dom = new DomDocument('1.0', 'UTF-8');
$finalXML = $dom->appendChild($dom->createElement('globReg'));


// pre_print_r($part2xml['oberBegriff'][3]['unterBegriff']);
// pre_print_r($part2xml['oberBegriff'][3]['unterBegriff'][0]['uname']);
// pre_print_r($part2xml['oberBegriff'][3]['unterBegriff'][1]['uname']);
// pre_print_r($part2xml['oberBegriff'][4]['unterBegriff']['uname']);
// pre_print_r($part2xml['oberBegriff'][4]);
// pre_print_r($part2xml['oberBegriff'][3]);

// pre_print_r($part2xml['oberBegriff'][0]['unterBegriff'][6]['uname']);


foreach ($part2xml['oberBegriff'] as $oberBegriff) {

	$ober = $finalXML->appendChild($dom->createElement('oberBegriff'));
	$oname = $ober->appendChild($dom->createElement('oname', $oberBegriff['oname']));
	// link to append to the last line of this funciton;
	// $unter = $ober->appendChild($dom->createElement('unterBegriff'));


if(isset($oberBegriff['unterBegriff'])){


	// $unter = $ober->appendChild($dom->createElement('unterBegriff'));
	
	if(isset($oberBegriff['unterBegriff']['uname'])){
			// pre_print_r($oberBegriff);
			$unter = $ober->appendChild($dom->createElement('unterBegriff'));
			$uname = $unter->appendChild($dom->createElement('uname', $oberBegriff['unterBegriff']['uname']));
			// $group = $unter->appendChild($dom->createElement('group'));
			// $group->setAttribute('oname', $oberBegriff['oname']);
			// $group->setAttribute('uname', $oberBegriff['unterBegriff']['uname']);

			if(isset($oberBegriff['unterBegriff']['group']['entry'])){
				// pre_print_r($oberBegriff['unterBegriff']['group']['entry']);
				$group = $unter->appendChild($dom->createElement('group'));
				$group->setAttribute('oname', $oberBegriff['oname']);
				$group->setAttribute('uname', $oberBegriff['unterBegriff']['uname']);

				$entry = $group->appendChild($dom->createElement('entry'));
				$name = $entry->appendChild($dom->createElement('name', $oberBegriff['unterBegriff']['group']['entry']['name']));
				$book = $entry->appendChild($dom->createElement('book', $oberBegriff['unterBegriff']['group']['entry']['book']));
				$startPage = $entry->appendChild($dom->createElement('startPage', $oberBegriff['unterBegriff']['group']['entry']['startPage']));
				$endPage = $entry->appendChild($dom->createElement('endPage'));
				$startLine = $entry->appendChild($dom->createElement('startLine', ' '));
				$endLine = $entry->appendChild($dom->createElement('endLine'));
				$startTerm = $entry->appendChild($dom->createElement('startTerm', ' '));
				$endTerm = $entry->appendChild($dom->createElement('endTerm'));

			}else{
				// pre_print_r($oberBegriff['unterBegriff']['group']);
				foreach ($oberBegriff['unterBegriff']['group'] as $entry) {
					// $unter = $ober->appendChild($dom->createElement('unterBegriff'));
					// pre_print_r($entry['entry']);
					$group = $unter->appendChild($dom->createElement('group'));
					$group->setAttribute('oname', $oberBegriff['oname']);
					$group->setAttribute('uname', $oberBegriff['unterBegriff']['uname']);

					$name_value = $entry['entry']['name'];
					$book_value = $entry['entry']['book'];
					$startPage_value = $entry['entry']['startPage'];

					$entry = $group->appendChild($dom->createElement('entry'));
					$name = $entry->appendChild($dom->createElement('name', $name_value));
					$book = $entry->appendChild($dom->createElement('book', $book_value));
					$startPage = $entry->appendChild($dom->createElement('startPage', $startPage_value));
					$endPage = $entry->appendChild($dom->createElement('endPage'));
					$startLine = $entry->appendChild($dom->createElement('startLine', ' '));
					$endLine = $entry->appendChild($dom->createElement('endLine'));
					$startTerm = $entry->appendChild($dom->createElement('startTerm', ' '));
					$endTerm = $entry->appendChild($dom->createElement('endTerm'));

				}
			}


		}else{


			// uname is array;
		foreach ($oberBegriff['unterBegriff'] as $unterBegriff) {
			// pre_print_r($unterBegriff['uname']);
			// pre_print_r($unterBegriff);
			$unter = $ober->appendChild($dom->createElement('unterBegriff'));
			$uname = $unter->appendChild($dom->createElement('uname', $unterBegriff['uname']));

			if (isset($unterBegriff['group']['entry'])) {
				// pre_print_r($unterBegriff['group']['entry']['name']);
				// pre_print_r($unterBegriff['group']['entry']['startPage']);
				$group = $unter->appendChild($dom->createElement('group'));
				$group->setAttribute('oname', $oberBegriff['oname']);
				$group->setAttribute('uname', $unterBegriff['uname']);


				$entry = $group->appendChild($dom->createElement('entry'));
				$name = $entry->appendChild($dom->createElement('name', $unterBegriff['group']['entry']['name']));
				$book = $entry->appendChild($dom->createElement('book', $unterBegriff['group']['entry']['book']));
				$startPage = $entry->appendChild($dom->createElement('startPage', $unterBegriff['group']['entry']['startPage']));
				$endPage = $entry->appendChild($dom->createElement('endPage'));
				$startLine = $entry->appendChild($dom->createElement('startLine', ' '));
				$endLine = $entry->appendChild($dom->createElement('endLine'));
				$startTerm = $entry->appendChild($dom->createElement('startTerm', ' '));
				$endTerm = $entry->appendChild($dom->createElement('endTerm'));
				// foreach ($unterBegriff as $unterBegriff_i) {// pre_print_r($unterBegriff_i['uname']); }
				// $group = $unter->appendChild($dom->createElement('group'));
				// $entry = $group->appendChild($dom->createElement('entry'));

			}else{

					// $group = $unter->appendChild($dom->createElement('group'));
					// $group->setAttribute('oname', $oberBegriff['oname']);
					// $group->setAttribute('uname', $unterBegriff['uname']);

					// pre_print_r($unterBegriff);

				foreach ($unterBegriff['group'] as $entry_arr) {
					// pre_print_r($entry_arr['entry']['startPage']);
					// pre_print_r($entry_arr['entry']);
					$group = $unter->appendChild($dom->createElement('group'));
					$group->setAttribute('oname', $oberBegriff['oname']);
					$group->setAttribute('uname', $unterBegriff['uname']);

					$entry = $group->appendChild($dom->createElement('entry'));
					$name = $entry->appendChild($dom->createElement('name', $entry_arr['entry']['name']));
					$book = $entry->appendChild($dom->createElement('book', $entry_arr['entry']['book']));
					$startPage = $entry->appendChild($dom->createElement('startPage', $entry_arr['entry']['startPage']));
					$endPage = $entry->appendChild($dom->createElement('endPage'));
					$startLine = $entry->appendChild($dom->createElement('startLine', ' '));
					$endLine = $entry->appendChild($dom->createElement('endLine'));
					$startTerm = $entry->appendChild($dom->createElement('startTerm', ' '));
					$endTerm = $entry->appendChild($dom->createElement('endTerm'));
					// foreach ($unterBegriff as $unterBegriff_i) {// pre_print_r($unterBegriff_i['uname']); }
					// $group = $unter->appendChild($dom->createElement('group'));
					// $entry = $group->appendChild($dom->createElement('entry'));
				}
		}




	}}
		if(isset($oberBegriff['link'])){
			if(isset($oberBegriff['link']['@content'])){
				// pre_print_r($oberBegriff['link']);
				$link = $ober->appendChild($dom->createElement('link', trim($oberBegriff['link']['@content'])));
				//$oberBegriff['link']['@content']) = array( target = '');
				// 
				$link->setAttribute('target', '');
			}else{
				foreach ($oberBegriff['link'] as $link_arr) {
					// pre_print_r($link_arr['@content']);
					$link = $ober->appendChild($dom->createElement('link', trim($link_arr['@content'])));
					$link->setAttribute('target', '');
				}
			}

		}else{
			//exception: Hypothese 
			// pre_print_r($oberBegriff['oname']." don't have link!");
		}



	// $ober = $globReg->appendChild($dom->createElement('oberBegriff'));
	// $oname = $ober->appendChild($dom->createElement('oname', $key_char[$i]));

	}else{
		// those words don't have unter
		//Exp:  Handelsfreiheit
		//		#Freihandel

		if(isset($oberBegriff['link'])){
				if(isset($oberBegriff['link']['@content'])){
					// pre_print_r($oberBegriff['link']);
					$link = $ober->appendChild($dom->createElement('link', trim($oberBegriff['link']['@content'])));
					//$oberBegriff['link']['@content']) = array( target = '');
					// 
					$link->setAttribute('target', '');
				}else{
					foreach ($oberBegriff['link'] as $link_arr) {
						// pre_print_r($link_arr['@content']);
						$link = $ober->appendChild($dom->createElement('link', trim($link_arr['@content'])));
						$link->setAttribute('target', '');
					}
				}

			}else{
				//exception: Hypothese 
				//don't has links;
				pre_print_r($oberBegriff['oname']." don't have link!");
			}
	}
};




$dom->formatOutput = true;
$dom->save('./xml/test_final.xml');