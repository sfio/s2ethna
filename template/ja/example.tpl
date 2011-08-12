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
</head>
<body>

<div id="header">
    <h1>S2Ethna v0.2</h1>
</div>

<div id="main">
    <h2>example</h2>
    <h3>S2Container.PHP5</h3>
    <p>
    	S2Container.PHP5を利用したDIのサンプルです。
    </p>
    <ul>
    	<li>
	    	<a href="{$script}?action_example_di_action=true">ActionClassにDIする</a>
    		（<a href="{$script}?action_guide_di=true">解説</a>）
    	</li>
    	<li>
	    	<a href="{$script}?action_example_di_manager=true">AppManagerにDIする</a>
    		（<a href="{$script}?action_guide_di=true">解説</a>）
    	</li>
    </ul>
    <h3>S2Dao.PHP5</h3>
    <p>
    	S2Dao.PHP5を利用したサンプルです。
    </p>
    <ul>
    	<li>
    		<a href="{$script}?action_example_dao=true">AppManagerでDAOを利用する</a>
    		（<a href="{$script}?action_guide_dao=true">解説</a>）
    		※あらかじめデータベースの準備が必要です。先に解説をご覧ください。
    	</li>
    </ul>
    <h3>総合</h3>
    <p>
    	閲覧と投稿機能のみの電子掲示板です。おそらくS2Ethnaのすべてが詰まってます。
    </p>
    <ul>
    	<li>
	    	<a href="{$script}?action_example_bbs_list=true">電子掲示板</a>
    		（<a href="{$script}?action_guide_bbs=true">解説</a>）
    		※あらかじめデータベースの準備が必要です。先に解説をご覧ください。
    	</li>
    </ul>
    <h3>その他</h3>
    <ul>
    	<li><del>
    		S2Ethna_BaseBean
    		（<a href="{$script}?action_guide_bean=true">解説</a>）
    	</del></li>
    	<li>
    		S2Ethna_Exception
    		（<a href="{$script}?action_guide_exception=true">解説</a>）
    	</li>
    	<li><del>
	    	S2Ethna_PagerCondition
    		（<a href="{$script}?action_guide_pager=true">解説</a>）
    	</del></li>
    	<li>
	    	S2Ethna_PDODataSource
    		（<a href="{$script}?action_guide_datasource=true">解説</a>）
    	</li>
    	<li>
	    	<a href="{$script}?action_example_session=true">S2Ethna_Session</a>
    		（<a href="{$script}?action_guide_session=true">解説</a>）
    	</li>
    </ul>
	<p><a href="{$script}">戻る</a></p>
</div>

<div id="footer">
    Powered By <a href="http://ethna.jp">Ethna</a>-{$smarty.const.ETHNA_VERSION}.
</div>

</body>
</html>
