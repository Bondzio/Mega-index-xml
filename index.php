<html>
<head>
<title>File Uploading Form</title>
</head>
<body>
<h3>TXTファイルでXMLファイルを生成します</h3>
<h5>まずTXTファイルをアップロードしてください:</h5>
フテキストファイルを選んでください: <br />
<?php 
	if($_GET){
    echo "<p>Wrong file!, Please choose a txt file</p>";
	}
?>
<form action="upload.php" method="post" enctype="multipart/form-data"> 
 本の番号: <input type="text" name="bookid">
 <br>
 <input type="file" name="myFile">
 <br>
 <input type="submit" value="Upload">
</form>


</form>
</body>
</html>
