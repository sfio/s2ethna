<?php
/**
 * Utility/Db/Import/Dsn.php
 *
 * @author Takuya Ookubo <sfio@sakura.ai.to>
 * @package S2ethna
 * @version SVN: $Id: Dsn.php 91 2007-10-28 15:08:57Z ookubo $
 */

require_once('Form.php');

/**
 * utility_db_import_dsn�ե�����μ���
 *
 * @author Takuya Ookubo <sfio@sakura.ai.to>
 * @access public
 * @package S2ethna
 */
class S2ethna_Form_UtilityDbImportDsn extends S2ethna_Form_UtilityDbImportForm
{
}

/**
 * utility_db_import_dsn���������μ���
 *
 * @author Takuya Ookubo <sfio@sakura.ai.to>
 * @access public
 * @package S2ethna
 */
class S2ethna_Action_UtilityDbImportDsn extends S2ethna_ActionClass
{
    /**
     * utility_db_import_dsn����������������
     *
     * @access public
     * @return string ����̾(���ｪλ�ʤ�null, ������λ�ʤ�false)
     */
    function prepare()
    {
        if ($this->af->validate() > 0) {
            return 'utility_db_import_form';
        }
        return null;
    }

    /**
     * utility_db_import_dsn���������μ���
     *
     * @access public
     * @return string ����̾
     */
    function perform()
    {
        $dsn = $this->config->get('demonstration')
            ? $this->config->get('demonstration_dsn') : $this->af->get('dsn');
        $result =& $this->backend->getManager('Utility')->getDB($dsn);
        if (Ethna::isError($result)) {
            $this->ae->addObject(null, $result);
            return 'utility_db_import_form';
        }

        $tables = $this->backend->getManager('Utility')->getTables();
        $this->af->setApp('tables', $tables);

        return 'utility_db_import_form';
    }
}
?>
