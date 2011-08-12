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
</head>
<body>

<div id="header">
    <h1>S2Ethna v0.2</h1>
</div>

<div id="main">
    <h2>ようこそ、S2Ethnaの世界へ。</h2>
    <h3>document</h3>
    <ul>
    	<li><a href="{$script}?action_document_text=true">S2Ethna.txt</a></li>
    	<li><a href="{$script}?action_document_download=true">Download</a></li>
    	<li><a href="{$script}?action_document_phpdoc=true">API Documentation</a></li>
    </ul>
    <h3>example</h3>
    <ul>
    	<li><a href="{$script}?action_example=true">example</a></li>
    </ul>
    <h3>utility</h3>
    <ul>
    	<li><a href="{$script}?action_utility=true">utility</a></li>
    </ul>
    <h3>link</h3>
    <ul>
    	<li><a href="http://ethna.jp/">Ethna</a></li>
    	<li><a href="http://s2container.php5.seasar.org/">S2Container.PHP5</a></li>
    	<li><a href="http://s2dao.php5.seasar.org/">S2Dao.PHP5</a></li>
    </ul>
</div>

<div id="footer">
    Powered By <a href="http://ethna.jp">Ethna</a>-{$smarty.const.ETHNA_VERSION}.
</div>

</body>
</html>
