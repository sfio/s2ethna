<?php
/**
 * BbsBean.class.php
 *
 * @author Takuya Ookubo <sfio@sakura.ai.to>
 * @package S2ethna
 * @version $Id: BbsBean.class.php 134 2008-06-14 12:40:29Z ookubo $
 * @category bean
 */

/**
 * bbsBEAN�μ���
 *
 * @author Takuya Ookubo <sfio@sakura.ai.to>
 * @package S2ethna
 * @category bean
 */
class BbsBean extends S2Ethna_BaseBean {

    /** �ơ��֥�̾ */
    const TABLE = 'bbs';

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

    /** @var mixed date */
    protected $date;

    /**
     * date��getter
     *
     * @access public
     * @return mixed date
     */
    public function getDate() {
        return $this->date;
    }

    /**
     * date��setter
     *
     * @access public
     * @param mixed $date date
     * @return $this
     */
    public function setDate($date) {
        $this->date = $date;
        return $this;
    }

    /** @var mixed name */
    protected $name;

    /**
     * name��getter
     *
     * @access public
     * @return mixed name
     */
    public function getName() {
        return $this->name;
    }

    /**
     * name��setter
     *
     * @access public
     * @param mixed $name name
     * @return $this
     */
    public function setName($name) {
        $this->name = $name;
        return $this;
    }

    /** @var mixed email */
    protected $email;

    /**
     * email��getter
     *
     * @access public
     * @return mixed email
     */
    public function getEmail() {
        return $this->email;
    }

    /**
     * email��setter
     *
     * @access public
     * @param mixed $email email
     * @return $this
     */
    public function setEmail($email) {
        $this->email = $email;
        return $this;
    }

    /** @var mixed subject */
    protected $subject;

    /**
     * subject��getter
     *
     * @access public
     * @return mixed subject
     */
    public function getSubject() {
        return $this->subject;
    }

    /**
     * subject��setter
     *
     * @access public
     * @param mixed $subject subject
     * @return $this
     */
    public function setSubject($subject) {
        $this->subject = $subject;
        return $this;
    }

    /** @var mixed body */
    protected $body;

    /**
     * body��getter
     *
     * @access public
     * @return mixed body
     */
    public function getBody() {
        return $this->body;
    }

    /**
     * body��setter
     *
     * @access public
     * @param mixed $body body
     * @return $this
     */
    public function setBody($body) {
        $this->body = $body;
        return $this;
    }

    /** @var mixed password */
    protected $password;

    /**
     * password��getter
     *
     * @access public
     * @return mixed password
     */
    public function getPassword() {
        return $this->password;
    }

    /**
     * password��setter
     *
     * @access public
     * @param mixed $password password
     * @return $this
     */
    public function setPassword($password) {
        $this->password = $password;
        return $this;
    }

    /** @var mixed host */
    protected $host;

    /**
     * host��getter
     *
     * @access public
     * @return mixed host
     */
    public function getHost() {
        return $this->host;
    }

    /**
     * host��setter
     *
     * @access public
     * @param mixed $host host
     * @return $this
     */
    public function setHost($host) {
        $this->host = $host;
        return $this;
    }

}
?>