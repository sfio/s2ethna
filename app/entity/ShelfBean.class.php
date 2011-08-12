<?php
/**
 * ShelfBean.class.php
 *
 * @author Takuya Ookubo <sfio@sakura.ai.to>
 * @package S2ethna
 * @version SVN: $Id: ShelfBean.class.php 134 2008-06-14 12:40:29Z ookubo $
 * @category bean
 */

/**
 * shelfBEAN�μ���
 *
 * @author Takuya Ookubo <sfio@sakura.ai.to>
 * @package S2ethna
 * @category bean
 */
class ShelfBean extends S2Ethna_BaseBean {

    /** �ơ��֥�̾ */
    const TABLE = 'shelf';

    /** @var mixed ID */
    protected $ID;

    /**
     * ID��getter
     *
     * @access public
     * @return mixed ID
     */
    public function getID() {
        return $this->ID;
    }

    /**
     * ID��setter
     *
     * @access public
     * @param mixed $ID ID
     * @return $this
     */
    public function setID($ID) {
        $this->ID = $ID;
        return $this;
    }

    /** @var mixed CD_ID */
    protected $CD_ID;

    /**
     * CD_ID��getter
     *
     * @access public
     * @return mixed CD_ID
     */
    public function getCDID() {
        return $this->CD_ID;
    }

    /**
     * CD_ID��setter
     *
     * @access public
     * @param mixed $CD_ID CD_ID
     * @return $this
     */
    public function setCDID($CD_ID) {
        $this->CD_ID = $CD_ID;
        return $this;
    }

    /** @var mixed ADD_TIME */
    protected $ADD_TIME;

    /**
     * ADD_TIME��getter
     *
     * @access public
     * @return mixed ADD_TIME
     */
    public function getADDTIME() {
        return $this->ADD_TIME;
    }

    /**
     * ADD_TIME��setter
     *
     * @access public
     * @param mixed $ADD_TIME ADD_TIME
     * @return $this
     */
    public function setADDTIME($ADD_TIME) {
        $this->ADD_TIME = $ADD_TIME;
        return $this;
    }

}
?>