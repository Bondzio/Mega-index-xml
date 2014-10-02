<?php
include './db_array/db_volcabulary_id.php';
include './utility.php';

// pre_print_r(array_unique($volcabulary_id));

function Sortify($string)
{
    return preg_replace('~&([a-z]{1,2})(acute|cedil|circ|grave|lig|orn|ring|slash|tilde|uml);~i', '$1' . chr(255) . '$2', htmlentities($string, ENT_QUOTES, 'UTF-8'));
}

array_multisort(array_map('Sortify', $volcabulary_id), $volcabulary_id);

pre_print_r($volcabulary_id);
