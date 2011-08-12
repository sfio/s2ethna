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
<h2>example</h2>
<h3>�ŻҷǼ���{if $config.demonstration}(�ǥ�󥹥ȥ졼�������){/if}</h3>
{if count($errors)}
<p>
  <ul>
{foreach from=$errors item=error}
    <li>{$error}</li>
{/foreach}
  </ul>
</p>
{/if}
{include file="example/bbs/_form.tpl"}
    <p>
      <font size="-1" color="#ffeedd"></font>
    </p>
    <p>
      <strong><font size="+1">[<a href="{$script}?action_example_bbs_list=true">����</a>] [<a href="{$script}?action_example=true" target="_top">��λ</a>]</font></strong>
    </p>
{include file="example/bbs/_list.tpl"}
</div>

<div id="footer">
    Powered By <a href="http://ethna.jp">Ethna</a>-{$smarty.const.ETHNA_VERSION}.
</div>

</body>
</html>
