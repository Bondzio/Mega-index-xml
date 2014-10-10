<?php
// var_dump($_SERVER['HTTP_REFERER']);
$url = $_SERVER['HTTP_REFERER'];
$arr = explode("/", $url);
$key = $arr[count($arr)-1];

switch ($key) {
    case 'xml_export.php':
        $filePath = './tmp/tmp.xml';
        break;
    case 'xml_import.php':
    // to be update
        $filePath = './tmp/tmp.xml';
        break;
    default:
        # code...
        break;
}


    if(file_exists($filePath)) {
        $fileName = basename($filePath);
        $fileSize = filesize($filePath);

        // Output headers.
        header("Cache-Control: private");
        header("Content-Type: application/stream");
        header("Content-Length: ".$fileSize);
        header("Content-Disposition: attachment; filename=".$fileName);

        // Output file.
        readfile ($filePath);                   
        exit();
    }
    else {
        die('The provided file path is not valid.');
    }
?>