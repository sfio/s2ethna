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
    <h3>S2Dao.PHP5��Ȥä����å����������饹�β���</h3>
    <ol>
	<li>
		�ǡ����١�����session�ơ��֥���Ѱդ��ޤ���<br />
		�ʲ���MySQL�Ѥ�CREATEʸ�Ǥ���
<textarea name="code" class="sql">
{literal}
CREATE TABLE `session` (
       `id` VARCHAR(255) NOT NULL
     , `sess_data` TEXT
     , `remote_addr` VARCHAR(255)
     , `timestamp` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
     , PRIMARY KEY (`id`)
);
{/literal}
</textarea>
	</li>
	<li>
		Controller��session���饹���ѹ����ޤ���
<textarea name="code" class="php">
{literal}
class S2ethna_Controller extends Ethna_Controller
{
	...
    var $class = array(
		...
        'session'       => 'S2Ethna_SessionProxy',       // S2Ethna�б�
		...
    );
	...
}
{/literal}
</textarea>
	</li>
    <li>
    	�̾Ethna�Ǥ�tmp�۲��Υե�����˥��å����������¸���ޤ�����
    	S2Ethna_Session����Ѥ��뤳�Ȥˤ�äƥǡ����١����˥��å���������Ǽ����褦�ˤʤ�ޤ���
    	ʣ���Υ����Ф��饻�å�������򻲾Ȥ��뤳�Ȥ���ǽ�ˤʤꡢñ������ʬ������ǽ�ˤʤ�ޤ���
	</ol>
	<p><a href="{$script}?action_example=true">���</a></p>
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
