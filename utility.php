<?php

function pre_print_r($var){
		echo "<pre>";
		print_r($var);
		echo "</pre>";
}   

//return variable name
// function getVarName($var) {      
//   $tmp = array($var => '');
//   $keys = array_keys($tmp);
//   return trim($keys[0]);
// }

function getVarName($var) {
    foreach($GLOBALS as $var_name => $value) {
        if ($value === $var) {
            return $var_name; } }
    return false;
}



//@arrayName: string of name of $array;
function array_to_file($array){
	$arrayName = getVarName($array);
	$fileName = 'db_'.$arrayName.".php";
	$text = '<?php $'.$arrayName.' ='.var_export($array, true).';';
	if(false !== fopen('./db_array/'.$fileName, 'w+')){
	    file_put_contents('./db_array/'.$fileName, $text);
	}else{
	    echo "FAIL!";
	}
}


// if string include "efbbbf", delete it.
function trimUTF8BOM($data){ 
	$data = trim($data);
   if(strlen($data) >= 3 && substr($data, 0, 3) == pack('CCC', 239, 187, 191)) {
       return substr($data, 3);
   }
   return $data;
}

function delFileUnderDir( $dirName ){ 
 if ( $handle = opendir( "$dirName" ) ) { 
  while ( false !== ( $item = readdir( $handle ) ) ) { 
   if ( $item != "." && $item != ".." ) { 
    if ( is_dir( "$dirName/$item" ) ) { 
      delFileUnderDir( "$dirName/$item" ); 
     } else { 
      if( unlink( "$dirName/$item" ) ) echo "";//"已删除文件：$dirName/$item<br />n"; 
     } 
    } 
   } 
  closedir( $handle ); 
 } 
}

function array_to_xml($bookid, $db, $save_path){
  $key_char = $db['key_char'];
  $key_num = $db['key_num'];
  $hyphen_char = $db['hyphen_char'];
  $hyphen_num = $db['hyphen_num'];
  $arrow_char = $db['arrow_char'];
  $dom = new DomDocument('1.0', 'UTF-8');
  $globReg = $dom->appendChild($dom->createElement('globReg'));

for ($i=0; $i < count($key_char) ; $i++) { 
  $key_char[$i] = trim($key_char[$i]);
  pre_print_r($key_char[$i]);

  $ober = $globReg->appendChild($dom->createElement('oberBegriff'));

  //$ober->setAttribute('xml:id', '');
  $oname = $ober->appendChild($dom->createElement('oname', $key_char[$i]));
  // $unter = $ober->appendChild($dom->createElement('unterBegriff'));
  // $unter->setAttribute('xml:id', $i);

  // add key_num;
  //!empty($key_num[$i])?print('0'):print('1');
  if(!empty($key_num[$i])){
    $key_num[$i] = trim($key_num[$i]);
    //$unter->setAttribute('xml:id', '');
    $key_num_array = explode(" ", $key_num[$i]);
    // code for delete -

    // pre_print_r($key_num_array);
    if($key_num_array[0] ==''){
      unset($key_num_array[0]);
    }else{
      $unter = $ober->appendChild($dom->createElement('unterBegriff'));
      $uname = $unter->appendChild($dom->createElement('uname', $key_char[$i]));
    }


    foreach ($key_num_array as $each_page) {
      $each_page = trim($each_page);

      if(strpos($each_page, "-")){
        $each_page = substr($each_page, 0, strpos($each_page, "-"));
      }

      $group = $unter->appendChild($dom->createElement('group'));
      $group->setAttribute('oname', $key_char[$i]);
      $group->setAttribute('uname', $key_char[$i]);
      $entry = $group->appendChild($dom->createElement('entry'));
      $name = $entry->appendChild($dom->createElement('name', $key_char[$i]));
      $book = $entry->appendChild($dom->createElement('book', $bookid));
      $startPage = $entry->appendChild($dom->createElement('startPage', $each_page));
      $endPage = $entry->appendChild($dom->createElement('endPage'));
      $startLine = $entry->appendChild($dom->createElement('startLine',' '));
      $endLine = $entry->appendChild($dom->createElement('endLine'));
      $startTerm = $entry->appendChild($dom->createElement('startTerm',' '));
      $endTerm = $entry->appendChild($dom->createElement('endTerm'));
    }
      // $uname = $unter->appendChild($dom->createElement('uname', $key_char[$i]));
      // $group = $unter->appendChild($dom->createElement('group'));
      // $group->setAttribute('oname', $key_char[$i]);
      // $group->setAttribute('uname', $key_char[$i]);
      // $entry = $group->appendChild($dom->createElement('entry'));
      // $name = $entry->appendChild($dom->createElement('name', $key_char[$i]));
      // $book = $entry->appendChild($dom->createElement('book', '15'));
      // $startPage = $entry->appendChild($dom->createElement('startPage', trim($key_num[$i])));
      // $endPage = $entry->appendChild($dom->createElement('endPage'));
      // $startLine = $entry->appendChild($dom->createElement('startLine',' '));
      // $endLine = $entry->appendChild($dom->createElement('endLine'));
      // $startTerm = $entry->appendChild($dom->createElement('startTerm',' '));
      // $endTerm = $entry->appendChild($dom->createElement('endTerm'));
  }



// add hyphens to the key
  if(array_key_exists($i, $hyphen_char)){
    for ($j=0; $j < count($hyphen_char[$i]) ; $j++) { 
      $hyphen_char [$i][$j] = trim(substr($hyphen_char[$i][$j], 2));
        if(!empty($hyphen_num[$i][$j])){
          $hyphen_num[$i][$j] = trim($hyphen_num[$i][$j]);
          // Each hyphen with couple numbers means one unterBegriff
          $unter = $ober->appendChild($dom->createElement('unterBegriff'));
          //$unter->setAttribute('xml:id', '');
          $uname = $unter->appendChild($dom->createElement('uname', $hyphen_char[$i][$j]));

          $hyphen_num_array = explode(" ", $hyphen_num[$i][$j]);
          foreach ($hyphen_num_array as $each_hyphen_page) {
            $each_hyphen_page = trim($each_hyphen_page);
            if(strpos($each_hyphen_page, "-")){
              $each_hyphen_page = substr($each_hyphen_page, 0, strpos($each_hyphen_page, "-"));
            }

            // Each number of every hyphen meas one group

            
            // pre_print_r($hyphen_char[$i][$j]);
            $group = $unter->appendChild($dom->createElement('group'));
            $group->setAttribute('oname', $key_char[$i]);
            $group->setAttribute('uname', $hyphen_char[$i][$j]);
            $entry = $group->appendChild($dom->createElement('entry'));
            $name = $entry->appendChild($dom->createElement('name', $hyphen_char[$i][$j]));
            $book = $entry->appendChild($dom->createElement('book', $bookid));
            $startPage = $entry->appendChild($dom->createElement('startPage', $each_hyphen_page));
            $endPage = $entry->appendChild($dom->createElement('endPage'));
            $startLine = $entry->appendChild($dom->createElement('startLine',' '));
            $endLine = $entry->appendChild($dom->createElement('endLine'));
            $startTerm = $entry->appendChild($dom->createElement('startTerm',' '));
            $endTerm = $entry->appendChild($dom->createElement('endTerm'));

          }

          }else{
            echo $key_char[$i]." => ".$key_num[$i]." => ".$hyphen_char[$i][$j]."seems has some problem, check your text file";
          }

      }
  }

// add link to the key
  if(array_key_exists($i, $arrow_char)){
    $arrow_string = substr(trim($arrow_char[$i]), 2);
    $arrow_string = rtrim($arrow_string, ";");
    // handle those arrow word ended with ';';
    $arrow_arr = explode(";", $arrow_string);
      foreach ($arrow_arr as $each_arrow_arr) {
        $link = $ober->appendChild($dom->createElement('link',trim($each_arrow_arr)));
        $link->setAttribute('target', '');
      }
  }

}

$dom->formatOutput = true;
$dom->save($save_path);
}