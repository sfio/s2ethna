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
 * ���������ե����९�饹
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

    /** @var array �ե����������(�ǥե����) */
    var $form_template = array();

    /** @var bool �Х�ǡ����˥ץ饰�����Ȥ��ե饰 */
    var $use_validator_plugin = true;

    /**#@-*/

    /**
     * �ե������͸��ڤΥ��顼������Ԥ�
     *
     * @access public
     * @param string $name �ե��������̾
     * @param int $code ���顼������
     */
    function handleError($name, $code)
    {
        return parent::handleError($name, $code);
    }

    /**
     * �ե�����������ƥ�ץ졼�Ȥ����ꤹ��
     *
     * @access protected
     * @param array $form_template �ե������ͥƥ�ץ졼��
     * @return array �ե������ͥƥ�ץ졼��
     */
    function _setFormTemplate($form_template)
    {
        return parent::_setFormTemplate($form_template);
    }

    /**
     * �ե���������������ꤹ��
     *
     * @access protected
     */
    function _setFormDef()
    {
        return parent::_setFormDef();
    }

// ����������S2Ethna�б�
    /**
     * �ե����������ˤ����֤�
     *
     * @access private
     * @param array &$vars �ե�����(��)������
     * @param array &$retval ����ؤ��Ѵ����
     * @param bool $escape HTML���������ץե饰(true:���������פ���)
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
// �������ޤ�S2Ethna�б�

}
// }}}
?>
