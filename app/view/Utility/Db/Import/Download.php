<?php
/**
 * Utility/Db/Import/Download.php
 *
 * @author Takuya Ookubo <sfio@sakura.ai.to>
 * @package S2ethna
 * @version SVN: $Id: Download.php 23 2007-09-09 04:50:46Z ookubo $
 */

/**
 * utility_db_import_downloadビューの実装
 *
 * @author Takuya Ookubo <sfio@sakura.ai.to>
 * @access public
 * @package S2ethna
 */
class S2ethna_View_UtilityDbImportDownload extends S2ethna_ViewClass
{
    /**
     * 遷移前処理
     *
     * @access public
     */
    function preforward()
    {
        header('Content-Type: application/x-httpd-php-source');
        header('Content-disposition: attachement; filename="' . $this->af->getApp('filename') . '"');

        echo $this->af->getApp('content');

        exit;
    }
}
?>
