<?php
/**
 * Index.php
 *
 * @author Takuya Ookubo <sfio@sakura.ai.to>
 * @package S2ethna
 * @version SVN: $Id: Index.php 27 2007-09-09 04:53:30Z ookubo $
 */

/**
 * index�ե�����μ���
 *
 * @author Takuya Ookubo <sfio@sakura.ai.to>
 * @access public
 * @package S2ethna
 */

class S2ethna_Form_Index extends S2ethna_ActionForm
{
    /** @var bool �Х�ǡ����˥ץ饰�����Ȥ��ե饰 */
    var $use_validator_plugin = false;

    /**
     * @access private
     * @var array �ե����������
     */
     var $form = array(
       /*
        * TODO: ���Υ�������󤬻��Ѥ���ե�����򵭽Ҥ��Ƥ�������
        *
        * ������(type��������Ƥ����ǤϾ�ά��ǽ)��
        *
        * 'sample' => array(
        * // �ե���������
        *     'type'        => VAR_TYPE_INT,        // �����ͷ�
        *     'form_type'   => FORM_TYPE_TEXT,      // �ե����෿
        *     'name'        => '����ץ�',          // ɽ��̾
        *
        * // �Х�ǡ���(���ҽ�˥Х�ǡ������¹Ԥ���ޤ�)
        *     'required'    => true,                        // ɬ�ܥ��ץ����(true/false)
        *     'min'         => null,                        // �Ǿ���
        *     'max'         => null,                        // ������
        *     'regexp'      => null,                        // ʸ�������(����ɽ��)
        *
        * // �ե��륿
        *     'filter'      => null,                        // �������Ѵ��ե��륿���ץ����
        * ),
        */
      );
}

/**
 * index���������μ���
 *
 * @author Takuya Ookubo <sfio@sakura.ai.to>
 * @access public
 * @package S2ethna
 */
class S2ethna_Action_Index extends S2ethna_ActionClass
{
        /**
         * index����������������
         *
         * @access public
         * @return string Forward��(���ｪλ�ʤ�null)
         */
        function prepare()
        {
                return null;
        }

        /**
         * index���������μ���
         *
         * @access public
         * @return string ����̾
         */
        function perform()
        {
                return 'index';
        }
}
?>
