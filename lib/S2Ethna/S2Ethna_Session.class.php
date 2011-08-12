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
 * ���Υ��å���󥯥饹�����DAO�ϡ��ʲ��Τ褦�ʥơ��֥�����ꤷ�Ƥ��ޤ���
 * MySQL�ǤΤ߳�ǧ���Ƥ��ޤ��Τǡ�����¾��DB�ǻ��Ѥ������¿���ѹ���ɬ�פˤʤ뤫�⤷��ޤ���
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
 * ���å���󥯥饹(���)
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
     * ���å���󥯥饹�Υ��󥹥ȥ饯��
     *
     * @access public
     */
    function __construct($appid, $save_dir, $logger) {
        parent::__construct($appid, $save_dir, $logger);

        $this->_set_save_handler();
    }

    /**
     * ���å����⥸�塼��Υ��ߡ�����
     * (���λ����ǤϤޤ�backend������夬�äƤ��ʤ��Τǡ�)
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
     * S2Ethna_SessionImpl�μ���
     *
     * @access private
     */
    private function _getImpl() {
        if (is_null($this->impl)) {
//            $this->logger->log(LOG_DEBUG, '_getImpl');
            // S2Ethna_SessionImpl�Υ���ݡ��ͥ�ȼ���
            $controller = & Ethna_Controller::getInstance();
            $backend = & $controller->getBackend();
            $diconPath = $backend->getDiconPath(get_class($this));
            $container = S2ContainerFactory::create($diconPath);
            $this->impl = $container->getComponent('S2Ethna_SessionImpl');
        }
        return $this->impl;
    }

    /**
     * �桼������Υ��å������¸�ؿ�(open)
     *
     * @access public
     * @param string $save_path ��¸�ѥ�
     * @param string $session_name ���å����̾
     * @return bool
     */
    function save_handler_open($save_path, $session_name) {
//      $this->logger->log(LOG_DEBUG, 'save_handler_open was called.');
        return $this->_getImpl()->save_handler_open($save_path, $session_name);
    }

    /**
     * �桼������Υ��å������¸�ؿ�(close)
     *
     * @access public
     * @return bool
     */
    function save_handler_close() {
//      $this->logger->log(LOG_DEBUG, 'save_handler_close was called.');
        return $this->_getImpl()->save_handler_close();
    }

    /**
     * �桼������Υ��å������¸�ؿ�(read)
     *
     * @access public
     * @param string $id ���å����ID
     * @return array
     */
    function save_handler_read($id) {
//      $this->logger->log(LOG_DEBUG, 'save_handler_read was called.');
        return $this->_getImpl()->save_handler_read($id);
    }

    /**
     * �桼������Υ��å������¸�ؿ�(write)
     *
     * @access public
     * @param string $id ���å����ID
     * @param string $sess_data ���å����ǡ���
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
     * �桼������Υ��å������¸�ؿ�(destroy)
     *
     * @access public
     * @param string $id ���å����ID
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
     * �桼������Υ��å������¸�ؿ�(gc)
     *
     * @access public
     * @param int $maxlifetime ������¸�ÿ�
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
     * ���å������˴�����
     * (PHP�Υ��å����˴ؤ���Х��к���)
     *
     * @access public
     * @return bool true:���ｪλ false:���顼
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
     * ���å����������������å�
     * (PHP�Υ��å����˴ؤ���Х��к���)
     *
     * @access public
     * @return bool true:�����ʥ��å���� false:�����ʥ��å����
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
 * ���å���󥯥饹(����)�Υ��󥿡��ե�����
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
     * �桼������Υ��å������¸�ؿ�(write)
     *
     * @access public
     * @param string $id ���å����ID
     * @param string $sess_data ���å����ǡ���
     * @return bool
     **/
    function save_handler_write($id, $sess_data);

    /**
     * �桼������Υ��å������¸�ؿ�(destroy)
     *
     * @access public
     * @param string $id ���å����ID
     * @return bool
     **/
    function save_handler_destroy($id);

    /**
     * �桼������Υ��å������¸�ؿ�(gc)
     *
     * @access public
     * @param int $maxlifetime ������¸�ÿ�
     * @return bool
     **/
    function save_handler_gc($maxlifetime);
}

/**
 * ���å���󥯥饹(����)�μ���
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

    /** ���å������󥭥�å��� */
    private $cache;

    /**
     * SessionDao��setter
     *
     * @access public
     * @param S2Ethna_SessionDao $sessionDao SessionDao
     */
    function setSessionDao(S2Ethna_SessionDao $sessionDao) {
        $this->dao = $sessionDao;
    }

    /**
     * �桼������Υ��å������¸�ؿ�(open)
     *
     * @access public
     * @param string $save_path ��¸�ѥ�
     * @param string $session_name ���å����̾
     * @return bool
     */
    function save_handler_open($save_path, $session_name) {
        $this->cache = array();

        return true;
    }

    /**
     * �桼������Υ��å������¸�ؿ�(close)
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
     * �桼������Υ��å������¸�ؿ�(read)
     *
     * @access public
     * @param string $id ���å����ID
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
     * �桼������Υ��å������¸�ؿ�(write)
     *
     * @access public
     * @param string $id ���å����ID
     * @param string $sess_data ���å����ǡ���
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
     * �桼������Υ��å������¸�ؿ�(destroy)
     *
     * @access public
     * @param string $id ���å����ID
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
     * �桼������Υ��å������¸�ؿ�(gc)
     *
     * @access public
     * @param int $maxlifetime ������¸�ÿ�
     * @return bool
     **/
    function save_handler_gc($maxlifetime) {
        $result = $this->dao->deleteSessionByLifetime($maxlifetime);

        return $result > 0 ? true : false;
    }
}

/**
 * SessionBean�μ���
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

    /** �ơ��֥�̾ */
    const TABLE = 'session';

    /** @var mixed id */
    protected $id;

    /**
     * id��getter
     *
     * @access public
     * @return mixed id
     */
    public function getId() {
        return $this->id;
    }

    /**
     * id��setter
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
     * sess_data��getter
     *
     * @access public
     * @return mixed sess_data
     */
    public function getSessData() {
        return $this->sess_data;
    }

    /**
     * sess_data��setter
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
     * remote_addr��getter
     *
     * @access public
     * @return mixed remote_addr
     */
    public function getRemoteAddr() {
        return $this->remote_addr;
    }

    /**
     * remote_addr��setter
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
     * timestamp��getter
     *
     * @access public
     * @return mixed timestamp
     */
    public function getTimestamp() {
        return $this->timestamp;
    }

    /**
     * timestamp��setter
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
 * SessionDao�Υ��󥿡��ե�����
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

    /** BEAN̾ */
    const BEAN = 'S2Ethna_SessionBean';

    /**
     * ���å�������
     *
     * @access public
     * @param S2Ethna_SessionBean $session BEAN
     * @return int �����Կ�
     * @exception S2Container_S2RuntimeException ��������
     */
    public function createSession(S2Ethna_SessionBean $session);

    /**
     * ���å����ID�ˤ�륻�å�������
     *
     * @access public
     * @param string $id ���å����ID
     * @return S2Ethna_SessionBean BEAN
     */
    public function getSessionById($id);

    /**
     * ���å���󹹿�
     *
     * @access public
     * @param S2Ethna_SessionBean $session BEAN
     * @return int �����Կ�
     * @exception S2Container_S2RuntimeException ��������
     */
    public function updateSession(S2Ethna_SessionBean $session);

    /**
     * ���å������
     *
     * @access public
     * @param S2Ethna_SessionBean $session BEAN
     * @return int �����Կ�
     * @exception S2Container_S2RuntimeException ��������
     */
    public function deleteSession(S2Ethna_SessionBean $session);

    /**
     * ������¸�ÿ��ˤ�륻�å������
     *
     * @access public
     * @param int $maxlifetime ������¸�ÿ�
     * @return int �����Կ�
     * @exception S2Container_S2RuntimeException ��������
     */
    public function deleteSessionByLifetime($maxlifetime);
    /** deleteSessionByLifetime��SQL */
    const deleteSessionByLifetime_SQL =
        'DELETE FROM session WHERE timestamp < CURRENT_TIMESTAMP - INTERVAL /*maxlifetime*/0 SECOND';

}
?>
