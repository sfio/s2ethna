<?php
/**
 * Utility/Db/Import/Bean.php
 *
 * @author Takuya Ookubo <sfio@sakura.ai.to>
 * @package S2ethna
 * @version SVN: $Id: Bean.php 91 2007-10-28 15:08:57Z ookubo $
 */

require_once('Form.php');

/**
 * utility_db_import_beanフォームの実装
 *
 * @author Takuya Ookubo <sfio@sakura.ai.to>
 * @access public
 * @package S2ethna
 */
class S2ethna_Form_UtilityDbImportBean extends S2ethna_Form_UtilityDbImportForm
{
    /**
     * コンストラクタ
     *
     * @access public
     */
    function __construct(&$controller)
    {
        parent::__construct($controller);

        // formをrequiredに
        $this->form['table']['required'] = true;
    }
}

/**
 * utility_db_import_beanアクションの実装
 *
 * @author Takuya Ookubo <sfio@sakura.ai.to>
 * @access public
 * @package S2ethna
 */
class S2ethna_Action_UtilityDbImportBean extends S2ethna_ActionClass
{
    /**
     * utility_db_import_beanアクションの前処理
     *
     * @access public
     * @return string 遷移名(正常終了ならnull, 処理終了ならfalse)
     */
    function prepare()
    {
        if ($this->af->validate() > 0) {
            return 'utility_db_import_form';
        }

        $dsn = $this->config->get('demonstration')
            ? $this->config->get('demonstration_dsn') : $this->af->get('dsn');
        $result =& $this->backend->getManager('Utility')->getDB($dsn);
        if (Ethna::isError($result)) {
            $this->ae->addObject(null, $result);
            return 'utility_db_import_form';
        }

        return null;
    }

    /**
     * utility_db_import_beanアクションの実装
     *
     * @access public
     * @return string 遷移名
     */
    function perform()
    {
        $filename = $this->backend->getManager('Utility')->getFilename($this->af->get('table'), 'Bean');
        $this->af->setApp('filename', $filename);

        $content = $this->backend->getManager('Utility')->createBean($this->af->get('table'), $filename);
        $this->af->setApp('content', $content);

        return 'utility_db_import_download';
    }
}
?>
