<?php
include './db_array/db_volcabulary_id.php';
include './utility.php';

//A0001

$alphabet = $volcabulary_id[1][0];
for ($i=0; $i < count($volcabulary_id); $i++) { 
	if($volcabulary_id[$i][0]!== $alphabet){
		$alphabet = $volcabulary_id[$i][0];
		pre_print_r($volcabulary_id[$i]);
	}
}

//note https://gist.github.com/panfeng/15cd66901fbc2521dba3