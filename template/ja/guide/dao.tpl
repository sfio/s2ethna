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
    <h3>S2Dao.PHP5サンプルの解説</h3>
    <ol>
	<li>
		サンプルとして、データベースにcdテーブルとshelfテーブルを用意します。<br />
		以下はMySQL用のCREATE文です。
<textarea name="code" class="sql">
{literal}
CREATE TABLE `cd` (
       `ID` INT NOT NULL
     , `TITLE` VARCHAR(100)
     , `CONTENT` VARCHAR(200)
     , PRIMARY KEY (`ID`)
)TYPE=InnoDB;

CREATE TABLE `shelf` (
       `ID` INT NOT NULL AUTO_INCREMENT
     , `CD_ID` INT NOT NULL
     , `ADD_TIME` DATETIME DEFAULT '2005-12-25 10:12:13'
     , PRIMARY KEY (`CD_ID`, `ID`)
     , INDEX (`CD_ID`)
     , CONSTRAINT `FK_shelf_1` FOREIGN KEY (`CD_ID`)
                  REFERENCES `cd` (`ID`)
)TYPE=InnoDB;

BEGIN;
INSERT INTO `cd` ( ID, CONTENT, TITLE ) VALUES ( 1, 'hello!!', 'S2Dao!!!' ) ;
INSERT INTO `shelf` ( CD_ID, ADD_TIME ) VALUES ( 1, '2005-12-18 10:12:34' ) ;
COMMIT;
{/literal}
</textarea>
	</li>
	<li>
		DAOのinterfaceを用意します。(実際にはDAOで指定するBEANも用意してください。)<br />
		例では、CdDaoというDAOに、readCdListというメソッドを用意しています。
<textarea name="code" class="php">
{literal}
interface CdDao {
	...
    const BEAN = 'CdBean';
    public function readCdList(S2Dao_PagerCondition $pager = null);
	...
}
{/literal}
</textarea>
	</li>
	<li>
		ActionClass/AppManagerにDAOのsetterを用意します。<br />
		例では、S2ethna_ExampleS2daoManagerクラスに、CdDaoというDAOのsetterを用意しています。
<textarea name="code" class="php">
{literal}
class S2ethna_ExampleS2daoManager extends Ethna_AppManager
{
	...
    private $dao;
    function setCdDao(CdDao $dao) {
        $this->dao = $dao;
    }
	...
}
{/literal}
</textarea>
	</li>
	<li>
		ActionClass/AppManagerと同名のdiconファイルで、DIを指示します。<br />
		例では、S2Dao.PHP5のaspectを適用したCdDaoというcomponentを作成するように指示しています。
<textarea name="code" class="xml">
{literal}
<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE components PUBLIC "-//SEASAR//DTD S2Container//EN" "http://www.seasar.org/dtd/components21.dtd">
<components>
	<include path="%BASE%/etc/dao.dicon"/>
	<component class="CdDao">
		<aspect>dao.interceptor</aspect>
	</component>
</components>
{/literal}
</textarea>
	</li>
	<li>
		ActionClass/AppManagerでDAOを操作します。<br />
		例では、$this->daoでCdDaoにアクセスできます。
<textarea name="code" class="php">
{literal}
class S2ethna_ExampleS2daoManager extends Ethna_AppManager
{
	...
    function getCdList()
    {
        return $this->dao->readCdList();
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
