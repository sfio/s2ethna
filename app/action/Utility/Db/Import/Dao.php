<?php
/**
 * Utility/Db/Import/Dao.php
 *
 * @author Takuya Ookubo <sfio@sakura.ai.to>
 * @package S2ethna
 * @version SVN: $Id: Dao.php 91 2007-10-28 15:08:57Z ookubo $
 */

require_once('Form.php');

/**
 * utility_db_import_dao�ե�����μ���
 *
 * @author Takuya Ookubo <sfio@sakura.ai.to>
 * @access public
 * @package S2ethna
 */
class S2ethna_Form_UtilityDbImportDao extends S2ethna_Form_UtilityDbImportForm
{
    /**
     * ���󥹥ȥ饯��
     *
     * @access public
     */
    function __construct(&$controller)
    {
        parent::__construct($controller);

        // form��required��
        $this->form['table']['required'] = true;
    }
}

/**
 * utility_db_import_dao���������μ���
 *
 * @author Takuya Ookubo <sfio@sakura.ai.to>
 * @access public
 * @package S2ethna
 */
class S2ethna_Action_UtilityDbImportDao extends S2ethna_ActionClass
{
    /**
     * utility_db_import_dao����������������
     *
     * @access public
     * @return string ����̾(���ｪλ�ʤ�null, ������λ�ʤ�false)
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
     * utility_db_import_dao���������μ���
     *
     * @access public
     * @return string ����̾
     */
    function perform()
    {
        $filename = $this->backend->getManager('Utility')->getFilename($this->af->get('table'), 'Dao');
        $this->af->setApp('filename', $filename);

        $content = $this->backend->getManager('Utility')->createDao($this->af->get('table'), $filename);
        $this->af->setApp('content', $content);

        return 'utility_db_import_download';
    }
}
?>
