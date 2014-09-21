<?php
// include './XML2Array.php';
include './xmlstr_to_array.php';
include './utility.php';
// include './xml2arr_dom.php';


$globRegxml = file_get_contents("./globReg.xml");

$part2xml = file_get_contents("./part2.xml");


$globRegxml = xmlstr_to_array($globRegxml);
$part2xml = xmlstr_to_array($part2xml);

array_to_file($globRegxml);
array_to_file($part2xml);



// $file = './db_globReg.php';
// $text = '<?php $db_globReg ='.var_export($globRegxml, true).';';
// if(false !== fopen($file, 'w+')){
//     file_put_contents($file, $text);
// }else{
//     echo "FAIL!";
// }



// $file = './db_part2.php';
// $text = '<?php $db_globReg ='.var_export($part2xml, true).';';
// if(false !== fopen($file, 'w+')){
//     file_put_contents($file, $text);
// }else{
//     echo "FAIL!";
// }

/*

$str = <<<XML
<?xml version="1.0"?>
<group oname="Reproduktion, einfache" uname="Schema der e.R.">
    <entry>
        <name>Schema der e.R.</name>
        <book>11</book>
        <startPage>485</startPage>
        <endPage>485</endPage>
        <startLine>16</startLine>
        <endLine>24</endLine>
        <startTerm>Wir</startTerm>
        <endTerm>
            M
            <hi rend="sup">29<hi rend="frac">16/21</hi>
            </hi>β.
        </endTerm>
    </entry>
</group>

XML;

$doc = new DOMDocument();
$doc->loadXML($str);
$endTerm = $doc->getElementsByTagName('endTerm');
echo $doc->saveXML($endTerm->item(0));

// $in_endterm = new DOMDocument();
// $in_endterm->appendChild($endTerm);
// echo $in_endterm->saveXML();

*/