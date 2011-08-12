<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="ja">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=EUC-JP" />
  <!--京-->
  <title>S2Ethna v0.2</title>
  <meta http-equiv="Content-Style-Type" content="text/css" />
  <meta http-equiv="Content-Script-Type" content="text/javascript" />
  <link rel="stylesheet" href="{$config.url}css/base-min.css" type="text/css" />
  <link rel="stylesheet" href="{$config.url}css/ethna.css" type="text/css" />
  <script src="js/shCore.js" type="text/javascript"></script>
  <script src="js/shBrushPhp.js" type="text/javascript"></script>
  <script src="js/shBrushJScript.js" type="text/javascript"></script>
  <script src="js/shBrushCss.js" type="text/javascript"></script>
  <script src="js/shBrushSql.js" type="text/javascript"></script>
  <script src="js/shBrushXml.js" type="text/javascript"></script>
  <link rel="stylesheet" href="css/SyntaxHighlighter.css" type="text/css" />
</head>
<body>

<div id="header">
    <h1>S2Ethna v0.2</h1>
</div>

<div id="main">
    <h2>example</h2>
    <h3>データソースクラスの解説</h3>
    <ol>
	<li>
		標準のデータソースクラスはS2Container_PDODataSourceです。<br />
		このS2Container_PDODataSourceは、インスタンスごとにPDOオブジェクトを生成します。<br />
		つまり、ActionClass/AppManagerごとに違うPDOオブジェクトが生成されます。<br />
		読み込み(SELECT)だけなら問題は無いのですが、書き込み(INSERT/UPDATE/DELETE)が関わってくると、
		複数のActionClass/AppManagerを横断しながらトランザクションをかけたりすることが出来ず、タイムアウトが起きたりします。
<textarea name="code" class="xml">
{literal}
<?xml version="1.0" encoding="utf-8"?>
<!DOCTYPE components PUBLIC "-//SEASAR//DTD S2Container//EN" "http://www.seasar.org/dtd/components.dtd">
<components namespace="pdo">

    <component name="dataSource" class="S2Container_PDODataSource">
        ...
    </component>

</components>
{/literal}
</textarea>
	</li>
	<li>
		そこで、データソースクラスをS2Ethna_PDODataSourceに変更すると、DSNごとにPDOオブジェクトを生成するようになります。<br />
		つまり、すべてのActionClass/AppManagerにおいて、共通のPDOオブジェクトを利用できます。<br />
		複数のActionClass/AppManagerを横断してトランザクションをかけたりすることが出来るようになります。
<textarea name="code" class="xml">
{literal}
<?xml version="1.0" encoding="utf-8"?>
<!DOCTYPE components PUBLIC "-//SEASAR//DTD S2Container//EN" "http://www.seasar.org/dtd/components.dtd">
<components namespace="pdo">

    <component name="dataSource" class="S2Ethna_PDODataSource">
        ...
    </component>

</components>
{/literal}
</textarea>
	</li>
    </ol>
	<p><a href="{$script}?action_example=true">戻る</a></p>
</div>

<div id="footer">
    Powered By <a href="http://ethna.jp">Ethna</a>-{$smarty.const.ETHNA_VERSION}.
</div>

<script class="javascript">{literal}<!--
window.onload = function () {
	dp.SyntaxHighlighter.ClipboardSwf = 'js/clipboard.swf';
	dp.SyntaxHighlighter.HighlightAll('code');
}
-->{/literal}</script>
</body>
</html>
