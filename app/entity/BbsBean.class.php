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
 * bbsBEANの実装
 *
 * @author Takuya Ookubo <sfio@sakura.ai.to>
 * @package S2ethna
 * @category bean
 */
class BbsBean extends S2Ethna_BaseBean {

    /** テーブル名 */
    const TABLE = 'bbs';

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

    /** @var mixed date */
    protected $date;

    /**
     * dateのgetter
     *
     * @access public
     * @return mixed date
     */
    public function getDate() {
        return $this->date;
    }

    /**
     * dateのsetter
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
     * nameのgetter
     *
     * @access public
     * @return mixed name
     */
    public function getName() {
        return $this->name;
    }

    /**
     * nameのsetter
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
     * emailのgetter
     *
     * @access public
     * @return mixed email
     */
    public function getEmail() {
        return $this->email;
    }

    /**
     * emailのsetter
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
     * subjectのgetter
     *
     * @access public
     * @return mixed subject
     */
    public function getSubject() {
        return $this->subject;
    }

    /**
     * subjectのsetter
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
     * bodyのgetter
     *
     * @access public
     * @return mixed body
     */
    public function getBody() {
        return $this->body;
    }

    /**
     * bodyのsetter
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
     * passwordのgetter
     *
     * @access public
     * @return mixed password
     */
    public function getPassword() {
        return $this->password;
    }

    /**
     * passwordのsetter
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
     * hostのgetter
     *
     * @access public
     * @return mixed host
     */
    public function getHost() {
        return $this->host;
    }

    /**
     * hostのsetter
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