<?php
include "./utility.php";
define("UPLOAD_DIR", "./tmp/");
 
if (!empty($_FILES["myFile"])) {
    $myFile = $_FILES["myFile"];
 
    if ($myFile["error"] !== UPLOAD_ERR_OK) {
        echo "<p>An error occurred.</p>";
        exit;
    }

    if (pathinfo($myFile["name"], PATHINFO_EXTENSION)!== "txt"){
        // echo "<p>Please select a TXT file!, back to upload page...</p>";
        header("location:./index.php?type=0");
        exit;
    }
 
    // ensure a safe filename
    $name = preg_replace("/[^A-Z0-9._-]/i", "_", $myFile["name"]);
 
    // don't overwrite an existing file
    $i = 0;
    $parts = pathinfo($name);
    delFileUnderDir(UPLOAD_DIR);
    // while (file_exists(UPLOAD_DIR . $name)) {
    //     $i++;
    //     $name = $parts["filename"] . "-" . $i . "." . $parts["extension"];
    // }
 
    // preserve file from temporary directory
    $success = move_uploaded_file($myFile["tmp_name"],
        UPLOAD_DIR . "tmp.txt");
        // UPLOAD_DIR . $name);
    if (!$success) { 
        echo "<p>Unable to save file.</p>";
        exit;
    }
 
    // set proper permissions on the new file
    chmod(UPLOAD_DIR . $name, 0644);
    echo "<h2>uploaded! header to next page...<h2>";
    header('Location: ./classify_process.php');

}

