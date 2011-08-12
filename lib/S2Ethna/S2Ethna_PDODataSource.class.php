<?php
/**
 * S2Ethna_PDODataSource.class.php
 *
 * @author Takuya Ookubo <sfio@sakura.ai.to>
 * @package S2Ethna
 * @version SVN: $Id: S2Ethna_PDODataSource.class.php,v 1.1 2007-09-27 01:18:40 ookubo Exp $
 * @category library
 * @copyright 2007 Takuya Ookubo <sfio@sakura.ai.to>
 * @license http://www.opensource.org/licenses/bsd-license.php The BSD License
 * @link http://s2ethna.ameria.jp/
 */

/**
 * S2Ethna_PDODataSource���饹
 *
 * ɸ���S2Container_PDODataSource�Ǥϡ����󥹥��󥹤��Ȥ�PDO���֥������Ȥ�����Ƥ��ޤ���
 * ʣ���Υޥ͡�����ǥȥ�󥶥��������礷�Ƥ����뤳�Ȥ�����ʤ��ʤäƤ��ޤ����ᡢ
 * PDO���֥������Ȥ�DSN/�桼��̾���Ȥ�1�Ĥ�Ȥ��ޤ魯�褦���ѹ���
 *
 * @author Takuya Ookubo <sfio@sakura.ai.to>
 * @package S2Ethna
 * @category class
 * @copyright 2007 Takuya Ookubo <sfio@sakura.ai.to>
 * @license http://www.opensource.org/licenses/bsd-license.php The BSD License
 * @version Release: 0.2
 * @link http://s2ethna.ameria.jp/
 */
class S2Ethna_PDODataSource extends S2Container_PDODataSource
{
    static protected $db_ = array();

    /**
     * ���ͥ��������������
     *
     * @return PDO PDO���֥�������
     * @access public
     */
    public function getConnection()
    {
        $ctl = & Ethna_Controller::getInstance();

    	if (!isset(self::$db_[$this->dsn][$this->user])) {
	    	self::$db_[$this->dsn][$this->user] = null;
	        $ctl->getLogger()->log(LOG_DEBUG, 'get new connection.');
    	}
    	$this->db =& self::$db_[$this->dsn][$this->user];
    	$result = parent::getConnection();

		if ($ctl->getConfig()->get('debug') === true) {
	        ob_start();
	        var_dump($result);
	        $variable = ob_get_contents();
	        ob_end_clean();
	        $ctl->getLogger()->log(LOG_DEBUG, 'connection is "' . sha1($variable) . '".');
		}

    	return $result;
    }
}
?>
