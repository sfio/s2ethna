<?php
/**
 *  Example/Bbs/Redirect.php
 *
 *  @author     Takuya Ookubo <sfio@sakura.ai.to>
 *  @package    S2ethna
 *  @version    SVN: $Id: Redirect.php 42 2007-09-12 15:10:24Z ookubo $
 */

/**
 *  example_bbs_redirectビューの実装
 *
 *  @author     Takuya Ookubo <sfio@sakura.ai.to>
 *  @access     public
 *  @package    S2ethna
 */
class S2ethna_View_ExampleBbsRedirect extends S2ethna_ViewClass
{
    /**
     *  遷移前処理
     *
     *  @access public
     */
    function preforward()
    {
        if (!headers_sent()) {
            @ob_end_clean();
            header('Location: ' . $this->af->getApp('redirect_url'));
        }
    }
}
?>
