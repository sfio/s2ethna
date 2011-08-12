<?php
/**
 *  Example/Bbs/List.php
 *
 *  @author     Takuya Ookubo <sfio@sakura.ai.to>
 *  @package    S2ethna
 *  @version    SVN: $Id: List.php 42 2007-09-12 15:10:24Z ookubo $
 */

/**
 *  example_bbs_list�ե�����μ���
 *
 *  @author     Takuya Ookubo <sfio@sakura.ai.to>
 *  @access     public
 *  @package    S2ethna
 */
class S2ethna_Form_ExampleBbsList extends S2ethna_ActionForm
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
        'page' => array(
            // �ե���������
            'type'          => VAR_TYPE_INT,    // �����ͷ�
            'form_type'     => FORM_TYPE_HIDDEN,  // �ե����෿
            'name'          => '�ڡ���',      // ɽ��̾

            // �Х�ǡ���(���ҽ�˥Х�ǡ������¹Ԥ���ޤ�)
            'required'      => false,            // ɬ�ܥ��ץ����(true/false)
            'min'           => 1,            // �Ǿ���
            'max'           => null,            // ������
            'regexp'        => '/[0-9]*/',            // ʸ�������(����ɽ��)

            // �ե��륿
            'filter'        => null,            // �������Ѵ��ե��륿���ץ����
        ),
    );
}

/**
 *  example_bbs_list���������μ���
 *
 *  @author     Takuya Ookubo <sfio@sakura.ai.to>
 *  @access     public
 *  @package    S2ethna
 */
class S2ethna_Action_ExampleBbsList extends S2ethna_ActionClass
{
    /**
     *  example_bbs_list����������������
     *
     *  @access public
     *  @return string      ����̾(���ｪλ�ʤ�null, ������λ�ʤ�false)
     */
    function prepare()
    {
        if ($this->af->validate() > 0) {
            return 'example';
        }

        return null;
    }

    /**
     *  example_bbs_list���������μ���
     *
     *  @access public
     *  @return string  ����̾
     */
    function perform()
    {
        return 'example_bbs_list';
    }
}
?>
