■簡単な説明

このファイル一式自体がEthnaのプロジェクト形式をとっています。

lib/S2Ethna

    S2Ethnaの本体が配置されています。
    開発時は、このディレクトリをコピーしてお使いください。

www/index.php

    PHPの実行環境に置いてアクセスすることによって、
    www版ドキュメント/サンプル/ユーティリティになります。

    ただし、lib/、もしくはinclude_pathの通っている場所に、
    ・Ethna、PEAR、Smarty（必須）
    ・S2Container.PHP5、S2Dao.PHP5（必須）
    ・PEAR::DB（ユーティリティを使用する場合）
    を用意する必要があります。

    設置の仕方によってはそのままでは動きませんので、
    環境に合わせて以下の場所を適宜書き換えてください。
    ・app/S2ethna_Controller.phpの先頭にあるinclude_path
    ・www/index.phpの先頭にあるrequire_once

■必要なライブラリ

各ライブラリは以下のサイトで入手できます。

Ethna
http://ethna.jp/

PEAR
http://pear.php.net/
http://pear.php.net/go-pear

Smarty
http://smarty.php.net/

PEAR::DB
http://pear.php.net/package/DB

S2Container.PHP5
http://s2container.php5.seasar.org/

S2Dao.PHP5
http://s2dao.php5.seasar.org/
