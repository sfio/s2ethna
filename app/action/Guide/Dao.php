<?php
/**
 *  Guide/Dao.php
 *
 *  @author     Takuya Ookubo <sfio@sakura.ai.to>
 *  @package    S2ethna
 *  @version    SVN: $Id: skel.action.php,v 1.10 2006/11/06 14:31:24 cocoitiban Exp $
 */

/**
 *  guide_dao�ե�����μ���
 *
 *  @author     Takuya Ookubo <sfio@sakura.ai.to>
 *  @access     public
 *  @package    S2ethna
 */
class S2ethna_Form_GuideDao extends S2ethna_ActionForm
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
 *  guide_dao���������μ���
 *
 *  @author     Takuya Ookubo <sfio@sakura.ai.to>
 *  @access     public
 *  @package    S2ethna
 */
class S2ethna_Action_GuideDao extends S2ethna_ActionClass
{
    /**
     *  guide_dao����������������
     *
     *  @access public
     *  @return string      ����̾(���ｪλ�ʤ�null, ������λ�ʤ�false)
     */
    function prepare()
    {
        return null;
    }

    /**
     *  guide_dao���������μ���
     *
     *  @access public
     *  @return string  ����̾
     */
    function perform()
    {
        return 'guide_dao';
    }
}
?>
