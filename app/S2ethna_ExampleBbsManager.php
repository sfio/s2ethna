<?php
/**
 *  S2ethna_ExampleBbsManager.php
 *
 *  @author     Takuya Ookubo <sfio@sakura.ai.to>
 *  @package    S2ethna
 *  @version    $Id: S2ethna_ExampleBbsManager.php 42 2007-09-12 15:10:24Z ookubo $
 */

/**
 *  IS2ethna_ExampleBbsManager
 *
 *  @author     Takuya Ookubo <sfio@sakura.ai.to>
 *  @access     public
 *  @package    S2ethna
 */
interface IS2ethna_ExampleBbsManager
{
    /**
     *  createArticle
     *
     *  @param string $name ��Ƽ�
     *  @param string $email �ť᡼��
     *  @param string $subject ��̾
     *  @param string $body ����
     *  @access public
     */
    public function createArticle($name, $email, $subject, $body);
}

/**
 *  S2ethna_ExampleBbsManager
 *
 *  @author     Takuya Ookubo <sfio@sakura.ai.to>
 *  @access     public
 *  @package    S2ethna
 */
class S2ethna_ExampleBbsManager
    extends Ethna_AppManager implements IS2ethna_ExampleBbsManager
{
    /** BbsDao */
    protected $BbsDao;

    /**
     *  BbsDao�Υ��å���
     *
     *  @param BbsDao
     *  @access public
     */
    public function setBbsDao(BbsDao $BbsDao)
    {
        $this->BbsDao = $BbsDao;
    }

    /**
     *  createArticle
     *
     *  @param string $name ��Ƽ�
     *  @param string $email �ť᡼��
     *  @param string $subject ��̾
     *  @param string $body ����
     *  @access public
     *  @exception S2Container_S2RuntimeException ��������
     */
    public function createArticle($name, $email, $subject, $body)
    {
        $bbsBean = new BbsBean();
        $bbsBean->setName($name);
        $bbsBean->setEmail($email);
        $bbsBean->setSubject($subject);
        $bbsBean->setBody($body);
        $bbsBean->setHost($_SERVER['REMOTE_ADDR']);
        $rows = $this->BbsDao->createBbs($bbsBean);
        if ($rows != 1) {
            throw new S2Container_S2RuntimeException(get_class($this), $rows);
        }
    }

    /**
     *  getArticleList
     *
     *  @param S2Ethna_PagerCondition $pager �ڡ�����
     *  @access public
     */
    public function getArticleList($pager)
    {
        return $this->BbsDao->readBbsList($pager);
    }

}
?>
