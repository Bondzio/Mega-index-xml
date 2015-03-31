<?php
session_start();
include './db_array/db_array.php';
require_once("./utility.php");

pre_print_r("<h3><a href='./download.php'>生成したXMLファイルをダウンロードします</a></h3>");
pre_print_r("<h3><a href='./xml_import.php'>生成したXMLファイルとglobReg.xmlと合成します</a></h3>");

$bookid = $_SESSION['bookid'];
array_to_xml($bookid, $db, './tmp/tmp.xml');
