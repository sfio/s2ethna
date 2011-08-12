<?php
/**
 *  S2ethna_ExampleDaoManager.php
 *
 *  @author     Takuya Ookubo <sfio@sakura.ai.to>
 *  @package    S2ethna
 *  @version    $Id: skel.app_manager.php 387 2006-11-06 14:31:24Z cocoitiban $
 */

/**
 *  S2ethna_ExampleDaoManager
 *
 *  @author     Takuya Ookubo <sfio@sakura.ai.to>
 *  @access     public
 *  @package    S2ethna
 */
class S2ethna_ExampleDaoManager extends Ethna_AppManager
{
    function getCdList()
    {
        return $this->dao->readCdList();
    }

    /*
     * ����AppManager�����������Ȥ��ˡ�Ʊ̾��dicon�ե����뤬���Ȥ��졢
     * �ʲ��Υե�����ɤ˥��å������󥸥�������󤵤�ޤ���
     * �ܺ٤�S2Container.PHP5�Υ����Ȥ򻲾Ȥ��Ƥ���������
     */
    private $dao;
    function setCdDao(CdDao $dao) {
        $this->dao = $dao;
    }
}
?>
