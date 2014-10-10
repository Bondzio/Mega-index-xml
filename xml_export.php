<?php
include './db_array/db_array.php';
require_once("./utility.php");



pre_print_r("<h3><a href='./download.php'>生成したXMLファイルをダウンロードします</a></h3>");
pre_print_r("<h3><a href='./xml_import.php'>生成したXMLファイルとglobReg.xmlと合成します</a></h3>");

array_to_xml($db, './tmp/tmp.xml');

