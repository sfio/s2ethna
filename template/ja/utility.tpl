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
    <h2>utility</h2>
    <h3>S2Dao.PHP5用ツール</h3>
    <p>
		既存のデータベースから、S2Dao.PHP5で使用できるBeanとDAOを生成します。
    </p>
    <ul>
    	<li>
    		<a href="{$script}?action_utility_db_import_form=true">データベースインポートツール</a>
    		※要Ethna 2.3.2以降
    	</li>
    </ul>
	<p><a href="{$script}">戻る</a></p>
</div>

<div id="footer">
    Powered By <a href="http://ethna.jp">Ethna</a>-{$smarty.const.ETHNA_VERSION}.
</div>

</body>
</html>
