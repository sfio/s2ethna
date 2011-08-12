<?php
/**
 * S2ethna_ExampleDiManager.php
 *
 * @author Takuya Ookubo <sfio@sakura.ai.to>
 * @package S2ethna
 * @version SVN: $Id: S2ethna_ExampleDiManager.php 92 2007-10-28 15:09:59Z ookubo $
 */

/**
 * S2ethna_ExampleDiManager
 *
 * @author Takuya Ookubo <sfio@sakura.ai.to>
 * @access public
 * @package S2ethna
 */
class S2ethna_ExampleDiManager extends Ethna_AppManager
{
    function getMessage()
    {
        return $this->message;
    }

    /*
     * ����AppManager�����������Ȥ��ˡ�Ʊ̾��dicon�ե����뤬���Ȥ��졢
     * �ʲ��Υե�����ɤ˥��å������󥸥�������󤵤�ޤ���
     * �ܺ٤�S2Container.PHP5�Υ����Ȥ򻲾Ȥ��Ƥ���������
     */
    private $message;
    function setMessage($message) {
        $this->message = $message;
    }

}
?>
