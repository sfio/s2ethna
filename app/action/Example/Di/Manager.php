<?php
/**
 * Example/Di/Manager.php
 *
 * @author Takuya Ookubo <sfio@sakura.ai.to>
 * @package S2ethna
 * @version SVN: $Id: Manager.php 22 2007-09-09 04:50:23Z ookubo $
 */

/**
 * example_di_manager�ե�����μ���
 *
 * @author Takuya Ookubo <sfio@sakura.ai.to>
 * @access public
 * @package S2ethna
 */
class S2ethna_Form_ExampleDiManager extends S2ethna_ActionForm
{
    /** @var bool �Х�ǡ����˥ץ饰�����Ȥ��ե饰 */
    var $use_validator_plugin = true;

    /**
     * @access private
     * @var array �ե����������
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
 * example_di_manager���������μ���
 *
 * @author Takuya Ookubo <sfio@sakura.ai.to>
 * @access public
 * @package S2ethna
 */
class S2ethna_Action_ExampleDiManager extends S2ethna_ActionClass
{
    /**
     * example_di_manager����������������
     *
     * @access public
     * @return string ����̾(���ｪλ�ʤ�null, ������λ�ʤ�false)
     */
    function prepare()
    {
        return null;
    }

    /**
     * example_di_manager���������μ���
     *
     * @access public
     * @return string ����̾
     */
    function perform()
    {
        $messaget = $this->backend->getManager('ExampleDi')->getMessage();
        $this->af->setApp('message',$messaget);

        return 'example_di';
    }
}
?>
