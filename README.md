Mega-index-xml
==============

use php to process raw text to xml

###OCRソフトウェアによる作ったテキストのよくあるミス(手修正する必要があります)

####矢印の識別のミス
    Example:
    Abfälle (Exkremente)
    ...省略
    → Verluste
    
    Abfälle (Exkremente)
    ...省略
    *— Verluste*
    
    解決方法：矢印のところに＃変えてください。
    Abfälle (Exkremente)
    ...省略
    *# Verluste*
    (注意：＃と単語の間にスペースあり)

####ＰＨＰファイルの実行手順
classify_process.php =>
xml_export.php =>
xml_import.php =>
array_merge.php =>
word_sort.php =>
