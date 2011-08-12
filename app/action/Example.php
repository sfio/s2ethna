<?php
/**
 *  Example.php
 *
 *  @author     Takuya Ookubo <sfio@sakura.ai.to>
 *  @package    S2ethna
 *  @version    SVN: $Id: Example.php 22 2007-09-09 04:50:23Z ookubo $
 */

/**
 *  example�ե�����μ���
 *
 *  @author     Takuya Ookubo <sfio@sakura.ai.to>
 *  @access     public
 *  @package    S2ethna
 */
class S2ethna_Form_Example extends S2ethna_ActionForm
{
    /** @var    bool    �Х�ǡ����˥ץ饰�����Ȥ��ե饰 */
    var $use_validator_plugin = true;

    /**
     *  @access private
     *  @var    array   �ե����������
     */
    var $form = array(
        /*
        'sample' => array(
            // �ե���������
            'type'          => VAR_TYPE_INT,    // �����ͷ�
            'form_type'     => FORM_TYPE_TEXT,  // �ե����෿
            'name'          => '����ץ�',      // ɽ��̾

            // �Х�ǡ���(���ҽ�˥Х�ǡ������¹Ԥ���ޤ�)
            'required'      => true,            // ɬ�ܥ��ץ����(true/false)
            'min'           => null,            // �Ǿ���
            'max'           => null,            // ������
            'regexp'        => null,            // ʸ�������(����ɽ��)

            // �ե��륿
            'filter'        => null,            // �������Ѵ��ե��륿���ץ����
        ),
        */
    );
}

/**
 *  example���������μ���
 *
 *  @author     Takuya Ookubo <sfio@sakura.ai.to>
 *  @access     public
 *  @package    S2ethna
 */
class S2ethna_Action_Example extends S2ethna_ActionClass
{
    /**
     *  example����������������
     *
     *  @access public
     *  @return string      ����̾(���ｪλ�ʤ�null, ������λ�ʤ�false)
     */
    function prepare()
    {
        return null;
    }

    /**
     *  example���������μ���
     *
     *  @access public
     *  @return string  ����̾
     */
    function perform()
    {
        return 'example';
    }
}
?>