Mega-index-xml
==============

use php to process raw text to xml

####OCRソフトウェアによる作ったテキストのよくあるミス(手修正する必要があります)

#####矢印の識別のミス

    Example:
    Abfälle (Exkremente)
    ...省略
    → Verluste
     
    解決方法：矢印のところに＃変えてください。
    Abfälle (Exkremente)
    ...省略
    # Verluste
    (注意：＃と単語の間にスペースあり)
    
#####親索引/子索引の単語（語尾が数字の単語）とページの識別のミス   

    Example:
    Bankakt von 1844 408 414 509 514 535 553
    Bankakt von 1844 は親索引の単語です。プログラムが識別できない。
    
    解決方法：<br />を語尾が数字の親索引単語の直後に入れます。
    Bankakt von 1844<br /> 408 414 509 514 535 553
    （子索引にもこの問題があり、一緒に修正しましょう）
 　
####ＰＨＰファイルの説明
        clean_process.php: OCRソフトウェアによる得られたテキストファイルのミスを検証する
        index.php: upload.phpと一緒に使って、テキストファイルをサーバーにアップロードする
        upload.php: アップロードされたファイルはフォルダtmpに保存される。
        classify_process.php:　テキストの文章の構造を解析する。
            親索引、親索引のページ、子索引、子索引ページ、ハイフン単語を識別して、
            PHPのArrayのデータ構造としてdb_array.phpのファイルをアウトプットする。
            ファイルの読み書きが頻繁になるから、
            そしてソースコードの汎用性を考えて、SQLを使わない。

        xml_export.php:　db_array.phpのデータを読み、XMLファイルをアウトプットする。

        insert_id.php: 各親索引に頭文字を含むIDを与える。

        fetch_duplicate.php: 既存の親索引と新しい親索引の重複した部分を抽出する。

        get_upduplicate_arr.php: 既存の親索引と新しい親索引の重複していない部分を抽出する。

        duplicate_to_arr.php: 既存の親索引と新しい親索引の重複した部分を抽出するのをarrayとして保存する。

        undupicate_to_arr.php:既存の親索引と新しい親索引の重複していない部分を抽出するのをarrayとして保存する。

        merge_dupli_undupli.php:

        export_glob_XML.php:

        xml_import.php:　globReg.XMLファイルを読み、データ構造を解析して、
            PHPのArrayのデータをアウトプットする。

        array_merge.php:　親索引の単語リストを確定する。
            重複した単語リストと重複なしの単語リストを生成する。

        word_sort.php:　

        xmlstr_to_array:　主にXMLファイルをarrayに転換する関数。

        utility.php:　各種便利な関数

        globRegVolcabulary.php: Megaのウェブサイトに現れた親索引と
            globReg.xmlから抽出した親索引の比較する。

        index.php: テキストファイルをアップロードするためのHTMLファイル

        upload.php: テキストファイルをアップロードして、
            classify_processの手順に入る。
            
        download.php: 指定のページからダウンロードするファイルの識別する



####ＰＨＰファイルの実行手順
	index.php =>
    classify_process.php =>
	xml_export.php =>
    insert_id.php =>
    fetch_duplicate.php =>
    get_unduplicate_arr.php =>
    duplicate_to_arr.php =>
    unduplicate_to_arr.php =>
    merge_dupli_undupli.php => 
    export_glob_XML.php =>
        The generated xml file named "newGlobReg.xml" is saved on folder "xml"



#### globReg.xmlファイルとindex.txtから生成したｘｍｌの合成について
        両方のファイルともに出現した親索引単語、duplicate_word.phpの単語には、
        子索引をチェクする必要があります。
        - 子索引が同じ部分があれば、
            同じ部分を一回マイナスして合成する。
            - oname id はすでにduplicate_word.phpには定義されている。
            - uname id はonameのunameを全部ソートして、親索引のＩＤの後ろに番号を付ける。
                - merge and sort page numbers of uname


        db_o_u_idの中は重複しない親索引のarrayである。
        

        - なければ、直接合成すればいい。
            子索引のソートの問題もあり。
            entry タグの問題もあり。

        両方のファイルともい出現した親索引単語ではないidentical_wordの場合では、
        単語の抽出して、直接合成すればいい、
        子索引のソートの問題なし。

        親索引の単語も子索引の単語両方とも
        db_volcabulary_id.phpの単語リストに準じてソートする。
