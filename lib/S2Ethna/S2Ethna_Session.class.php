<?php
/**
 * S2Ethna_Session.class.php
 *
 * @author Takuya Ookubo <sfio@sakura.ai.to>
 * @package S2Ethna
 * @version SVN: $Id: S2Ethna_Session.class.php 20 2007-09-09 04:47:33Z ookubo $
 * @category library
 * @copyright 2007 Takuya Ookubo <sfio@sakura.ai.to>
 * @license http://www.opensource.org/licenses/bsd-license.php The BSD License
 * @link http://s2ethna.ameria.jp/
 */

/*
 * このセッションクラスおよびDAOは、以下のようなテーブルを想定しています。
 * MySQLでのみ確認していますので、その他のDBで使用する場合は多少変更が必要になるかもしれません。
 *
 * CREATE TABLE `session` (
 *        `id` VARCHAR(255) NOT NULL
 *      , `sess_data` TEXT
 *      , `remote_addr` VARCHAR(255)
 *      , `timestamp` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
 *      , PRIMARY KEY (`id`)
 * );
 */

/**
 * セッションクラス(中継)
 *
 * @author Takuya Ookubo <sfio@sakura.ai.to>
 * @package S2Ethna
 * @category class
 * @copyright 2007 Takuya Ookubo <sfio@sakura.ai.to>
 * @license http://www.opensource.org/licenses/bsd-license.php The BSD License
 * @version Release: 0.2
 * @link http://s2ethna.ameria.jp/
 */
class S2Ethna_SessionProxy extends Ethna_Session {

    /** S2Ethna_SessionImpl */
    private $impl = null;

    /**
     * セッションクラスのコンストラクタ
     *
     * @access public
     */
    function __construct($appid, $save_dir, $logger) {
        parent::__construct($appid, $save_dir, $logger);

        $this->_set_save_handler();
    }

    /**
     * セッションモジュールのダミー設定
     * (この時点ではまだbackendが出来上がっていないので。)
     *
     * @access private
     */
    private function _set_save_handler() {
        $this->logger->log(LOG_DEBUG, 'set_save_handler');

//      ini_set('session.save_handler', 'user');
        session_module_name('user');

        session_set_save_handler(array (
            $this,
            'save_handler_open'
        ), array (
            $this,
            'save_handler_close'
        ), array (
            $this,
            'save_handler_read'
        ), array (
            $this,
            'save_handler_write'
        ), array (
            $this,
            'save_handler_destroy'
        ), array (
            $this,
            'save_handler_gc'
        ));
    }

    /**
     * S2Ethna_SessionImplの取得
     *
     * @access private
     */
    private function _getImpl() {
        if (is_null($this->impl)) {
//            $this->logger->log(LOG_DEBUG, '_getImpl');
            // S2Ethna_SessionImplのコンポーネント取得
            $controller = & Ethna_Controller::getInstance();
            $backend = & $controller->getBackend();
            $diconPath = $backend->getDiconPath(get_class($this));
            $container = S2ContainerFactory::create($diconPath);
            $this->impl = $container->getComponent('S2Ethna_SessionImpl');
        }
        return $this->impl;
    }

    /**
     * ユーザ定義のセッション保存関数(open)
     *
     * @access public
     * @param string $save_path 保存パス
     * @param string $session_name セッション名
     * @return bool
     */
    function save_handler_open($save_path, $session_name) {
//      $this->logger->log(LOG_DEBUG, 'save_handler_open was called.');
        return $this->_getImpl()->save_handler_open($save_path, $session_name);
    }

    /**
     * ユーザ定義のセッション保存関数(close)
     *
     * @access public
     * @return bool
     */
    function save_handler_close() {
//      $this->logger->log(LOG_DEBUG, 'save_handler_close was called.');
        return $this->_getImpl()->save_handler_close();
    }

    /**
     * ユーザ定義のセッション保存関数(read)
     *
     * @access public
     * @param string $id セッションID
     * @return array
     */
    function save_handler_read($id) {
//      $this->logger->log(LOG_DEBUG, 'save_handler_read was called.');
        return $this->_getImpl()->save_handler_read($id);
    }

    /**
     * ユーザ定義のセッション保存関数(write)
     *
     * @access public
     * @param string $id セッションID
     * @param string $sess_data セッションデータ
     * @return bool
     **/
    function save_handler_write($id, $sess_data) {
//      $this->logger->log(LOG_DEBUG, 'save_handler_write was called.');
        try {
            return $this->_getImpl()->save_handler_write($id, $sess_data);
        } catch (Exception $e) {
            return false;
        }
    }

    /**
     * ユーザ定義のセッション保存関数(destroy)
     *
     * @access public
     * @param string $id セッションID
     * @return bool
     **/
    function save_handler_destroy($id) {
//      $this->logger->log(LOG_DEBUG, 'save_handler_destroy was called.');
        try {
            return $this->_getImpl()->save_handler_destroy($id);
        } catch (Exception $e) {
            return false;
        }
    }

    /**
     * ユーザ定義のセッション保存関数(gc)
     *
     * @access public
     * @param int $maxlifetime 最大生存秒数
     * @return bool
     **/
    function save_handler_gc($maxlifetime) {
        $this->logger->log(LOG_DEBUG, 'save_handler_gc was called.');
        try {
            return $this->_getImpl()->save_handler_gc($maxlifetime);
        } catch (Exception $e) {
            return false;
        }
    }

    /**
     * セッションを破棄する
     * (PHPのセッションに関するバグ対策版)
     *
     * @access public
     * @return bool true:正常終了 false:エラー
     * @link http://bugs.php.net/bug.php?id=32330 PHP Bugs: #32330
     */
    function destroy() {
        $result = parent::destroy();
        if (!$this->session_start) {
            $this->set_save_handler();
        }
        return $result;
    }

    /**
     * セッションの正当性チェック
     * (PHPのセッションに関するバグ対策版)
     *
     * @access public
     * @return bool true:正当なセッション false:不当なセッション
     * @link http://bugs.php.net/bug.php?id=32330 PHP Bugs: #32330
     */
    function isValid() {
        $result = parent::isValid();
        if (!$this->session_start) {
            $this->set_save_handler();
        }
        return $result;
    }
}

/**
 * セッションクラス(本体)のインターフェース
 *
 * @author Takuya Ookubo <sfio@sakura.ai.to>
 * @package S2Ethna
 * @category interface
 * @copyright 2007 Takuya Ookubo <sfio@sakura.ai.to>
 * @license http://www.opensource.org/licenses/bsd-license.php The BSD License
 * @version Release: 0.2
 * @link http://s2ethna.ameria.jp/
 */
interface S2Ethna_Session {
    /**
     * ユーザ定義のセッション保存関数(write)
     *
     * @access public
     * @param string $id セッションID
     * @param string $sess_data セッションデータ
     * @return bool
     **/
    function save_handler_write($id, $sess_data);

    /**
     * ユーザ定義のセッション保存関数(destroy)
     *
     * @access public
     * @param string $id セッションID
     * @return bool
     **/
    function save_handler_destroy($id);

    /**
     * ユーザ定義のセッション保存関数(gc)
     *
     * @access public
     * @param int $maxlifetime 最大生存秒数
     * @return bool
     **/
    function save_handler_gc($maxlifetime);
}

/**
 * セッションクラス(本体)の実装
 *
 * @author Takuya Ookubo <sfio@sakura.ai.to>
 * @package S2Ethna
 * @category class
 * @copyright 2007 Takuya Ookubo <sfio@sakura.ai.to>
 * @license http://www.opensource.org/licenses/bsd-license.php The BSD License
 * @version Release: 0.2
 * @link http://s2ethna.ameria.jp/
 */
class S2Ethna_SessionImpl implements S2Ethna_Session {

    /** SessionDao */
    private $dao;

    /** セッション情報キャッシュ */
    private $cache;

    /**
     * SessionDaoのsetter
     *
     * @access public
     * @param S2Ethna_SessionDao $sessionDao SessionDao
     */
    function setSessionDao(S2Ethna_SessionDao $sessionDao) {
        $this->dao = $sessionDao;
    }

    /**
     * ユーザ定義のセッション保存関数(open)
     *
     * @access public
     * @param string $save_path 保存パス
     * @param string $session_name セッション名
     * @return bool
     */
    function save_handler_open($save_path, $session_name) {
        $this->cache = array();

        return true;
    }

    /**
     * ユーザ定義のセッション保存関数(close)
     *
     * @access public
     * @return bool
     */
    function save_handler_close() {
        unset($this->cache);
        $this->cache = null;

        return true;
    }

    /**
     * ユーザ定義のセッション保存関数(read)
     *
     * @access public
     * @param string $id セッションID
     * @return array
     */
    function save_handler_read($id) {
        $sess_data = '';

        $sessionBean = & $this->dao->getSessionById($id);
        if (!empty ($sessionBean)) {
            $sess_data = & $sessionBean->getSessData();
            $this->cache[$id] = $sessionBean;
        }

        return $sess_data;
    }

    /**
     * ユーザ定義のセッション保存関数(write)
     *
     * @access public
     * @param string $id セッションID
     * @param string $sess_data セッションデータ
     * @return bool
     **/
    function save_handler_write($id, $sess_data) {
        $result = 0;

        if (empty ($this->cache[$id])) {
            $sessionBean = new S2Ethna_SessionBean();
            $sessionBean->setId($id);
            $sessionBean->setSessData($sess_data);
            $sessionBean->setRemoteAddr($_SERVER['REMOTE_ADDR']);
            $result = $this->dao->createSession($sessionBean);
        } else {
            $sessionBean = & $this->cache[$id];
            $sessionBean->setSessData($sess_data);
            $sessionBean->setRemoteAddr($_SERVER['REMOTE_ADDR']);
            try {
                $result = $this->dao->updateSession($sessionBean);
            } catch (S2Dao_NotSingleRowUpdatedRuntimeException $e) {
                $this->logger->log(LOG_DEBUG, 'Session was updated by other processes.');
                throw $e;
            }
        }
        $this->cache[$id] = $sessionBean;

        return $result > 0 ? true : false;
    }

    /**
     * ユーザ定義のセッション保存関数(destroy)
     *
     * @access public
     * @param string $id セッションID
     * @return bool
     **/
    function save_handler_destroy($id) {
        $result = 0;

        $sessionBean = $this->cache[$id];
        if (!empty ($sessionBean)) {
            $result = $this->dao->deleteSession($sessionBean);
        }

        return $result > 0 ? true : false;
    }

    /**
     * ユーザ定義のセッション保存関数(gc)
     *
     * @access public
     * @param int $maxlifetime 最大生存秒数
     * @return bool
     **/
    function save_handler_gc($maxlifetime) {
        $result = $this->dao->deleteSessionByLifetime($maxlifetime);

        return $result > 0 ? true : false;
    }
}

/**
 * SessionBeanの実装
 *
 * @author Takuya Ookubo <sfio@sakura.ai.to>
 * @package S2Ethna
 * @category bean
 * @copyright 2007 Takuya Ookubo <sfio@sakura.ai.to>
 * @license http://www.opensource.org/licenses/bsd-license.php The BSD License
 * @version Release: 0.2
 * @link http://s2ethna.ameria.jp/
 */
class S2Ethna_SessionBean extends S2Ethna_BaseBean {

    /** テーブル名 */
    const TABLE = 'session';

    /** @var mixed id */
    protected $id;

    /**
     * idのgetter
     *
     * @access public
     * @return mixed id
     */
    public function getId() {
        return $this->id;
    }

    /**
     * idのsetter
     *
     * @access public
     * @param mixed $id id
     * @return $this
     */
    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    /** @var mixed sess_data */
    protected $sess_data;

    /**
     * sess_dataのgetter
     *
     * @access public
     * @return mixed sess_data
     */
    public function getSessData() {
        return $this->sess_data;
    }

    /**
     * sess_dataのsetter
     *
     * @access public
     * @param mixed $sess_data sess_data
     * @return $this
     */
    public function setSessData($sess_data) {
        $this->sess_data = $sess_data;
        return $this;
    }

    /** @var mixed remote_addr */
    protected $remote_addr;

    /**
     * remote_addrのgetter
     *
     * @access public
     * @return mixed remote_addr
     */
    public function getRemoteAddr() {
        return $this->remote_addr;
    }

    /**
     * remote_addrのsetter
     *
     * @access public
     * @param mixed $remote_addr remote_addr
     * @return $this
     */
    public function setRemoteAddr($remote_addr) {
        $this->remote_addr = $remote_addr;
        return $this;
    }

    /** @var mixed timestamp */
    protected $timestamp;

    /**
     * timestampのgetter
     *
     * @access public
     * @return mixed timestamp
     */
    public function getTimestamp() {
        return $this->timestamp;
    }

    /**
     * timestampのsetter
     *
     * @access public
     * @param mixed $timestamp timestamp
     * @return $this
     */
    public function setTimestamp($timestamp) {
        $this->timestamp = $timestamp;
        return $this;
    }

}

/**
 * SessionDaoのインターフェース
 *
 * @author Takuya Ookubo <sfio@sakura.ai.to>
 * @package S2Ethna
 * @category dao
 * @copyright 2007 Takuya Ookubo <sfio@sakura.ai.to>
 * @license http://www.opensource.org/licenses/bsd-license.php The BSD License
 * @version Release: 0.2
 * @link http://s2ethna.ameria.jp/
 */
interface S2Ethna_SessionDao {

    /** BEAN名 */
    const BEAN = 'S2Ethna_SessionBean';

    /**
     * セッション作成
     *
     * @access public
     * @param S2Ethna_SessionBean $session BEAN
     * @return int 更新行数
     * @exception S2Container_S2RuntimeException 更新失敗
     */
    public function createSession(S2Ethna_SessionBean $session);

    /**
     * セッションIDによるセッション取得
     *
     * @access public
     * @param string $id セッションID
     * @return S2Ethna_SessionBean BEAN
     */
    public function getSessionById($id);

    /**
     * セッション更新
     *
     * @access public
     * @param S2Ethna_SessionBean $session BEAN
     * @return int 更新行数
     * @exception S2Container_S2RuntimeException 更新失敗
     */
    public function updateSession(S2Ethna_SessionBean $session);

    /**
     * セッション削除
     *
     * @access public
     * @param S2Ethna_SessionBean $session BEAN
     * @return int 更新行数
     * @exception S2Container_S2RuntimeException 更新失敗
     */
    public function deleteSession(S2Ethna_SessionBean $session);

    /**
     * 最大生存秒数によるセッション削除
     *
     * @access public
     * @param int $maxlifetime 最大生存秒数
     * @return int 更新行数
     * @exception S2Container_S2RuntimeException 更新失敗
     */
    public function deleteSessionByLifetime($maxlifetime);
    /** deleteSessionByLifetimeのSQL */
    const deleteSessionByLifetime_SQL =
        'DELETE FROM session WHERE timestamp < CURRENT_TIMESTAMP - INTERVAL /*maxlifetime*/0 SECOND';

}
?>
