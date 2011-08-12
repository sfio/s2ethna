<?php
/**
 * Example/Di/Manager.php
 *
 * @author Takuya Ookubo <sfio@sakura.ai.to>
 * @package S2ethna
 * @version SVN: $Id: Manager.php 22 2007-09-09 04:50:23Z ookubo $
 */

/**
 * example_di_managerフォームの実装
 *
 * @author Takuya Ookubo <sfio@sakura.ai.to>
 * @access public
 * @package S2ethna
 */
class S2ethna_Form_ExampleDiManager extends S2ethna_ActionForm
{
    /** @var bool バリデータにプラグインを使うフラグ */
    var $use_validator_plugin = true;

    /**
     * @access private
     * @var array フォーム値定義
     */
    var $form = array(
        /*
        'sample' => array(
            // フォームの定義
            'type'          => VAR_TYPE_INT,    // 入力値型
            'form_type'     => FORM_TYPE_TEXT,  // フォーム型
            'name'          => 'サンプル',      // 表示名

            // バリデータ(記述順にバリデータが実行されます)
            'required'      => true,            // 必須オプション(true/false)
            'min'           => null,            // 最小値
            'max'           => null,            // 最大値
            'regexp'        => null,            // 文字種指定(正規表現)

            // フィルタ
            'filter'        => null,            // 入力値変換フィルタオプション
        ),
        */
    );
}

/**
 * example_di_managerアクションの実装
 *
 * @author Takuya Ookubo <sfio@sakura.ai.to>
 * @access public
 * @package S2ethna
 */
class S2ethna_Action_ExampleDiManager extends S2ethna_ActionClass
{
    /**
     * example_di_managerアクションの前処理
     *
     * @access public
     * @return string 遷移名(正常終了ならnull, 処理終了ならfalse)
     */
    function prepare()
    {
        return null;
    }

    /**
     * example_di_managerアクションの実装
     *
     * @access public
     * @return string 遷移名
     */
    function perform()
    {
        $messaget = $this->backend->getManager('ExampleDi')->getMessage();
        $this->af->setApp('message',$messaget);

        return 'example_di';
    }
}
?>
