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
    <h3>電子掲示板の解説</h3>
    <ol>
	<li>
		データベースにbbsテーブルを用意します。<br />
		以下はMySQL用のCREATE文です。
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
		DAOのinterfaceを用意します。(実際にはDAOで指定するBEANも用意してください。)<br />
		例では、BbsDaoというDAOに、記事を作成(INSERT)するcreateBbs、記事の一覧を取得(SELECT)するreadBbsListというメソッドを用意しています。
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
		トランザクションを行うため、interfaceを用意し、AppManagerに実装させます。<br />
		例では、INSERTを行うcreateArticleメソッドを設定しています。SELECTを行うだけのメソッドは必要ありません。
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
		AppManagerにDAOのsetterを用意します。<br />
		例では、S2ethna_ExampleBbsManagerクラスに、BbsDaoというDAOのsetterを用意しています。
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
		AppManagerと同名のdiconファイルで、DIを指示します。<br />
		例では、S2ethna_ExampleBbsManagerにトランザクションのaspectを、BbsDaoにS2Dao.PHP5のaspectを適用しています。
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
		記事の一覧を取得(SELECT)するreadBbsList<br />
		<ul>
			<li>
				AppManager側では、$this->BbsDaoでDAOにアクセスできます。<br />
				SELECT文を発行するDAOは、戻り値の型だけ気をつけてください。<br />
				メソッド名の最後にListと付けると、戻り値はS2Dao_ArrayList型になります。特殊な語尾を付けなければBEANが単体で戻ってきます。<br />
				SELECT文の結果、値が無い場合のS2Dao_ArrayList型はcount()==0、BEAN型はis_null()==trueになります。ご注意ください。
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
				ActionClass/View側でページャを作成してください。<br />
				そのままレンダリングエンジンに渡すことができます。<br />
				BEANやBEANのリストもそのままレンダリングエンジンに渡すことができます。
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
		記事を作成(INSERT)するcreateBbs<br />
		<ul>
			<li>
				AppManager側ではBEANを作成してcreateBbsを呼び出します。<br />
				このメソッドはトランザクションがかかっているので、returnすると(戻り値にかかわらず)comitされます。rollbackしたいときは、故意に例外を飛ばしてください。<br />
				INSERT/DELETE/UPDATE文を発行するDAOの戻り値は更新件数なので、件数が合わない場合、更新失敗として例外を飛ばすべきでしょう。<br/>
				S2Container.PHP5の仕様により、$this->createArticleと呼ぶとトランザクションがかかりません。外部から呼んでください。<br />
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
				UPDATE文を発行するDAOだけ、特殊な例外が発生する可能性があります。<br />
				更新前と更新後のレコードに変更が無い場合、S2Dao_NotSingleRowUpdatedRuntimeExceptionが発生します。<br />
				変更が無くても問題ない場合は、例外を捕獲して素通りするようにしてください。
<textarea name="code" class="php">
{literal}
class S2ethna_ExampleBbsManager
    extends Ethna_AppManager implements IS2ethna_ExampleBbsManager
{
	...
	// このメソッドはサンプルとして記述したもので実装されていません。
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
			// 変更無いけど気にしない
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
				ActionClass/View側では例外を捕獲するようにします。<br />
				S2Ethna_Exception(アプリケーション関連の例外)とS2Container_S2RuntimeException(DB関連の例外)を分けています。
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
}
{/literal}
</textarea>
			</li>
			<li>
				デフォルトのS2Ethnaでは、DAOをDIしたActionClass/AppManagerのインスタンスごとにPDOオブジェクトが生成されます。<br />
				この状態で複数のActionClass/AppManagerを跨いでDAO呼ぶと、別々のトランザクションになってしまい、タイムアウトを起こしてしまうことがあります。<br />
				複数のAppManagerを跨いでトランザクションをかけたい場合は、<a href="{$script}?action_guide_datasource=true">S2Ethna_PDODataSourceの解説</a>をご覧ください。
			</li>
		<ul>
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
