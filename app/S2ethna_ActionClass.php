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
 * action�¹ԥ��饹
 *
 * @author Takuya Ookubo <sfio@sakura.ai.to>
 * @package S2ethna
 * @access public
 */
class S2ethna_ActionClass extends Ethna_ActionClass
{
    /**
     * ���������¹�����ǧ�ڽ�����Ԥ�
     *
     * @access public
     * @return string ����̾(null�ʤ����ｪλ, false�ʤ������λ)
     */
    function authenticate()
    {
        if ($this->config->get('maintenance')) {
            return 'maintenance';
        }
        return parent::authenticate();
    }

    /**
     * ���������¹����ν���(�ե������ͥ����å���)��Ԥ�
     *
     * @access public
     * @return string ����̾(null�ʤ����ｪλ, false�ʤ������λ)
     */
    function prepare()
    {
        return parent::prepare();
    }

    /**
     * ���������¹�
     *
     * @access public
     * @return string ����̾(null�ʤ����ܤϹԤ�ʤ�)
     */
    function perform()
    {
        return parent::perform();
    }
}
// }}}
?>
