Mega-index-xml
==============

use php to process raw text to xml

###OCRソフトウェアによる作ったテキストのよくあるミス(手修正する必要があります)

####矢印の識別のミス
    Example:
    Abfälle (Exkremente)
    ...省略
    → Verluste
     
    解決方法：矢印のところに＃変えてください。
    Abfälle (Exkremente)
    ...省略
    *# Verluste*
    (注意：＃と単語の間にスペースあり)
    
####親索引の単語（語尾が数字の単語）とページの識別のミス   
    Example:
    _Bankakt von 1844_ 408 414 509 514 535 553
    Bankakt von 1844 は親索引の単語です。プログラムが識別できない。
    
    解決方法：<br />を語尾が数字の親索引単語の直後に入れます。
    *Bankakt von 1844*<br /> 408 414 509 514 535 553
 

####ＰＨＰファイルの実行手順
classify_process.php =>
xml_export.php =>
xml_import.php =>
array_merge.php =>
word_sort.php =>

