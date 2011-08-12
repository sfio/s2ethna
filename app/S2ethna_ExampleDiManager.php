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
     * このAppManagerが生成されるときに、同名のdiconファイルが参照され、
     * 以下のフィールドにセッターインジェクションされます。
     * 詳細はS2Container.PHP5のサイトを参照してください。
     */
    private $message;
    function setMessage($message) {
        $this->message = $message;
    }

}
?>
