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
    <h3>データベースインポートツール{if $config.demonstration}(デモンストレーション版){/if}</h3>
	<p>
        PEAR::DBを使用して、データベースのテーブル名、フィールド名を取得し、S2Dao.PHP5で使用できるBeanとDAOを生成します。
        すでにデータベースが存在するときに使用してください。
	</p>
	<p>
        Beanは、テーブル名とフィールド名のみ取得されます。外部キーなどは考慮されていません。各自で必要なアノテーションを追加してから使用してください。
        DAOは、最低限のインターフェース(CRUD)のみ用意しています。こちらも必要に応じて変更してください。
	</p>
	<p>
        実際に生成されたBeanやDAOを使用する場合は、app/daoに配置してください。
	</p>
{if count($errors)}
<h4>エラー</h4>
    <ul>
{foreach from=$errors item="error"}
		<li style="color: red;">{$error}</li>
{/foreach}
	</ul>
{/if}
{form}
<h4>DSN</h4>
{if $config.demonstration}
{form_input name="dsn" size="80" value=$config.demonstration_dsn readonly="readonly"}
{else}
{form_input name="dsn" size="80"}
{/if}
{form_submit name="action_utility_db_import_dsn" value="読み込み"}
{/form}
<p>(例：mysql://user:password@server/database)</p>

{if count($app.tables) > 0}
<h4>TABLE</h4>
<ul>
{foreach from=$app.tables item="table"}
<li>
	<a href="{$script}?action_utility_db_import_bean=true&amp;dsn={$form.dsn}&amp;table={$table}">[Download Bean]</a>
	<a href="{$script}?action_utility_db_import_dao=true&amp;dsn={$form.dsn}&amp;table={$table}">[Download DAO]</a>
	{$table}
</li>
{/foreach}
</ul>
{/if}

	<p><a href="{$script}?action_utility=true">戻る</a></p>
</div>

<div id="footer">
    Powered By <a href="http://ethna.jp">Ethna</a>-{$smarty.const.ETHNA_VERSION}.
</div>

</body>
</html>
