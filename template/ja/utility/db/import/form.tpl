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
	<h2>utility</h2>
    <h3>�ǡ����١�������ݡ��ȥġ���{if $config.demonstration}(�ǥ�󥹥ȥ졼�������){/if}</h3>
	<p>
        PEAR::DB����Ѥ��ơ��ǡ����١����Υơ��֥�̾���ե������̾���������S2Dao.PHP5�ǻ��ѤǤ���Bean��DAO���������ޤ���
        ���Ǥ˥ǡ����١�����¸�ߤ���Ȥ��˻��Ѥ��Ƥ���������
	</p>
	<p>
        Bean�ϡ��ơ��֥�̾�ȥե������̾�Τ߼�������ޤ������������ʤɤϹ�θ����Ƥ��ޤ��󡣳Ƽ���ɬ�פʥ��Υơ��������ɲä��Ƥ�����Ѥ��Ƥ���������
        DAO�ϡ�����¤Υ��󥿡��ե�����(CRUD)�Τ��Ѱդ��Ƥ��ޤ����������ɬ�פ˱������ѹ����Ƥ���������
	</p>
	<p>
        �ºݤ��������줿Bean��DAO����Ѥ�����ϡ�app/dao�����֤��Ƥ���������
	</p>
{if count($errors)}
<h4>���顼</h4>
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
{form_submit name="action_utility_db_import_dsn" value="�ɤ߹���"}
{/form}
<p>(�㡧mysql://user:password@server/database)</p>

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

	<p><a href="{$script}?action_utility=true">���</a></p>
</div>

<div id="footer">
    Powered By <a href="http://ethna.jp">Ethna</a>-{$smarty.const.ETHNA_VERSION}.
</div>

</body>
</html>
