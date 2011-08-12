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
    <h3>S2Container.PHP5サンプルの解説</h3>
    <ol>
	<li>
		ActionClass/AppManagerにsetterを用意します。<br />
		例では、S2ethna_Action_ExampleDiActionクラス(example_di_actionアクション)に、messageというpropertyのsetterを用意しています。
<textarea name="code" class="php">
{literal}
class S2ethna_Action_ExampleDiAction extends S2ethna_ActionClass
{
	...
	private $message;
	function setMessage($message) {
		$this->message = $message;
	}
	...
}
{/literal}
</textarea>
	</li>
	<li>
		ActionClass/AppManagerと同名のdiconファイルで、DIを指示します。<br />
		例では、S2ethna_Action_ExampleDiActionクラス(example_di_actionアクション)のmessageというpropertyにHello ActionClass!という文字列のDIを指示しています。
<textarea name="code" class="xml">
{literal}
<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE components PUBLIC "-//SEASAR//DTD S2Container//EN" "http://www.seasar.org/dtd/components21.dtd">
<components>
	<component class="S2ethna_Action_ExampleDiAction">
		<property name="message">"Hello ActionClass!"</property>
	</component>
</components>
{/literal}
</textarea>
	</li>
	<li>
		ActionClass/AppManagerでDIされたcomponentを操作します。<br />
		例では、$this->messageで文字列にアクセスできます。
<textarea name="code" class="php">
{literal}
class S2ethna_Action_ExampleDiAction extends S2ethna_ActionClass
{
	...
    function perform()
    {
        $this->af->setApp('message',$this->message);
        return 'example_di';
    }
	...
}
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
