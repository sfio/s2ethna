<?php
/**
 * S2ethna_UtilityManager.php
 *
 * @author Takuya Ookubo <sfio@sakura.ai.to>
 * @package S2ethna
 * @version SVN: $Id: S2ethna_UtilityManager.php 19 2007-09-09 04:46:23Z ookubo $
 */

/**
 * S2ethna_UtilityManager
 *
 * @author Takuya Ookubo <sfio@sakura.ai.to>
 * @access public
 * @package S2ethna
 */
class S2ethna_UtilityManager extends Ethna_AppManager {

    /** @var array Ethna_DB���֥������� */
    public $db;

    /** @var string �������ƥ�ץ졼�ȥǥ��쥯�ȥ� */
    var $src_dir = 'src';

    /**
     * DB���֥������Ȥ��֤�
     *
     * @access public
     * @param string $dsn DSN
     * @return mixed Ethna_DB:DB���֥������� Ethna_Error:���顼
     * @todo �������new���ʤ���class factory�����Ѥ���
     */
    public function & getDB($dsn) {
        $controller = $this->backend->getController();
        $class_factory = & $controller->getClassFactory();
        $db_class_name = 'Ethna_DB_PEAR';
        if (class_exists($db_class_name) === false) {
            $class_factory->_include($db_class_name);
        }

        $this->db = new $db_class_name ($controller, $dsn, false);
        $result = $this->db->connect();
        if (Ethna::isError($result)) {
            $this->db = null;
            return $result;
        }
        register_shutdown_function(array (
            & $this,
            'shutdownDB'
        ));

        return $this->db;
    }

    /**
     * DB���ͥ����������Ǥ���
     *
     * @access public
     */
    public function shutdownDB() {
        $this->db->disconnect();
        unset ($this->db);
    }

    /**
     * �ơ��֥�ΰ���
     */
    public function getTables() {
        $result =& $this->db->query('SHOW TABLES;');

        $tables = array();
        while ($rs = $result->fetchRow()) {
            $tables[] = $rs[0];
        }

        return $tables;
    }
    /**
     * ���饹̾
     */
    private function _getClassname($table, $type) {
        return $this->_ucfirst($table) . $type;
    }

    /**
     * �ե�����̾
     */
    public function getFilename($table, $type) {
        return $this->_getClassname($table, $type) . '.class.php';
    }

    /**
     * Bean����
     */
    public function createBean($table, $filename) {
        $result = $this->db->db->tableInfo($this->db->quoteIdentifier($table));
        if (Ethna::isError($result)) {
            return $result;
        }

        $bean_classname = $this->_getClassname($table, 'Bean');
        $beans = array();
        foreach ($result as $fields) {
            $name = $fields['name'];
            $name_ucfirst = $this->_ucfirst($name);
            $beans[] = array(
                'name' => $name,
                'name_ucfirst' =>  $name_ucfirst,
            );
        }
        $c =& $this->backend->getController();
        $renderer =& $c->getRenderer();
        $renderer->setProp('filename', $filename);
        $renderer->setProp('table', $table);
        $renderer->setProp('bean_classname', $bean_classname);
        $renderer->setProp('beans', $beans);

        $template = 'bean.tpl';
        $buf = $renderer->perform(sprintf('%s/%s', $this->src_dir, $template), true);

        return $buf;
    }

    /**
     * Dao����
     */
    public function createDao($table, $filename) {
        $table_ucfirst = $this->_ucfirst($table);
        $dao_classname = $this->_getClassname($table, 'Dao');
        $bean_classname = $this->_getClassname($table, 'Bean');

        $c =& $this->backend->getController();
        $renderer =& $c->getRenderer();
        $renderer->setProp('filename', $filename);
        $renderer->setProp('table', $table);
        $renderer->setProp('table_ucfirst', $table_ucfirst);
        $renderer->setProp('dao_classname', $dao_classname);
        $renderer->setProp('bean_classname', $bean_classname);

        $template = 'dao.tpl';
        $buf = $renderer->perform(sprintf('%s/%s', $this->src_dir, $template), true);

        return $buf;
    }

    /**
     * ��Ƭ����ʸ�����Ѵ�
     */
    private function _ucfirst($str) {
        return str_replace(' ', '', ucwords(str_replace('_', ' ', $str)));
    }
}
?>
