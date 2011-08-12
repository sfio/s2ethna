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
    <h3>�ǡ������������饹�β���</h3>
    <ol>
	<li>
		ɸ��Υǡ������������饹��S2Container_PDODataSource�Ǥ���<br />
		����S2Container_PDODataSource�ϡ����󥹥��󥹤��Ȥ�PDO���֥������Ȥ��������ޤ���<br />
		�ĤޤꡢActionClass/AppManager���Ȥ˰㤦PDO���֥������Ȥ���������ޤ���<br />
		�ɤ߹���(SELECT)�����ʤ������̵���ΤǤ������񤭹���(INSERT/UPDATE/DELETE)���ؤ�äƤ���ȡ�
		ʣ����ActionClass/AppManager���Ǥ��ʤ���ȥ�󥶥������򤫤����ꤹ�뤳�Ȥ����褺�������ॢ���Ȥ��������ꤷ�ޤ���
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
		�����ǡ��ǡ������������饹��S2Ethna_PDODataSource���ѹ�����ȡ�DSN���Ȥ�PDO���֥������Ȥ���������褦�ˤʤ�ޤ���<br />
		�Ĥޤꡢ���٤Ƥ�ActionClass/AppManager�ˤ����ơ����̤�PDO���֥������Ȥ����ѤǤ��ޤ���<br />
		ʣ����ActionClass/AppManager���Ǥ��ƥȥ�󥶥������򤫤����ꤹ�뤳�Ȥ������褦�ˤʤ�ޤ���
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
