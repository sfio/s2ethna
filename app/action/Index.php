<?php
/**
 * Index.php
 *
 * @author Takuya Ookubo <sfio@sakura.ai.to>
 * @package S2ethna
 * @version SVN: $Id: Index.php 27 2007-09-09 04:53:30Z ookubo $
 */

/**
 * indexフォームの実装
 *
 * @author Takuya Ookubo <sfio@sakura.ai.to>
 * @access public
 * @package S2ethna
 */

class S2ethna_Form_Index extends S2ethna_ActionForm
{
    /** @var bool バリデータにプラグインを使うフラグ */
    var $use_validator_plugin = false;

    /**
     * @access private
     * @var array フォーム値定義
     */
     var $form = array(
       /*
        * TODO: このアクションが使用するフォームを記述してください
        *
        * 記述例(typeを除く全ての要素は省略可能)：
        *
        * 'sample' => array(
        * // フォームの定義
        *     'type'        => VAR_TYPE_INT,        // 入力値型
        *     'form_type'   => FORM_TYPE_TEXT,      // フォーム型
        *     'name'        => 'サンプル',          // 表示名
        *
        * // バリデータ(記述順にバリデータが実行されます)
        *     'required'    => true,                        // 必須オプション(true/false)
        *     'min'         => null,                        // 最小値
        *     'max'         => null,                        // 最大値
        *     'regexp'      => null,                        // 文字種指定(正規表現)
        *
        * // フィルタ
        *     'filter'      => null,                        // 入力値変換フィルタオプション
        * ),
        */
      );
}

/**
 * indexアクションの実装
 *
 * @author Takuya Ookubo <sfio@sakura.ai.to>
 * @access public
 * @package S2ethna
 */
class S2ethna_Action_Index extends S2ethna_ActionClass
{
        /**
         * indexアクションの前処理
         *
         * @access public
         * @return string Forward先(正常終了ならnull)
         */
        function prepare()
        {
                return null;
        }

        /**
         * indexアクションの実装
         *
         * @access public
         * @return string 遷移名
         */
        function perform()
        {
                return 'index';
        }
}
?>
