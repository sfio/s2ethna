<?php
/**
 * S2Ethna.php
 *
 * @author Takuya Ookubo <sfio@sakura.ai.to>
 * @package S2Ethna
 * @version SVN: $Id: S2Ethna.php 134 2008-06-14 12:40:29Z ookubo $
 * @category library
 * @copyright 2007 Takuya Ookubo <sfio@sakura.ai.to>
 * @license http://www.opensource.org/licenses/bsd-license.php The BSD License
 * @link http://s2ethna.ameria.jp/
 */

// S2Container.PHP5
require_once('S2Container/S2Container.php');
S2ContainerClassLoader::import(S2CONTAINER_PHP5);

// S2Dao.PHP5
require_once('S2Dao/S2Dao.php');
S2ContainerClassLoader::import(S2DAO_PHP5);
define('PDO_DICON', BASE . '/etc/pdo.dicon');

require_once('S2Ethna_Backend.class.php');
require_once('S2Ethna_ClassFactory.class.php');
require_once('S2Ethna_Logger.class.php');
if (isset(S2Container_S2Logger::$LOGGER_FACTORY)) {
    // S2Container.PHP5 v1.2·Ï
    S2Container_S2Logger::$LOGGER_FACTORY = 'S2Ethna_EthnaLoggerFactory';
} else {
    // S2Container.PHP5 v1.1·Ï
    S2Container_S2LogFactory::$LOGGER = S2Container_S2LogFactory::LOG4PHP;
}

require_once('S2Ethna_BaseBean.class.php');
require_once('S2Ethna_Session.class.php');
require_once('S2Ethna_PagerCondition.class.php');
require_once('S2Ethna_Exception.class.php');
require_once('S2Ethna_PDODataSource.class.php');
S2ContainerClassLoader::import(BASE . '/app/dao');
S2ContainerClassLoader::import(BASE . '/app/entity');

function __autoload($class = null){
    if(S2ContainerClassLoader::load($class)){
        return;
    }
}
?>
