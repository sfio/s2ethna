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
    <h3>�㳰���饹�β���</h3>
    <ol>
	<li>
	    S2Ethna���㳰���饹���ϡ�Ethna_Error���åԥ󥰤������饹�ˤʤäƤ��ޤ���<br />
		S2Ethna_Exception�ϡ���¸��Ethna_Error���֥������Ȥ򸵤��㳰���������ޤ���<br />
		��̤�Ethna_Error���ä����㳰���ꤲ���硢S2Ethna_Exception����Ѥ��Ƥ���������
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
		S2Ethna_ErrorException��S2Ethna_WarningException��S2Ethna_NoticeException�ϡ�
		���줾��Ethna::raiseNotice()��Ethna::raiseWarning()��Ethna::raiseError()�����������㳰���饹�Ǥ���<br />
		�㳰���������ˡ�������Ethna_Error���֥������Ȥ��������ޤ���
<textarea name="code" class="php">
{literal}
class S2ethna_ExampleExceptionManager extends Ethna_AppManager
{
	...
	public function example()
	{
		...
		if ($count < 1) {
			throw new S2Ethna_NoticeException('��å�����', E_ERRORCODE);
		}
		...
	}
	...
}
{/literal}
</textarea>
	</li>
	<li>
		�㳰�ν����ϡ�S2Ethna_Exception��S2Ethna_ErrorException��S2Ethna_WarningException��S2Ethna_NoticeException����
		���٤�S2Ethna_Exception�����������Ƥ��ޤ��Τǡ�S2Ethna_Exception��catch���������OK�Ǥ���<br />
		�����Υ����ɤΤ褦�ˡ�AppManager����ϡ����ץꥱ��������Ϣ���㳰�Ȥ���S2Ethna_Exception�ϡ�
		DB��Ϣ���㳰�Ȥ���S2Container_S2RuntimeException�Ϥ�throw�����Ȥ������ͤ򤪴��ᤷ�ޤ���
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
            // ���顼
            $this->backend->getLogger()->log(LOG_DEBUG, 'Caught exception \'' . get_class($e) . '\' with message \'' . $e->getMessage() . '\' in ' . __METHOD__);
            $this->ae->addObject(null, $e->getObject());
        } catch (S2Container_S2RuntimeException $e) {
            // ��������
            $this->backend->getLogger()->log(LOG_DEBUG, 'Caught exception \'' . get_class($e) . '\' with message \'' . $e->getMessage() . '\' in ' . __METHOD__);
            $this->ae->add(null, '�����˼��Ԥ��ޤ�����');
        }
		...
    }
	...
}
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
