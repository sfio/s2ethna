<?php
/**
 *  Example/Bbs/List.php
 *
 *  @author     Takuya Ookubo <sfio@sakura.ai.to>
 *  @package    S2ethna
 *  @version    SVN: $Id: List.php 91 2007-10-28 15:08:57Z ookubo $
 */

/**
 *  example_bbs_listビューの実装
 *
 *  @author     Takuya Ookubo <sfio@sakura.ai.to>
 *  @access     public
 *  @package    S2ethna
 */
class S2ethna_View_ExampleBbsList extends S2ethna_ViewClass
{
    /**
     *  遷移前処理
     *
     *  @access public
     */
    function preforward()
    {
        $page = $this->config->get('demonstration')
            ? $this->config->get('demonstration_page') : $this->af->get('page');
        $pager = S2Ethna_PagerCondition::create($page, 10);
        $result = $this->backend->getManager('ExampleBbs')->getArticleList($pager);
        $this->af->setApp('articles', $result);
        $this->af->setApp('pager', $pager);
    }
}
?>
