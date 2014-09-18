Mega-index-xml
==============

use php to process raw text to xml

OCRソフトウェアによる作ったテキストのよくあるミス(手修正する必要があります)

###矢印の識別のミス
　　例：
　　
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
