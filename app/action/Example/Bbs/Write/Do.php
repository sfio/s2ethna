<?php
/**
 *  Example/Bbs/Write/Do.php
 *
 *  @author     Takuya Ookubo <sfio@sakura.ai.to>
 *  @package    S2ethna
 *  @version    SVN: $Id: Do.php 91 2007-10-28 15:08:57Z ookubo $
 */

/**
 *  example_bbs_write_doフォームの実装
 *
 *  @author     Takuya Ookubo <sfio@sakura.ai.to>
 *  @access     public
 *  @package    S2ethna
 */
class S2ethna_Form_ExampleBbsWriteDo extends S2ethna_ActionForm
{
    /** @var    bool    バリデータにプラグインを使うフラグ */
    var $use_validator_plugin = true;

    /**
     *  @access private
     *  @var    array   フォーム値定義
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
        'name' => array(
            // フォームの定義
            'type'          => VAR_TYPE_STRING,    // 入力値型
            'form_type'     => FORM_TYPE_TEXT,  // フォーム型
            'name'          => '投稿者',      // 表示名

            // バリデータ(記述順にバリデータが実行されます)
            'required'      => true,            // 必須オプション(true/false)
            'min'           => null,            // 最小値
            'max'           => 20,            // 最大値
            'regexp'        => null,            // 文字種指定(正規表現)

            // フィルタ
            'filter'        => null,            // 入力値変換フィルタオプション
        ),
        'email' => array(
            // フォームの定義
            'type'          => VAR_TYPE_STRING,    // 入力値型
            'form_type'     => FORM_TYPE_TEXT,  // フォーム型
            'name'          => 'Ｅメール',      // 表示名

            // バリデータ(記述順にバリデータが実行されます)
            'required'      => true,            // 必須オプション(true/false)
            'min'           => null,            // 最小値
            'max'           => null,            // 最大値
            'regexp'        => null,            // 文字種指定(正規表現)
            'custom'        => 'checkMailaddress',

            // フィルタ
            'filter'        => null,            // 入力値変換フィルタオプション
        ),
        'subject' => array(
            // フォームの定義
            'type'          => VAR_TYPE_STRING,    // 入力値型
            'form_type'     => FORM_TYPE_TEXT,  // フォーム型
            'name'          => '題名',      // 表示名

            // バリデータ(記述順にバリデータが実行されます)
            'required'      => true,            // 必須オプション(true/false)
            'min'           => null,            // 最小値
            'max'           => 50,            // 最大値
            'regexp'        => null,            // 文字種指定(正規表現)

            // フィルタ
            'filter'        => null,            // 入力値変換フィルタオプション
        ),
        'body' => array(
            // フォームの定義
            'type'          => VAR_TYPE_STRING,    // 入力値型
            'form_type'     => FORM_TYPE_TEXTAREA,  // フォーム型
            'name'          => '内容',      // 表示名

            // バリデータ(記述順にバリデータが実行されます)
            'required'      => true,            // 必須オプション(true/false)
            'min'           => null,            // 最小値
            'max'           => null,            // 最大値
            'regexp'        => null,            // 文字種指定(正規表現)

            // フィルタ
            'filter'        => null,            // 入力値変換フィルタオプション
        ),
    );
}

/**
 *  example_bbs_write_doアクションの実装
 *
 *  @author     Takuya Ookubo <sfio@sakura.ai.to>
 *  @access     public
 *  @package    S2ethna
 */
class S2ethna_Action_ExampleBbsWriteDo extends S2ethna_ActionClass
{
    /**
     *  example_bbs_write_doアクションの前処理
     *
     *  @access public
     *  @return string      遷移名(正常終了ならnull, 処理終了ならfalse)
     */
    function prepare()
    {
        if ($this->af->validate() > 0) {
            return 'example_bbs_list';
        }

        // 二重POSTチェック
        if (Ethna_Util::isDuplicatePost()) {
            $this->ae->add(null, '多重POSTです。');
            $this->af->clearFormVars();
            return 'example_bbs_list';
        }

        return null;
    }

    /**
     *  example_bbs_write_doアクションの実装
     *
     *  @access public
     *  @return string  遷移名
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
            // エラー
            $this->backend->getLogger()->log(LOG_DEBUG, 'Caught exception \'' . get_class($e) . '\' with message \'' . $e->getMessage() . '\' in ' . __METHOD__);
            $this->ae->addObject(null, $e->getObject());
        } catch (S2Container_S2RuntimeException $e) {
            // 更新失敗
            $this->backend->getLogger()->log(LOG_DEBUG, 'Caught exception \'' . get_class($e) . '\' with message \'' . $e->getMessage() . '\' in ' . __METHOD__);
            $this->ae->add(null, '更新に失敗しました。');
        }

        $script = htmlspecialchars(basename($_SERVER['SCRIPT_NAME']), ENT_QUOTES);
        $this->af->setApp('redirect_url', "$script?action_example_bbs_list=true");
        return 'example_bbs_redirect';
    }
}
?>
