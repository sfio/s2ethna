<?php
/**
 * S2Ethna_BaseBean.class.php
 *
 * @author Takuya Ookubo <sfio@sakura.ai.to>
 * @package S2Ethna
 * @version SVN: $Id: S2Ethna_BaseBean.class.php 20 2007-09-09 04:47:33Z ookubo $
 * @category library
 * @copyright 2007 Takuya Ookubo <sfio@sakura.ai.to>
 * @license http://www.opensource.org/licenses/bsd-license.php The BSD License
 * @link http://s2ethna.ameria.jp/
 */

/**
 * S2Ethna����������Bean�δ��쥯�饹
 *
 * @author Takuya Ookubo <sfio@sakura.ai.to>
 * @package S2Ethna
 * @category class
 * @copyright 2007 Takuya Ookubo <sfio@sakura.ai.to>
 * @license http://www.opensource.org/licenses/bsd-license.php The BSD License
 * @version Release: 0.2
 * @link http://s2ethna.ameria.jp/
 */
class S2Ethna_BaseBean {

    /** �ơ��֥�̾ */
    const TABLE = null;

    /**
     * ����
     */
    public function toArray(){
        $buf = array();
        foreach ($this as $property => $value) {
            if (method_exists($value, 'toArray')) {
                $buf[$property] = $value->toArray();
            } else {
                $buf[$property] = $value;
            }
        }
        return $buf;
    }

    /**
     * ʸ����
     */
    public function __toString() {
        $buf = '';
        foreach ($this as $property => $value) {
            $buf .= (string) $value . PHP_EOL;
        }
        return (string) $buf;
    }

    /**
     * ���ꥢ�饤��
     */
    public function serialize() {
        $serialize = array();
        foreach ($this as $property => $value) {
            $serialize[$property] = $value;
        }
        return serialize($serialize);
    }

    /**
     * ���󥷥ꥢ�饤��
     */
    public function unserialize($serialize) {
        $variables = unserialize($serialize);
        foreach ($variables as $property => $value) {
            $this->$property = $value;
        }
    }

}
?>
