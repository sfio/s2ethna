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
    <h3>例外クラスの解説</h3>
    <ol>
	<li>
	    S2Ethnaの例外クラス群は、Ethna_Errorをラッピングしたクラスになっています。<br />
		S2Ethna_Exceptionは、既存のEthna_Errorオブジェクトを元に例外を生成します。<br />
		結果がEthna_Errorだったら例外を投げる場合、S2Ethna_Exceptionを使用してください。
<textarea name="code" class="php">
{literal}
class S2ethna_ExampleExceptionManager extends Ethna_AppManager
{
	...
	public function example()
	{
		...
		$result = $this->getResult();
		if (Ethna::isError($result)) {
			throw new S2Ethna_Exception($result);
		}
		...
	}
	...
}
{/literal}
</textarea>
		S2Ethna_ErrorException、S2Ethna_WarningException、S2Ethna_NoticeExceptionは、
		それぞれEthna::raiseNotice()、Ethna::raiseWarning()、Ethna::raiseError()に相当する例外クラスです。<br />
		例外の生成時に、内部でEthna_Errorオブジェクトも生成します。
<textarea name="code" class="php">
{literal}
class S2ethna_ExampleExceptionManager extends Ethna_AppManager
{
	...
	public function example()
	{
		...
		if ($count < 1) {
			throw new S2Ethna_NoticeException('メッセージ', E_ERRORCODE);
		}
		...
	}
	...
}
{/literal}
</textarea>
	</li>
	<li>
		例外の処理は、S2Ethna_Exception、S2Ethna_ErrorException、S2Ethna_WarningException、S2Ethna_NoticeExceptionが、
		すべてS2Ethna_Exceptionから派生していますので、S2Ethna_ExceptionをcatchするだけでOKです。<br />
		下記のコードのように、AppManagerからは、アプリケーション関連の例外としてS2Ethna_Exception系、
		DB関連の例外としてS2Container_S2RuntimeException系がthrowされるという仕様をお勧めします。
<textarea name="code" class="php">
{literal}
class S2ethna_Action_ExampleException extends S2ethna_ActionClass
{
	...
    function perform()
    {
		...
        try {
            $result = $this->backend->getManager('ExampleException')->example();
        } catch (S2Ethna_Exception $e) {
            // エラー
            $this->backend->getLogger()->log(LOG_DEBUG, 'Caught exception \'' . get_class($e) . '\' with message \'' . $e->getMessage() . '\' in ' . __METHOD__);
            $this->ae->addObject(null, $e->getObject());
        } catch (S2Container_S2RuntimeException $e) {
            // 更新失敗
            $this->backend->getLogger()->log(LOG_DEBUG, 'Caught exception \'' . get_class($e) . '\' with message \'' . $e->getMessage() . '\' in ' . __METHOD__);
            $this->ae->add(null, '更新に失敗しました。');
        }
		...
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
