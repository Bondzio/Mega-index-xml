<?php
include './xmlstr_to_array.php';
require_once('./utility.php');


$globRegxml = file_get_contents("./xml/globReg.xml");
$tmpxml = file_get_contents("./tmp/tmp.xml");


$globRegxml = xmlstr_to_array($globRegxml);
$tmpxml = xmlstr_to_array($tmpxml);
array_to_file($globRegxml);
array_to_file($tmpxml);
header("Location: ./array_merge.php");