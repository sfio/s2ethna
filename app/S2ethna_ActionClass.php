<?php
// vim: foldmethod=marker
/**
 * S2ethna_ActionClass.php
 *
 * @author Takuya Ookubo <sfio@sakura.ai.to>
 * @package S2ethna
 * @version SVN: $Id: S2ethna_ActionClass.php 91 2007-10-28 15:08:57Z ookubo $
 */

// {{{ S2ethna_ActionClass
/**
 * action実行クラス
 *
 * @author Takuya Ookubo <sfio@sakura.ai.to>
 * @package S2ethna
 * @access public
 */
class S2ethna_ActionClass extends Ethna_ActionClass
{
    /**
     * アクション実行前の認証処理を行う
     *
     * @access public
     * @return string 遷移名(nullなら正常終了, falseなら処理終了)
     */
    function authenticate()
    {
        if ($this->config->get('maintenance')) {
            return 'maintenance';
        }
        return parent::authenticate();
    }

    /**
     * アクション実行前の処理(フォーム値チェック等)を行う
     *
     * @access public
     * @return string 遷移名(nullなら正常終了, falseなら処理終了)
     */
    function prepare()
    {
        return parent::prepare();
    }

    /**
     * アクション実行
     *
     * @access public
     * @return string 遷移名(nullなら遷移は行わない)
     */
    function perform()
    {
        return parent::perform();
    }
}
// }}}
?>
