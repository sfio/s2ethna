<?php
/**
 * S2ethna_Controller.php
 *
 * @author Takuya Ookubo <sfio@sakura.ai.to>
 * @package S2ethna
 * @version SVN: $Id: S2ethna_Controller.php 142 2008-06-15 15:12:14Z ookubo $
 */

/** ���ץꥱ�������١����ǥ��쥯�ȥ� */
define('BASE', dirname(dirname(__FILE__)));

/** include_path������(���ץꥱ�������ǥ��쥯�ȥ���ɲ�) */
$app = BASE . "/app";
$lib = BASE . "/lib";
ini_set('include_path', implode(PATH_SEPARATOR, array($app, $lib, "{$lib}/PEAR")));


/** ���ץꥱ�������饤�֥��Υ��󥯥롼�� */
require_once 'ethna/Ethna.php';
require_once 'S2ethna_Error.php';
require_once 'S2ethna_ActionClass.php';
require_once 'S2ethna_ActionForm.php';
require_once 'S2ethna_ViewClass.php';

// ����������S2Ethna�б�
// S2Ethna
require_once('S2Ethna/S2Ethna.php');

/** DICON XML format DTD validation */
define('S2CONTAINER_PHP5_DOM_VALIDATE', false);

/** S2Container_SingletonS2ContainerFactory uses if defined */
//define('S2CONTAINER_PHP5_APP_DICON', '');

/** S2Container.PHP5 Log Level */
//define('S2CONTAINER_PHP5_LOG_LEVEL',S2Container_SimpleLogger::WARN);
define('S2CONTAINER_PHP5_LOG_LEVEL',S2Container_SimpleLogger::DEBUG);

/** Logging eval script as debug log */
//define('S2CONTAINER_PHP5_DEBUG_EVAL', false);

/** constant or comment annotation available */
define('S2CONTAINER_PHP5_ANNOTATION_HANDLER', 'S2Container_ConstantAnnotationHandler');

/** append suffix to dicon file */
//define('S2CONTAINER_PHP5_ENV', '');

/** constant or comment annotation usage */
//define('S2DAO_PHP5_USE_COMMENT', false);
S2Container_AnnotationContainer::$DEFAULT_ANNOTATION_READER = 'S2DaoAnnotationReader';
// �������ޤ�S2Ethna�б�

/**
 * S2ethna���ץꥱ�������Υ���ȥ������
 *
 * @author Takuya Ookubo <sfio@sakura.ai.to>
 * @access public
 * @package S2ethna
 */
class S2ethna_Controller extends Ethna_Controller
{
    /**#@+
     * @access private
     */

    /**
     * @var string ���ץꥱ�������ID
     */
    var $appid = 'S2ETHNA';

    /**
     * @var array forward���
     */
    var $forward = array(
        /*
         * TODO: ������forward��򵭽Ҥ��Ƥ�������
         *
         * �����㡧
         *
         * 'index' => array(
         *     'view_name' => 'S2ethna_View_Index',
         * ),
         */
    );

    /**
     * @var array action���
     */
    var $action = array(
        /*
         * TODO: ������action����򵭽Ҥ��Ƥ�������
         *
         * �����㡧
         *
         * 'index' => array(),
         */
    );

    /**
     * @var array soap action���
     */
    var $soap_action = array(
        /*
         * TODO: ������SOAP���ץꥱ��������Ѥ�action�����
         * ���Ҥ��Ƥ�������
         * �����㡧
         *
         * 'sample' => array(),
         */
    );

    /**
     * @var array ���ץꥱ�������ǥ��쥯�ȥ�
     */
    var $directory = array(
        'action'        => 'app/action',
        'action_cli'    => 'app/action_cli',
        'action_xmlrpc' => 'app/action_xmlrpc',
        'app'           => 'app',
        'plugin'        => 'app/plugin',
        'bin'           => 'bin',
        'etc'           => 'etc',
        'filter'        => 'app/filter',
        'locale'        => 'locale',
        'log'           => 'log',
        'plugins'       => array(),
        'template'      => 'template',
        'template_c'    => 'tmp',
        'tmp'           => 'tmp',
        'view'          => 'app/view',
        'www'           => 'www',
    );

    /**
     * @var array DB�����������
     */
    var $db = array(
        ''              => DB_TYPE_RW,
    );

    /**
     * @var array ��ĥ������
     */
    var $ext = array(
        'php'           => 'php',
        'tpl'           => 'tpl',
    );

    /**
     * @var array ���饹���
     */
    var $class = array(
        /*
         * TODO: ���ꥯ�饹�������饹��SQL���饹�򥪡��С��饤��
         * �������ϲ����Υ��饹̾��˺�줺���ѹ����Ƥ�������
         */
        'class'         => 'S2Ethna_ClassFactory',	// S2Ethna�б�
        'backend'       => 'S2Ethna_Backend',		// S2Ethna�б�
        'config'        => 'Ethna_Config',
        'db'            => 'Ethna_DB_PEAR',
        'error'         => 'Ethna_ActionError',
        'form'          => 'S2ethna_ActionForm',
        'i18n'          => 'Ethna_I18N',
        'logger'        => 'S2Ethna_Logger',		// S2Ethna�б�
        'plugin'        => 'Ethna_Plugin',
        'session'       => 'Ethna_Session',
        // S2Ethna_Session����Ѥ����硢��ιԤ����������ιԤΥ����ȥ����Ȥ�������
//        'session'       => 'S2Ethna_SessionProxy',       // S2Ethna�б�
        'sql'           => 'Ethna_AppSQL',
        'view'          => 'S2ethna_ViewClass',
        'renderer'      => 'Ethna_Renderer_Smarty',
        'url_handler'   => 'S2ethna_UrlHandler',
    );

    /**
     * @var array �����оݤȤʤ�ץ饰����Υ��ץꥱ�������ID�Υꥹ��
     */
    var $plugin_search_appids = array(
        /*
         * �ץ饰���󸡺����˸����оݤȤʤ륢�ץꥱ�������ID�Υꥹ�Ȥ򵭽Ҥ��ޤ���
         *
         * �����㡧
         * Common_Plugin_Foo_Bar �Τ褦��̿̾�Υץ饰���󤬥��ץꥱ��������
         * �ץ饰����ǥ��쥯�ȥ��¸�ߤ����硢�ʲ��Τ褦�˻��ꤹ���
         * Common_Plugin_Foo_Bar, S2ethna_Plugin_Foo_Bar, Ethna_Plugin_Foo_Bar
         * �ν�˥ץ饰���󤬸�������ޤ���
         *
         * 'Common', 'S2ethna', 'Ethna',
         */
        'S2ethna', 'Ethna',
    );

    /**
     * @var array �ե��륿����
     */
    var $filter = array(
        /*
         * TODO: �ե��륿�����Ѥ�����Ϥ����ˤ��Υץ饰����̾��
         * ���Ҥ��Ƥ�������
         * (���饹̾����ꤹ���filter�ǥ��쥯�ȥ꤫��ե��륿���饹
         * ���ɤ߹��ߤޤ�)
         *
         * �����㡧
         *
         * 'ExecutionTime',
         */
    );

    /**
     * @var array smarty modifier���
     */
    var $smarty_modifier_plugin = array(
        /*
         * TODO: �����˥桼�������smarty modifier�����򵭽Ҥ��Ƥ�������
         *
         * �����㡧
         *
         * 'smarty_modifier_foo_bar',
         */
    );

    /**
     * @var array smarty function���
     */
    var $smarty_function_plugin = array(
        /*
         * TODO: �����˥桼�������smarty function�����򵭽Ҥ��Ƥ�������
         *
         * �����㡧
         *
         * 'smarty_function_foo_bar',
         */
    );

    /**
     * @var array smarty block���
     */
    var $smarty_block_plugin = array(
        /*
         * TODO: �����˥桼�������smarty block�����򵭽Ҥ��Ƥ�������
         *
         * �����㡧
         *
         * 'smarty_block_foo_bar',
         */
    );

    /**
     * @var array smarty prefilter���
     */
    var $smarty_prefilter_plugin = array(
        /*
         * TODO: �����˥桼�������smarty prefilter�����򵭽Ҥ��Ƥ�������
         *
         * �����㡧
         *
         * 'smarty_prefilter_foo_bar',
         */
    );

    /**
     * @var array smarty postfilter���
     */
    var $smarty_postfilter_plugin = array(
        /*
         * TODO: �����˥桼�������smarty postfilter�����򵭽Ҥ��Ƥ�������
         *
         * �����㡧
         *
         * 'smarty_postfilter_foo_bar',
         */
    );

    /**
     * @var array smarty outputfilter���
     */
    var $smarty_outputfilter_plugin = array(
        /*
         * TODO: �����˥桼�������smarty outputfilter�����򵭽Ҥ��Ƥ�������
         *
         * �����㡧
         *
         * 'smarty_outputfilter_foo_bar',
         */
    );

    /**#@-*/

// ����������S2Ethna�б�
    /**
     * ��­������ʤ��㳰����­���ƥ��˵�Ͽ����
     *
     * @access public
     * @param mixed $default_action_name ����Υ��������̾
     * @param mixed $fallback_action_name ���������̾������Ǥ��ʤ��ä����˼¹Ԥ���륢�������̾
     * @param bool $enable_filter �ե��륿���������ͭ���ˤ��뤫�ɤ���
     * @return mixed 0:���ｪλ Ethna_Error:���顼
     */
    function trigger($default_action_name = "", $fallback_action_name = "", $enable_filter = true)
    {
        try {
            $r = parent::trigger($default_action_name, $fallback_action_name, $enable_filter);
        } catch (Exception $e) {
            $this->logger->log(LOG_CRIT, 'Caught exception \'' . get_class($e) . '\' with message \'' . $e->getMessage() . '\' in ' . __METHOD__);
        }
        return $r;
    }
// �������ޤ�S2Ethna�б�
}
?>
