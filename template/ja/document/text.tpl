<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="ja">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=EUC-JP" />
  <!--��-->
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
    <h2>S2Ethna.txt</h2>
	<pre>{include file="../../lib/S2Ethna/S2Ethna.txt"}</pre>
	<p><a href="{$script}">���</a></p>
    <h2>history.txt</h2>
	<pre>{include file="../../lib/S2Ethna/history.txt"}</pre>
	<p><a href="{$script}">���</a></p>
    <h2>todo.txt</h2>
	<pre>{include file="../../lib/S2Ethna/todo.txt"}</pre>
	<p><a href="{$script}">���</a></p>
</div>

<div id="footer">
    Powered By <a href="http://ethna.jp">Ethna</a>-{$smarty.const.ETHNA_VERSION}.
</div>

</body>
</html>
