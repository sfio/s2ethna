<?php
/**
 *  {$action_path}
 *
 *  @author     {$author}
 *  @package    S2ethna
 *  @version    $Id: skel.action_test.php,v 1.2 2006/03/23 13:16:37 fujimoto Exp $
 */

/**
 *  {$action_name}�ե�����Υƥ��ȥ�����
 *
 *  @author     {$author}
 *  @access     public
 *  @package    S2ethna
 */
class {$action_form}_TestCase extends Ethna_UnitTestCase
{
    /**
     *  @access private
     *  @var    string  ���������̾
     */
    var $action_name = '{$action_name}';

    /**
     *    �ƥ��Ȥν����
     *
     *    @access public
     */
    function setUp()
    {
        $this->createActionForm();  // ���������ե�����κ���
    }

    /**
     *    �ƥ��Ȥθ����
     *
     *    @access public
     */
    function tearDown()
    {
    }

    /**
     *  {$action_name}���������ե�����Υ���ץ�ƥ��ȥ�����
     *
     *  @access public
     */
    /*
    function test_formSample()
    {
        // �ե����������
        $this->af->set('id', 1);

        // {$action_name}���������ե������͸���
        $this->assertEqual($this->af->validate(), 0);
    }
    */
}

/**
 *  {$action_name}���������Υƥ��ȥ�����
 *
 *  @author     {$author}
 *  @access     public
 *  @package    S2ethna
 */
class {$action_class}_TestCase extends Ethna_UnitTestCase
{
    /**
     *  @access private
     *  @var    string  ���������̾
     */
    var $action_name = '{$action_name}';

    /**
     *    �ƥ��Ȥν����
     *
     *    @access public
     */
    function setUp()
    {
        $this->createActionForm();  // ���������ե�����κ���
        $this->createActionClass(); // ��������󥯥饹�κ���

        $this->session->start();            // ���å����γ���
    }

    /**
     *    �ƥ��Ȥθ����
     *
     *    @access public
     */
    function tearDown()
    {
        $this->session->destroy();      // ���å������˴�
    }

    /**
     *  {$action_name}��������󥯥饹�Υ���ץ�ƥ��ȥ�����
     *
     *  @access public
     */
    /*
    function test_actionSample()
    {
        // �ե����������
        $this->af->set('id', 1);

        // {$action_name}���������¹�����ǧ�ڽ���
        $forward_name = $this->ac->authenticate();
        $this->assertNull($forward_name);

        // {$action_name}����������������
        $forward_name = $this->ac->prepare();
        $this->assertNull($forward_name);

        // {$action_name}���������μ���
        $forward_name = $this->ac->perform();
        $this->assertEqual($forward_name, '{$action_name}');
    }
    */
}
?>
