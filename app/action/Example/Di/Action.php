<?php
/**
 * Example/Di/Action.php
 *
 * @author Takuya Ookubo <sfio@sakura.ai.to>
 * @package S2ethna
 * @version SVN: $Id: Action.php 92 2007-10-28 15:09:59Z ookubo $
 */

/**
 * example_di_action�ե�����μ���
 *
 * @author Takuya Ookubo <sfio@sakura.ai.to>
 * @access public
 * @package S2ethna
 */
class S2ethna_Form_ExampleDiAction extends S2ethna_ActionForm
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
 * example_di_action���������μ���
 *
 * @author Takuya Ookubo <sfio@sakura.ai.to>
 * @access public
 * @package S2ethna
 */
class S2ethna_Action_ExampleDiAction extends S2ethna_ActionClass
{
    /**
     * example_di_action����������������
     *
     * @access public
     * @return string ����̾(���ｪλ�ʤ�null, ������λ�ʤ�false)
     */
    function prepare()
    {
        return null;
    }

    /**
     * example_di_action���������μ���
     *
     * @access public
     * @return string ����̾
     */
    function perform()
    {
        $this->af->setApp('message',$this->message);

        return 'example_di';
    }

    /*
     * ����ActionClass�����������Ȥ��ˡ�Ʊ̾��dicon�ե����뤬���Ȥ��졢
     * �ʲ��Υե�����ɤ˥��å������󥸥�������󤵤�ޤ���
     * �ܺ٤�S2Container.PHP5�Υ����Ȥ򻲾Ȥ��Ƥ���������
     */
    private $message;
    function setMessage($message) {
        $this->message = $message;
    }

}
?>
