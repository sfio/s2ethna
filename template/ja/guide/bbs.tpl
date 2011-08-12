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
    <h3>�ŻҷǼ��Ĥβ���</h3>
    <ol>
	<li>
		�ǡ����١�����bbs�ơ��֥���Ѱդ��ޤ���<br />
		�ʲ���MySQL�Ѥ�CREATEʸ�Ǥ���
<textarea name="code" class="sql">
{literal}
CREATE TABLE `bbs` (
       `id` INT NOT NULL AUTO_INCREMENT
     , `date` TIMESTAMP
     , `name` VARCHAR(255)
     , `email` VARCHAR(255)
     , `subject` VARCHAR(255)
     , `body` TEXT
     , `password` VARCHAR(8)
     , `host` VARCHAR(40)
     , PRIMARY KEY (`id`)
);
{/literal}
</textarea>
	</li>
	<li>
		DAO��interface���Ѱդ��ޤ���(�ºݤˤ�DAO�ǻ��ꤹ��BEAN���Ѱդ��Ƥ���������)<br />
		��Ǥϡ�BbsDao�Ȥ���DAO�ˡ����������(INSERT)����createBbs�������ΰ��������(SELECT)����readBbsList�Ȥ����᥽�åɤ��Ѱդ��Ƥ��ޤ���
<textarea name="code" class="php">
{literal}
interface BbsDao {
	...
    const BEAN = 'BbsBean';
    public function createBbs(BbsBean $bbs);
    public function readBbsList(S2Dao_PagerCondition $pager = null);
    const readBbsList_QUERY = 'ORDER BY date DESC';
	...
}
{/literal}
</textarea>
	</li>
	<li>
		�ȥ�󥶥�������Ԥ����ᡢinterface���Ѱդ���AppManager�˼��������ޤ���<br />
		��Ǥϡ�INSERT��Ԥ�createArticle�᥽�åɤ����ꤷ�Ƥ��ޤ���SELECT��Ԥ������Υ᥽�åɤ�ɬ�פ���ޤ���
<textarea name="code" class="php">
{literal}
interface IS2ethna_ExampleBbsManager
{
    public function createArticle($name, $email, $subject, $body);
}

class S2ethna_ExampleBbsManager
    extends Ethna_AppManager implements IS2ethna_ExampleBbsManager
{
	...
}
{/literal}
</textarea>
	</li>
	<li>
		AppManager��DAO��setter���Ѱդ��ޤ���<br />
		��Ǥϡ�S2ethna_ExampleBbsManager���饹�ˡ�BbsDao�Ȥ���DAO��setter���Ѱդ��Ƥ��ޤ���
<textarea name="code" class="php">
{literal}
class S2ethna_ExampleBbsManager
    extends Ethna_AppManager implements IS2ethna_ExampleBbsManager
{
	...
    protected $BbsDao;
    public function setBbsDao(BbsDao $BbsDao)
    {
        $this->BbsDao = $BbsDao;
    }
	...
}
{/literal}
</textarea>
	</li>
	<li>
		AppManager��Ʊ̾��dicon�ե�����ǡ�DI��ؼ����ޤ���<br />
		��Ǥϡ�S2ethna_ExampleBbsManager�˥ȥ�󥶥�������aspect��BbsDao��S2Dao.PHP5��aspect��Ŭ�Ѥ��Ƥ��ޤ���
<textarea name="code" class="xml">
{literal}
<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE components PUBLIC "-//SEASAR//DTD S2Container//EN" "http://www.seasar.org/dtd/components21.dtd">
<components>
	<include path="%BASE%/etc/dao.dicon"/>
    <component class="S2ethna_ExampleBbsManager">
	    <aspect>pdo.requiredTx</aspect>
    </component>
	<component class="BbsDao">
		<aspect>dao.interceptor</aspect>
	</component>
</components>
{/literal}
</textarea>
	</li>
	<li>
		�����ΰ��������(SELECT)����readBbsList<br />
		<ul>
			<li>
				AppManager¦�Ǥϡ�$this->BbsDao��DAO�˥��������Ǥ��ޤ���<br />
				SELECTʸ��ȯ�Ԥ���DAO�ϡ�����ͤη���������Ĥ��Ƥ���������<br />
				�᥽�å�̾�κǸ��List���դ���ȡ�����ͤ�S2Dao_ArrayList���ˤʤ�ޤ����ü�ʸ������դ��ʤ����BEAN��ñ�Τ���äƤ��ޤ���<br />
				SELECTʸ�η�̡��ͤ�̵������S2Dao_ArrayList����count()==0��BEAN����is_null()==true�ˤʤ�ޤ�������դ���������
<textarea name="code" class="php">
{literal}
class S2ethna_ExampleBbsManager
    extends Ethna_AppManager implements IS2ethna_ExampleBbsManager
{
	...
    public function getArticleList($pager)
    {
        return $this->BbsDao->readBbsList($pager);
    }
	...
}
{/literal}
</textarea>
			</li>
			<li>
				ActionClass/View¦�ǥڡ������������Ƥ���������<br />
				���Τޤޥ�����󥰥��󥸥���Ϥ����Ȥ��Ǥ��ޤ���<br />
				BEAN��BEAN�Υꥹ�Ȥ⤽�Τޤޥ�����󥰥��󥸥���Ϥ����Ȥ��Ǥ��ޤ���
<textarea name="code" class="php">
{literal}
class S2ethna_View_ExampleBbsList extends S2ethna_ViewClass
{
    function preforward()
    {
        ...
        $pager = S2Ethna_PagerCondition::create($page, 10);
        $result = $this->backend->getManager('ExampleBbs')->getArticleList($pager);
        $this->af->setApp('articles', $result);
        $this->af->setApp('pager', $pager);
        ...
    }
}
{/literal}
</textarea>
			</li>
		</ul>
	</li>
	<li>
		���������(INSERT)����createBbs<br />
		<ul>
			<li>
				AppManager¦�Ǥ�BEAN���������createBbs��ƤӽФ��ޤ���<br />
				���Υ᥽�åɤϥȥ�󥶥�����󤬤����äƤ���Τǡ�return�����(����ͤˤ�����餺)comit����ޤ���rollback�������Ȥ��ϡ��ΰդ��㳰�����Ф��Ƥ���������<br />
				INSERT/DELETE/UPDATEʸ��ȯ�Ԥ���DAO������ͤϹ�������ʤΤǡ���������ʤ���硢�������ԤȤ����㳰�����Ф��٤��Ǥ��礦��<br/>
				S2Container.PHP5�λ��ͤˤ�ꡢ$this->createArticle�ȸƤ֤ȥȥ�󥶥�����󤬤�����ޤ��󡣳�������Ƥ�Ǥ���������<br />
<textarea name="code" class="php">
{literal}
class S2ethna_ExampleBbsManager
    extends Ethna_AppManager implements IS2ethna_ExampleBbsManager
{
	...
    public function createArticle($name, $email, $subject, $body)
    {
        $bbsBean = new BbsBean();
        $bbsBean->setName($name);
        $bbsBean->setEmail($email);
        $bbsBean->setSubject($subject);
        $bbsBean->setBody($body);
        $bbsBean->setHost($_SERVER['REMOTE_ADDR']);
        $rows = $this->BbsDao->createBbs($bbsBean);
        if ($rows != 1) {
            throw new S2Container_S2RuntimeException(get_class($this), $rows);
        }
    }
	...
}
{/literal}
</textarea>
			</li>
			<li>
				UPDATEʸ��ȯ�Ԥ���DAO�������ü���㳰��ȯ�������ǽ��������ޤ���<br />
				�������ȹ�����Υ쥳���ɤ��ѹ���̵����硢S2Dao_NotSingleRowUpdatedRuntimeException��ȯ�����ޤ���<br />
				�ѹ���̵���Ƥ�����ʤ����ϡ��㳰����ͤ������̤ꤹ��褦�ˤ��Ƥ���������
<textarea name="code" class="php">
{literal}
class S2ethna_ExampleBbsManager
    extends Ethna_AppManager implements IS2ethna_ExampleBbsManager
{
	...
	// ���Υ᥽�åɤϥ���ץ�Ȥ��Ƶ��Ҥ�����ΤǼ�������Ƥ��ޤ���
    public function updateArticle($bbsBean, $name, $email, $subject, $body)
    {
        $bbsBean->setName($name);
        $bbsBean->setEmail($email);
        $bbsBean->setSubject($subject);
        $bbsBean->setBody($body);
        $bbsBean->setHost($_SERVER['REMOTE_ADDR']);
		try {
	        $rows = $this->BbsDao->updateBbs($bbsBean);
		} catch (S2Dao_NotSingleRowUpdatedRuntimeException $e) {
			// �ѹ�̵�����ɵ��ˤ��ʤ�
			$rows = 1;
		}
        if ($rows != 1) {
            throw new S2Container_S2RuntimeException(get_class($this), $rows);
        }
    }
	...
}
{/literal}
</textarea>
			</li>
			<li>
				ActionClass/View¦�Ǥ��㳰����ͤ���褦�ˤ��ޤ���<br />
				S2Ethna_Exception(���ץꥱ��������Ϣ���㳰)��S2Container_S2RuntimeException(DB��Ϣ���㳰)��ʬ���Ƥ��ޤ���
<textarea name="code" class="php">
{literal}
class S2ethna_Action_ExampleBbsWriteDo extends S2ethna_ActionClass
{
    function perform()
    {
		...
        try {
            $result = $this->backend->getManager('ExampleBbs')->createArticle($name, $email, $subject, $body);
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
}
{/literal}
</textarea>
			</li>
			<li>
				�ǥե���Ȥ�S2Ethna�Ǥϡ�DAO��DI����ActionClass/AppManager�Υ��󥹥��󥹤��Ȥ�PDO���֥������Ȥ���������ޤ���<br />
				���ξ��֤�ʣ����ActionClass/AppManager��٤���DAO�Ƥ֤ȡ��̡��Υȥ�󥶥������ˤʤäƤ��ޤ��������ॢ���Ȥ򵯤����Ƥ��ޤ����Ȥ�����ޤ���<br />
				ʣ����AppManager��٤��ǥȥ�󥶥������򤫤��������ϡ�<a href="{$script}?action_guide_datasource=true">S2Ethna_PDODataSource�β���</a>��������������
			</li>
		<ul>
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
