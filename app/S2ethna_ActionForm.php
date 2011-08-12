<?php
// vim: foldmethod=marker
/**
 * S2ethna_ActionForm.php
 *
 * @author Takuya Ookubo <sfio@sakura.ai.to>
 * @package S2ethna
 * @version SVN: $Id: S2ethna_ActionForm.php 19 2007-09-09 04:46:23Z ookubo $
 */

// {{{ S2ethna_ActionForm
/**
 * アクションフォームクラス
 *
 * @author Takuya Ookubo <sfio@sakura.ai.to>
 * @package S2ethna
 * @access public
 */
class S2ethna_ActionForm extends Ethna_ActionForm
{
    /**#@+
     * @access private
     */

    /** @var array フォーム値定義(デフォルト) */
    var $form_template = array();

    /** @var bool バリデータにプラグインを使うフラグ */
    var $use_validator_plugin = true;

    /**#@-*/

    /**
     * フォーム値検証のエラー処理を行う
     *
     * @access public
     * @param string $name フォーム項目名
     * @param int $code エラーコード
     */
    function handleError($name, $code)
    {
        return parent::handleError($name, $code);
    }

    /**
     * フォーム値定義テンプレートを設定する
     *
     * @access protected
     * @param array $form_template フォーム値テンプレート
     * @return array フォーム値テンプレート
     */
    function _setFormTemplate($form_template)
    {
        return parent::_setFormTemplate($form_template);
    }

    /**
     * フォーム値定義を設定する
     *
     * @access protected
     */
    function _setFormDef()
    {
        return parent::_setFormDef();
    }

// ↓ここからS2Ethna対応
    /**
     * フォームを配列にして返す
     *
     * @access private
     * @param array &$vars フォーム(等)の配列
     * @param array &$retval 配列への変換結果
     * @param bool $escape HTMLエスケープフラグ(true:エスケープする)
     */
    function _getArray(&$vars, &$retval, $escape)
    {
        foreach (array_keys($vars) as $name) {
            if (is_array($vars[$name])) {
                $retval[$name] = array();
                $this->_getArray($vars[$name], $retval[$name], $escape);
            } elseif (method_exists($vars[$name], 'toArray')) {
                $retval[$name] = array();
                $this->_getArray($vars[$name]->toArray(), $retval[$name], $escape);
            } else {
                $retval[$name] = $escape
                    ? htmlspecialchars($vars[$name], ENT_QUOTES) : $vars[$name];
            }
        }
    }
// ↑ここまでS2Ethna対応

}
// }}}
?>
