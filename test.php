<?php
include './utility.php';
// $ar1 = array("color" => array("favorite" => "red"), 5);
// $ar2 = array(10, "color" => array("favorite" => "green", "blue"));
// $result = array_merge_recursive($ar1, $ar2);
// pre_print_r($result);


$a = array (
      'oname' => 'Ägypten',
      'unterBegriff' => 
      array (
        'uname' => 'Ägypten',
        'group' => 
        array (
          'entry' => 
          array (
            'name' => 'Ägypten',
            'book' => '15',
            'startPage' => '622',
            'endPage' => 
            array (
            ),
            'startLine' => 
            array (
            ),
            'endLine' => 
            array (
            ),
            'startTerm' => 
            array (
            ),
            'endTerm' => 
            array (
            ),
          ),
          '@attributes' => 
          array (
            'oname' => 'Ägypten',
            'uname' => 'Ägypten',
          ),
        ),
      ),
      'link' => 
      array (
        '@content' => 'Suezkanal',
        '@attributes' => 
        array (
          'target' => '',
        ),
      ),
    );

     $b = 
    array (
      'oname' => 'Ägypten',
      'unterBegriff' => 
      array (
        'uname' => 'Ägypten',
        'group' => 
        array (
          'entry' => 
          array (
            'name' => 'Ägypten',
            'book' => '11',
            'startPage' => '64',
            'endPage' => 
            array (
            ),
            'startLine' => '19',
            'endLine' => 
            array (
            ),
            'startTerm' => 'Aegzpten',
            'endTerm' => 
            array (
            ),
          ),
          '@attributes' => 
          array (
            'oname' => 'Ägypten',
            'uname' => 'Ägypten',
          ),
        ),
        '@attributes' => 
        array (
          'id' => 'A0010_001',
        ),
      ),
      '@attributes' => 
      array (
        'id' => 'A0010',
      ),
    );


    $c = array_merge_recursive($a,$b);
    pre_print_r($c);


    if($c['oname'][0] == $c['oname'][1]){
    	echo "yes";
    }else{
    	echo 'No';
    }


    