<?php
/**
 * S2Ethna_Logger.class.php
 *
 * @author Takuya Ookubo <sfio@sakura.ai.to>
 * @package S2Ethna
 * @version SVN: $Id: S2Ethna_Logger.class.php 97 2007-10-28 15:21:03Z ookubo $
 * @category library
 * @copyright 2007 Takuya Ookubo <sfio@sakura.ai.to>
 * @license http://www.opensource.org/licenses/bsd-license.php The BSD License
 * @link http://s2ethna.ameria.jp/
 */

/**
 * log4phpラッパークラス<br />
 * (Ethna_Loggerクラスではなく、本物のlog4phpを使用する場合は、このクラスをコメントアウトする。)
 *
 * @author Takuya Ookubo <sfio@sakura.ai.to>
 * @package S2Ethna
 * @category class
 * @copyright 2007 Takuya Ookubo <sfio@sakura.ai.to>
 * @license http://www.opensource.org/licenses/bsd-license.php The BSD License
 * @version Release: 0.2
 * @link http://s2ethna.ameria.jp/
 */
final class LoggerManager {

    /**
     * コンストラクタ
     *
     * @access private
     * @param string $className
     */
    private function __construct($className) {
    	// new禁止
    }

    /**
     * ログオブジェクトのアクセサ
     *
     * @access public
     * @param string $className logger name
     * @param object $factory a LoggerFactory instance or null
     * @return Ethna_Logger ログオブジェクト
     */
    public static final function getLogger($className, $factory = null) {
    	// TODO: $className未使用
        $ctl = & Ethna_Controller::getInstance();
        return $ctl->getLogger();
    }

}

/**
 * Ethna_Loggerクラスファクトリ(S2Container.PHP5 v1.2系用)
 *
 * @author Takuya Ookubo <sfio@sakura.ai.to>
 * @package S2Ethna
 * @category class
 * @copyright 2007 Takuya Ookubo <sfio@sakura.ai.to>
 * @license http://www.opensource.org/licenses/bsd-license.php The BSD License
 * @version Release: 0.2
 * @link http://s2ethna.ameria.jp/
 */
class S2Ethna_EthnaLoggerFactory
{
    /**
     * コンストラクタ
     *
     * @access private
     */
    public function __construct(){
    }

    /**
     * ログオブジェクトのアクセサ
     *
     * @access public
     * @param string $className logger name
     * @return Ethna_Logger ログオブジェクト
     */
    public function getInstance($className)
    {
        return LoggerManager::getLogger($className);
    }
}

/**
 * log4phpもどきログ管理クラス
 *
 * @author Takuya Ookubo <sfio@sakura.ai.to>
 * @package S2Ethna
 * @category class
 * @copyright 2007 Takuya Ookubo <sfio@sakura.ai.to>
 * @license http://www.opensource.org/licenses/bsd-license.php The BSD License
 * @version Release: 0.2
 * @link http://s2ethna.ameria.jp/
 */
class S2Ethna_Logger extends Ethna_Logger {

    /**
     * Log a message object with the DEBUG level including the caller.
     *
     * @access public
     * @param string $msg message
     * @param string $methodName caller object or caller string id
     */
    public function debug($msg, $methodName = null) {
        if (!empty($methodName)) {
            $msg = "$methodName - $msg";
        }
        $this->log(LOG_DEBUG, $msg);
    }

    /**
     * Log a message object with the INFO Level.
     *
     * @access public
     * @param string $msg message
     * @param string $methodName caller object or caller string id
     */
    public function info($msg, $methodName = null) {
        if (!empty($methodName)) {
            $msg = "$methodName - $msg";
        }
        $this->log(LOG_INFO, $msg);
    }

    /**
     * Log a message with the WARN level.
     *
     * @access public
     * @param string $msg message
     * @param string $methodName caller object or caller string id
     */
    public function warn($msg, $methodName = null) {
        if (!empty($methodName)) {
            $msg = "$methodName - $msg";
        }
        $this->log(LOG_WARNING, $msg);
    }

    /**
     * Log a message object with the ERROR level including the caller.
     *
     * @access public
     * @param string $msg message
     * @param string $methodName caller object or caller string id
     */
    public function error($msg, $methodName = null) {
        if (!empty($methodName)) {
            $msg = "$methodName - $msg";
        }
        $this->log(LOG_ERR, $msg);
    }

    /**
     * Log a message object with the FATAL level including the caller.
     *
     * @access public
     * @param string $msg message
     * @param string $methodName caller object or caller string id
     */
    public function fatal($msg, $methodName = null) {
        if (!empty($methodName)) {
            $msg = "$methodName - $msg";
        }
        $this->log(LOG_CRIT, $msg);
    }
}
?>
