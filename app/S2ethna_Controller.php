<?php
/**
 * S2ethna_Controller.php
 *
 * @author Takuya Ookubo <sfio@sakura.ai.to>
 * @package S2ethna
 * @version SVN: $Id: S2ethna_Controller.php 142 2008-06-15 15:12:14Z ookubo $
 */

/** アプリケーションベースディレクトリ */
define('BASE', dirname(dirname(__FILE__)));

/** include_pathの設定(アプリケーションディレクトリを追加) */
$app = BASE . "/app";
$lib = BASE . "/lib";
ini_set('include_path', implode(PATH_SEPARATOR, array($app, $lib, "{$lib}/PEAR")));


/** アプリケーションライブラリのインクルード */
require_once 'ethna/Ethna.php';
require_once 'S2ethna_Error.php';
require_once 'S2ethna_ActionClass.php';
require_once 'S2ethna_ActionForm.php';
require_once 'S2ethna_ViewClass.php';

// ↓ここからS2Ethna対応
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
// ↑ここまでS2Ethna対応

/**
 * S2ethnaアプリケーションのコントローラ定義
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
     * @var string アプリケーションID
     */
    var $appid = 'S2ETHNA';

    /**
     * @var array forward定義
     */
    var $forward = array(
        /*
         * TODO: ここにforward先を記述してください
         *
         * 記述例：
         *
         * 'index' => array(
         *     'view_name' => 'S2ethna_View_Index',
         * ),
         */
    );

    /**
     * @var array action定義
     */
    var $action = array(
        /*
         * TODO: ここにaction定義を記述してください
         *
         * 記述例：
         *
         * 'index' => array(),
         */
    );

    /**
     * @var array soap action定義
     */
    var $soap_action = array(
        /*
         * TODO: ここにSOAPアプリケーション用のaction定義を
         * 記述してください
         * 記述例：
         *
         * 'sample' => array(),
         */
    );

    /**
     * @var array アプリケーションディレクトリ
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
     * @var array DBアクセス定義
     */
    var $db = array(
        ''              => DB_TYPE_RW,
    );

    /**
     * @var array 拡張子設定
     */
    var $ext = array(
        'php'           => 'php',
        'tpl'           => 'tpl',
    );

    /**
     * @var array クラス定義
     */
    var $class = array(
        /*
         * TODO: 設定クラス、ログクラス、SQLクラスをオーバーライド
         * した場合は下記のクラス名を忘れずに変更してください
         */
        'class'         => 'S2Ethna_ClassFactory',	// S2Ethna対応
        'backend'       => 'S2Ethna_Backend',		// S2Ethna対応
        'config'        => 'Ethna_Config',
        'db'            => 'Ethna_DB_PEAR',
        'error'         => 'Ethna_ActionError',
        'form'          => 'S2ethna_ActionForm',
        'i18n'          => 'Ethna_I18N',
        'logger'        => 'S2Ethna_Logger',		// S2Ethna対応
        'plugin'        => 'Ethna_Plugin',
        'session'       => 'Ethna_Session',
        // S2Ethna_Sessionを使用する場合、上の行を削除し、下の行のコメントアウトを解除する
//        'session'       => 'S2Ethna_SessionProxy',       // S2Ethna対応
        'sql'           => 'Ethna_AppSQL',
        'view'          => 'S2ethna_ViewClass',
        'renderer'      => 'Ethna_Renderer_Smarty',
        'url_handler'   => 'S2ethna_UrlHandler',
    );

    /**
     * @var array 検索対象となるプラグインのアプリケーションIDのリスト
     */
    var $plugin_search_appids = array(
        /*
         * プラグイン検索時に検索対象となるアプリケーションIDのリストを記述します。
         *
         * 記述例：
         * Common_Plugin_Foo_Bar のような命名のプラグインがアプリケーションの
         * プラグインディレクトリに存在する場合、以下のように指定すると
         * Common_Plugin_Foo_Bar, S2ethna_Plugin_Foo_Bar, Ethna_Plugin_Foo_Bar
         * の順にプラグインが検索されます。
         *
         * 'Common', 'S2ethna', 'Ethna',
         */
        'S2ethna', 'Ethna',
    );

    /**
     * @var array フィルタ設定
     */
    var $filter = array(
        /*
         * TODO: フィルタを利用する場合はここにそのプラグイン名を
         * 記述してください
         * (クラス名を指定するとfilterディレクトリからフィルタクラス
         * を読み込みます)
         *
         * 記述例：
         *
         * 'ExecutionTime',
         */
    );

    /**
     * @var array smarty modifier定義
     */
    var $smarty_modifier_plugin = array(
        /*
         * TODO: ここにユーザ定義のsmarty modifier一覧を記述してください
         *
         * 記述例：
         *
         * 'smarty_modifier_foo_bar',
         */
    );

    /**
     * @var array smarty function定義
     */
    var $smarty_function_plugin = array(
        /*
         * TODO: ここにユーザ定義のsmarty function一覧を記述してください
         *
         * 記述例：
         *
         * 'smarty_function_foo_bar',
         */
    );

    /**
     * @var array smarty block定義
     */
    var $smarty_block_plugin = array(
        /*
         * TODO: ここにユーザ定義のsmarty block一覧を記述してください
         *
         * 記述例：
         *
         * 'smarty_block_foo_bar',
         */
    );

    /**
     * @var array smarty prefilter定義
     */
    var $smarty_prefilter_plugin = array(
        /*
         * TODO: ここにユーザ定義のsmarty prefilter一覧を記述してください
         *
         * 記述例：
         *
         * 'smarty_prefilter_foo_bar',
         */
    );

    /**
     * @var array smarty postfilter定義
     */
    var $smarty_postfilter_plugin = array(
        /*
         * TODO: ここにユーザ定義のsmarty postfilter一覧を記述してください
         *
         * 記述例：
         *
         * 'smarty_postfilter_foo_bar',
         */
    );

    /**
     * @var array smarty outputfilter定義
     */
    var $smarty_outputfilter_plugin = array(
        /*
         * TODO: ここにユーザ定義のsmarty outputfilter一覧を記述してください
         *
         * 記述例：
         *
         * 'smarty_outputfilter_foo_bar',
         */
    );

    /**#@-*/

// ↓ここからS2Ethna対応
    /**
     * 補足しきれない例外を補足してログに記録する
     *
     * @access public
     * @param mixed $default_action_name 指定のアクション名
     * @param mixed $fallback_action_name アクション名が決定できなかった場合に実行されるアクション名
     * @param bool $enable_filter フィルタチェインを有効にするかどうか
     * @return mixed 0:正常終了 Ethna_Error:エラー
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
// ↑ここまでS2Ethna対応
}
?>
