<?php
/**
 *  Example/Bbs/Write/Do.php
 *
 *  @author     Takuya Ookubo <sfio@sakura.ai.to>
 *  @package    S2ethna
 *  @version    SVN: $Id: Do.php 91 2007-10-28 15:08:57Z ookubo $
 */

/**
 *  example_bbs_write_do�ե�����μ���
 *
 *  @author     Takuya Ookubo <sfio@sakura.ai.to>
 *  @access     public
 *  @package    S2ethna
 */
class S2ethna_Form_ExampleBbsWriteDo extends S2ethna_ActionForm
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
        'name' => array(
            // �ե���������
            'type'          => VAR_TYPE_STRING,    // �����ͷ�
            'form_type'     => FORM_TYPE_TEXT,  // �ե����෿
            'name'          => '��Ƽ�',      // ɽ��̾

            // �Х�ǡ���(���ҽ�˥Х�ǡ������¹Ԥ���ޤ�)
            'required'      => true,            // ɬ�ܥ��ץ����(true/false)
            'min'           => null,            // �Ǿ���
            'max'           => 20,            // ������
            'regexp'        => null,            // ʸ�������(����ɽ��)

            // �ե��륿
            'filter'        => null,            // �������Ѵ��ե��륿���ץ����
        ),
        'email' => array(
            // �ե���������
            'type'          => VAR_TYPE_STRING,    // �����ͷ�
            'form_type'     => FORM_TYPE_TEXT,  // �ե����෿
            'name'          => '�ť᡼��',      // ɽ��̾

            // �Х�ǡ���(���ҽ�˥Х�ǡ������¹Ԥ���ޤ�)
            'required'      => true,            // ɬ�ܥ��ץ����(true/false)
            'min'           => null,            // �Ǿ���
            'max'           => null,            // ������
            'regexp'        => null,            // ʸ�������(����ɽ��)
            'custom'        => 'checkMailaddress',

            // �ե��륿
            'filter'        => null,            // �������Ѵ��ե��륿���ץ����
        ),
        'subject' => array(
            // �ե���������
            'type'          => VAR_TYPE_STRING,    // �����ͷ�
            'form_type'     => FORM_TYPE_TEXT,  // �ե����෿
            'name'          => '��̾',      // ɽ��̾

            // �Х�ǡ���(���ҽ�˥Х�ǡ������¹Ԥ���ޤ�)
            'required'      => true,            // ɬ�ܥ��ץ����(true/false)
            'min'           => null,            // �Ǿ���
            'max'           => 50,            // ������
            'regexp'        => null,            // ʸ�������(����ɽ��)

            // �ե��륿
            'filter'        => null,            // �������Ѵ��ե��륿���ץ����
        ),
        'body' => array(
            // �ե���������
            'type'          => VAR_TYPE_STRING,    // �����ͷ�
            'form_type'     => FORM_TYPE_TEXTAREA,  // �ե����෿
            'name'          => '����',      // ɽ��̾

            // �Х�ǡ���(���ҽ�˥Х�ǡ������¹Ԥ���ޤ�)
            'required'      => true,            // ɬ�ܥ��ץ����(true/false)
            'min'           => null,            // �Ǿ���
            'max'           => null,            // ������
            'regexp'        => null,            // ʸ�������(����ɽ��)

            // �ե��륿
            'filter'        => null,            // �������Ѵ��ե��륿���ץ����
        ),
    );
}

/**
 *  example_bbs_write_do���������μ���
 *
 *  @author     Takuya Ookubo <sfio@sakura.ai.to>
 *  @access     public
 *  @package    S2ethna
 */
class S2ethna_Action_ExampleBbsWriteDo extends S2ethna_ActionClass
{
    /**
     *  example_bbs_write_do����������������
     *
     *  @access public
     *  @return string      ����̾(���ｪλ�ʤ�null, ������λ�ʤ�false)
     */
    function prepare()
    {
        if ($this->af->validate() > 0) {
            return 'example_bbs_list';
        }

        // ���POST�����å�
        if (Ethna_Util::isDuplicatePost()) {
            $this->ae->add(null, '¿��POST�Ǥ���');
            $this->af->clearFormVars();
            return 'example_bbs_list';
        }

        return null;
    }

    /**
     *  example_bbs_write_do���������μ���
     *
     *  @access public
     *  @return string  ����̾
     */
    function perform()
    {
        $name = $this->af->get('name');
        $email = $this->af->get('email');
        $subject = $this->af->get('subject');
        $body = $this->af->get('body');
        try {
            if ($this->config->get('demonstration') == false) {
                $result = $this->backend->getManager('ExampleBbs')->createArticle($name, $email, $subject, $body);
            }
        } catch (S2Ethna_Exception $e) {
            // ���顼
            $this->backend->getLogger()->log(LOG_DEBUG, 'Caught exception \'' . get_class($e) . '\' with message \'' . $e->getMessage() . '\' in ' . __METHOD__);
            $this->ae->addObject(null, $e->getObject());
        } catch (S2Container_S2RuntimeException $e) {
            // ��������
            $this->backend->getLogger()->log(LOG_DEBUG, 'Caught exception \'' . get_class($e) . '\' with message \'' . $e->getMessage() . '\' in ' . __METHOD__);
            $this->ae->add(null, '�����˼��Ԥ��ޤ�����');
        }

        $script = htmlspecialchars(basename($_SERVER['SCRIPT_NAME']), ENT_QUOTES);
        $this->af->setApp('redirect_url', "$script?action_example_bbs_list=true");
        return 'example_bbs_redirect';
    }
}
?>
