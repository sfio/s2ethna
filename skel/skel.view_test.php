<?php
/**
 *  {$view_path}
 *
 *  @author     {$author}
 *  @package    S2ethna
 *  @version    $Id: skel.view_test.php,v 1.2 2006/03/23 13:16:37 fujimoto Exp $
 */

/**
 *  {$forward_name}�ӥ塼�μ���
 *
 *  @author     {$author}
 *  @access     public
 *  @package    S2ethna
 */
class {$view_class}_TestCase extends Ethna_UnitTestCase
{
    /**
     *  @access private
     *  @var    string  �ӥ塼̾
     */
    var $forward_name = '{$forward_name}';

    /**
     *    �ƥ��Ȥν����
     *
     *    @access public
     */
    function setUp()
    {
        $this->createPlainActionForm(); // ���������ե�����κ���
        $this->createViewClass();       // �ӥ塼�κ���
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
     *  {$forward_name}�����������Υ���ץ�ƥ��ȥ�����
     *
     *  @access public
     */
    /*
    function test_viewSample()
    {
        // �ե����������
        $this->af->set('id', 1);

        // {$forward_name}����������
        $this->vc->preforward();
        $this->assertNull($this->af->get('data'));
    }
    */
}
?>
