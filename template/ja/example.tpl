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
    <h3>S2Container.PHP5</h3>
    <p>
    	S2Container.PHP5�����Ѥ���DI�Υ���ץ�Ǥ���
    </p>
    <ul>
    	<li>
	    	<a href="{$script}?action_example_di_action=true">ActionClass��DI����</a>
    		��<a href="{$script}?action_guide_di=true">����</a>��
    	</li>
    	<li>
	    	<a href="{$script}?action_example_di_manager=true">AppManager��DI����</a>
    		��<a href="{$script}?action_guide_di=true">����</a>��
    	</li>
    </ul>
    <h3>S2Dao.PHP5</h3>
    <p>
    	S2Dao.PHP5�����Ѥ�������ץ�Ǥ���
    </p>
    <ul>
    	<li>
    		<a href="{$script}?action_example_dao=true">AppManager��DAO�����Ѥ���</a>
    		��<a href="{$script}?action_guide_dao=true">����</a>��
    		�����餫����ǡ����١����ν�����ɬ�פǤ�����˲����������������
    	</li>
    </ul>
    <h3>���</h3>
    <p>
    	��������Ƶ�ǽ�Τߤ��ŻҷǼ��ĤǤ��������餯S2Ethna�Τ��٤Ƥ��ͤޤäƤޤ���
    </p>
    <ul>
    	<li>
	    	<a href="{$script}?action_example_bbs_list=true">�ŻҷǼ���</a>
    		��<a href="{$script}?action_guide_bbs=true">����</a>��
    		�����餫����ǡ����١����ν�����ɬ�פǤ�����˲����������������
    	</li>
    </ul>
    <h3>����¾</h3>
    <ul>
    	<li><del>
    		S2Ethna_BaseBean
    		��<a href="{$script}?action_guide_bean=true">����</a>��
    	</del></li>
    	<li>
    		S2Ethna_Exception
    		��<a href="{$script}?action_guide_exception=true">����</a>��
    	</li>
    	<li><del>
	    	S2Ethna_PagerCondition
    		��<a href="{$script}?action_guide_pager=true">����</a>��
    	</del></li>
    	<li>
	    	S2Ethna_PDODataSource
    		��<a href="{$script}?action_guide_datasource=true">����</a>��
    	</li>
    	<li>
	    	<a href="{$script}?action_example_session=true">S2Ethna_Session</a>
    		��<a href="{$script}?action_guide_session=true">����</a>��
    	</li>
    </ul>
	<p><a href="{$script}">���</a></p>
</div>

<div id="footer">
    Powered By <a href="http://ethna.jp">Ethna</a>-{$smarty.const.ETHNA_VERSION}.
</div>

</body>
</html>
