<?php
/**
 * CdBean.class.php
 *
 * @author Takuya Ookubo <sfio@sakura.ai.to>
 * @package S2ethna
 * @version SVN: $Id: CdBean.class.php 134 2008-06-14 12:40:29Z ookubo $
 * @category bean
 */

/**
 * cdBEAN�μ���
 *
 * @author Takuya Ookubo <sfio@sakura.ai.to>
 * @package S2ethna
 * @category bean
 */
class CdBean extends S2Ethna_BaseBean {

    /** �ơ��֥�̾ */
    const TABLE = 'cd';

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

    /** @var mixed TITLE */
    protected $TITLE;

    /**
     * TITLE��getter
     *
     * @access public
     * @return mixed TITLE
     */
    public function getTITLE() {
        return $this->TITLE;
    }

    /**
     * TITLE��setter
     *
     * @access public
     * @param mixed $TITLE TITLE
     * @return $this
     */
    public function setTITLE($TITLE) {
        $this->TITLE = $TITLE;
        return $this;
    }

    /** @var mixed CONTENT */
    protected $CONTENT;

    /**
     * CONTENT��getter
     *
     * @access public
     * @return mixed CONTENT
     */
    public function getCONTENT() {
        return $this->CONTENT;
    }

    /**
     * CONTENT��setter
     *
     * @access public
     * @param mixed $CONTENT CONTENT
     * @return $this
     */
    public function setCONTENT($CONTENT) {
        $this->CONTENT = $CONTENT;
        return $this;
    }

}
?>