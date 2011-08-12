<?php
/**
 *  {$view_path}
 *
 *  @author     {$author}
 *  @package    S2ethna
 *  @version    $Id: skel.view_test.php,v 1.2 2006/03/23 13:16:37 fujimoto Exp $
 */

/**
 *  {$forward_name}ビューの実装
 *
 *  @author     {$author}
 *  @access     public
 *  @package    S2ethna
 */
class {$view_class}_TestCase extends Ethna_UnitTestCase
{
    /**
     *  @access private
     *  @var    string  ビュー名
     */
    var $forward_name = '{$forward_name}';

    /**
     *    テストの初期化
     *
     *    @access public
     */
    function setUp()
    {
        $this->createPlainActionForm(); // アクションフォームの作成
        $this->createViewClass();       // ビューの作成
    }

    /**
     *    テストの後始末
     *
     *    @access public
     */
    function tearDown()
    {
    }

    /**
     *  {$forward_name}遷移前処理のサンプルテストケース
     *
     *  @access public
     */
    /*
    function test_viewSample()
    {
        // フォームの設定
        $this->af->set('id', 1);

        // {$forward_name}遷移前処理
        $this->vc->preforward();
        $this->assertNull($this->af->get('data'));
    }
    */
}
?>
