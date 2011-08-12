<?php
/**
 * S2Ethna_Exception.class.php
 *
 * @author Takuya Ookubo <sfio@sakura.ai.to>
 * @package S2Ethna
 * @version SVN: $Id: S2Ethna_Exception.class.php 20 2007-09-09 04:47:33Z ookubo $
 * @category library
 * @copyright 2007 Takuya Ookubo <sfio@sakura.ai.to>
 * @license http://www.opensource.org/licenses/bsd-license.php The BSD License
 * @link http://s2ethna.ameria.jp/
 */

/**
 * S2Ethna例外クラス
 *
 * @author Takuya Ookubo <sfio@sakura.ai.to>
 * @package S2Ethna
 * @category class
 * @copyright 2007 Takuya Ookubo <sfio@sakura.ai.to>
 * @license http://www.opensource.org/licenses/bsd-license.php The BSD License
 * @version Release: 0.2
 * @link http://s2ethna.ameria.jp/
 */
class S2Ethna_Exception extends Exception
{
//    protected $message = 'Unknown exception';   // exception message
//    protected $code = 0;                        // user defined exception code
//    protected $file;                            // source filename of exception
//    protected $line;                            // source line of exception
//
//    function __construct($message = null, $code = 0);
//
//    final function getMessage();                // message of exception
//    final function getCode();                   // code of exception
//    final function getFile();                   // source filename
//    final function getLine();                   // source line
//    final function getTrace();                  // an array of the backtrace()
//    final function getTraceAsString();          // formated string of trace
//
//    /* Overrideable */
//    function __toString();                       // formated string for display

    /**
     *
     */
    protected $err = null;

    /**
     * コンストラクタ
     *
     * @access private
     */
    function __construct(Ethna_Error $obj)
    {
        $this->err = $obj;

        $message = !is_null($obj) ? $obj->getMessage() : null;
        $code = !is_null($obj) ? $obj->getCode() : 0;

        parent::__construct($message, $code);
    }

    /**
     * Ethna_Errorオブジェクトを返却する
     *
     * @return Ethna_Error
     */
    final function getObject() {
        return $this->err;
    }
}

/**
 * S2Ethna例外クラス(Error)
 *
 * @author Takuya Ookubo <sfio@sakura.ai.to>
 * @package S2Ethna
 * @category class
 * @copyright 2007 Takuya Ookubo <sfio@sakura.ai.to>
 * @license http://www.opensource.org/licenses/bsd-license.php The BSD License
 * @version Release: 0.2
 * @link http://s2ethna.ameria.jp/
 */
class S2Ethna_ErrorException extends S2Ethna_Exception
{
    /**
     * コンストラクタ
     *
     * @access private
     */
    function __construct($message = null, $code = 0)
    {
        $userinfo = null;
        if (func_num_args() > 2) {
            $userinfo = array_slice(func_get_args(), 2);
            if (count($userinfo) == 1 && is_array($userinfo[0])) {
                $userinfo = $userinfo[0];
            }
        }
        $obj = Ethna::raiseError($message, $code, $userinfo);

        parent::__construct($obj);
    }
}

/**
 * S2Ethna例外クラス(Warning)
 *
 * @author Takuya Ookubo <sfio@sakura.ai.to>
 * @package S2Ethna
 * @category class
 * @copyright 2007 Takuya Ookubo <sfio@sakura.ai.to>
 * @license http://www.opensource.org/licenses/bsd-license.php The BSD License
 * @version Release: 0.2
 * @link http://s2ethna.ameria.jp/
 */
class S2Ethna_WarningException extends S2Ethna_Exception
{
    /**
     * コンストラクタ
     *
     * @access private
     */
    function __construct($message = null, $code = 0)
    {
        $userinfo = null;
        if (func_num_args() > 2) {
            $userinfo = array_slice(func_get_args(), 2);
            if (count($userinfo) == 1 && is_array($userinfo[0])) {
                $userinfo = $userinfo[0];
            }
        }
        $obj = Ethna::raiseWarning($message, $code, $userinfo);

        parent::__construct($obj);
    }
}

/**
 * S2Ethna例外クラス(Notice)
 *
 * @author Takuya Ookubo <sfio@sakura.ai.to>
 * @package S2Ethna
 * @category class
 * @copyright 2007 Takuya Ookubo <sfio@sakura.ai.to>
 * @license http://www.opensource.org/licenses/bsd-license.php The BSD License
 * @version Release: 0.2
 * @link http://s2ethna.ameria.jp/
 */
class S2Ethna_NoticeException extends S2Ethna_Exception
{
    /**
     * コンストラクタ
     *
     * @access private
     */
    function __construct($message = null, $code = 0)
    {
        $userinfo = null;
        if (func_num_args() > 2) {
            $userinfo = array_slice(func_get_args(), 2);
            if (count($userinfo) == 1 && is_array($userinfo[0])) {
                $userinfo = $userinfo[0];
            }
        }
        $obj = Ethna::raiseNotice($message, $code, $userinfo);

        parent::__construct($obj);
    }
}
?>
