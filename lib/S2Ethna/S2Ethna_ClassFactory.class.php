<?php
/**
 * S2Ethna_ClassFactory.class.php
 *
 * @author Takuya Ookubo <sfio@sakura.ai.to>
 * @package S2Ethna
 * @version SVN: $Id: S2Ethna_ClassFactory.class.php 97 2007-10-28 15:21:03Z ookubo $
 * @category library
 * @copyright 2007 Takuya Ookubo <sfio@sakura.ai.to>
 * @license http://www.opensource.org/licenses/bsd-license.php The BSD License
 * @link http://s2ethna.ameria.jp/
 */

/**
 * オブジェクト生成ゲートウェイ
 *
 * @author Takuya Ookubo <sfio@sakura.ai.to>
 * @package S2Ethna
 * @category class
 * @copyright 2007 Takuya Ookubo <sfio@sakura.ai.to>
 * @license http://www.opensource.org/licenses/bsd-license.php The BSD License
 * @version Release: 0.2
 * @link http://s2ethna.ameria.jp/
 */
class S2Ethna_ClassFactory extends Ethna_ClassFactory {

    /**
     * typeに対応するアプリケーションマネージャオブジェクトを返す
     *
     * @access public
     * @param string $type クラス名
     * @param bool $weak 新たなオブジェクトを生成する
     * @return Ethna_AppManager Ethna_AppManagerオブジェクト
     */
    function &getManager($type, $weak = false)
    {
        $obj = null;

        // check if object class exists
        $obj_class_name = $this->controller->getObjectClassName($type);
        if (class_exists($obj_class_name) === false) {
            // try include.
            $this->_include($obj_class_name);
        }

        // check if manager class exists
        $class_name = $this->controller->getManagerClassName($type);
        if (class_exists($class_name) === false
            && $this->_include($class_name) === false) {
            return $obj;
        }

        if (isset($this->method_list[$class_name]) == false) {
            $this->method_list[$class_name] = get_class_methods($class_name);
            for ($i = 0; $i < count($this->method_list[$class_name]); $i++) {
                $this->method_list[$class_name][$i] = strtolower($this->method_list[$class_name][$i]);
            }
        }

        // see if this should be singlton or not
        if ($this->_isCacheAvailable($class_name, $this->method_list[$class_name], $weak)) {
            if (isset($this->manager[$type]) && is_object($this->manager[$type])) {
                return $this->manager[$type];
            }
        }

        // see if we have helper methods
        if (in_array("getinstance", $this->method_list[$class_name])) {
            $obj =& call_user_func(array($class_name, 'getInstance'));
        } else {
//            $backend =& $this->controller->getBackend();
//            $obj = new $class_name($backend);
            $obj = & $this->instantiateManager($type, $class_name);
        }

        if (isset($this->manager[$type]) == false || is_object($this->manager[$type]) == false) {
            $this->manager[$type] =& $obj;
        }

        return $obj;
    }

    /**
     * アプリケーションマネージャの生成
     *
     * @access protected
     * @param $key
     * @param string $class_name
     * @return Ethna_AppManager Ethna_AppManagerオブジェクト
     */
    protected function instantiateManager($key, $class_name) {
        $backend =& $this->controller->getBackend();
        $diconPath = $backend->getDiconPath($class_name);
        if ($diconPath == null) {
            return new $class_name($backend);
        }

        return $this->_getObjectFromS2Container($key, $class_name, $diconPath, $backend);
    }

    /**
     * S2Container.PHP5によるオブジェクトの生成
     *
     * @access private
     * @param $key
     * @param $class_name
     * @param $diconPath
     * @param $arg
     * @return Object
     */
    private function _getObjectFromS2Container($key, $class_name, $diconPath, $arg = null) {
        $container = S2ContainerFactory::create($diconPath);
        if ($container->hasComponentDef($key)) {
            $componentKey = $key;
        } else if ($container->hasComponentDef($class_name)) {
            $componentKey = $class_name;
        } else {
            $componentKey = null;
        }

        if ($componentKey != null) {
            $cd = $container->getComponentDef($componentKey);
            $this->_setupArgDef($cd, $arg);
            return $cd->getComponent();
        }
        $cd = new S2Container_ComponentDefImpl($class_name, $key);
        $this->_setupArgDef($cd, $arg);
        $container->register($cd);
        return $container->getComponent($key);
    }

    /**
     * コンポーネントに引数を設定する
     *
     * @access private
     * @param S2Container_ComponentDef $cd
     * @param $arg
     * @return S2Container_ArgDefImpl
     */
    private function _setupArgDef(S2Container_ComponentDef $cd, $arg) {
        if ($cd->getArgDefSize() > 0) {
            throw new S2Ethna_NoticeException('Too many ArgDef found.', E_GENERAL);
        }

        if ($arg != null) {
            $ad = new S2Container_ArgDefImpl($arg);
        } else {
            $ad = new S2Container_ArgDefImpl();
        }
        $cd->addArgDef($ad);
    }
}
?>