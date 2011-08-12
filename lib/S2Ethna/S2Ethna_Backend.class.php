<?php
/**
 * S2Ethna_Backend.class.php
 *
 * @author Takuya Ookubo <sfio@sakura.ai.to>
 * @package S2Ethna
 * @version SVN: $Id: S2Ethna_Backend.class.php 97 2007-10-28 15:21:03Z ookubo $
 * @category library
 * @copyright 2007 Takuya Ookubo <sfio@sakura.ai.to>
 * @license http://www.opensource.org/licenses/bsd-license.php The BSD License
 * @link http://s2ethna.ameria.jp/
 */

/**
 * �Хå�����ɽ������饹
 *
 * @author Takuya Ookubo <sfio@sakura.ai.to>
 * @package S2Ethna
 * @category class
 * @copyright 2007 Takuya Ookubo <sfio@sakura.ai.to>
 * @license http://www.opensource.org/licenses/bsd-license.php The BSD License
 * @version Release: 0.2
 * @link http://s2ethna.ameria.jp/
 */
class S2Ethna_Backend extends Ethna_Backend {

    /**
     * �Хå�����ɽ�����¹Ԥ���
     *
     * @access public
     * @param string $action_name �¹Ԥ��륢��������̾��
     * @return mixed string:Forward̾, Ethna_Error:���顼
     */
    function perform($action_name) {
        $forward_name = null;

        $action_class_name = $this->controller->getActionClassName($action_name);
//        $this->action_class = new $action_class_name($this);
        $this->action_class = $this->instantiateAction($action_name, $action_class_name);
        $this->ac = & $this->action_class;

        // ���������μ¹�
        $forward_name = $this->ac->authenticate();
        if ($forward_name === false) {
            return null;
        } else if ($forward_name !== null) {
            return $forward_name;
        }

        $forward_name = $this->ac->prepare();
        if ($forward_name === false) {
            return null;
        } else if ($forward_name !== null) {
            return $forward_name;
        }

        $forward_name = $this->ac->perform();

        return $forward_name;
    }

    /** DICON�γ�ĥ�� */
    const DICON_SUFFIX = '.dicon';

    /**
     * dicon�ե�����Υѥ������
     *
     * @access public
     * @param string $class_name ���饹̾
     * @return string dicon�ե�����Υѥ�
     */
    public function getDiconPath($class_name) {
        $ref = new ReflectionClass($class_name);
        $ext = $this->controller->getExt('php');
        $dicon_path = preg_replace("/\.$ext$/", self::DICON_SUFFIX, $ref->getFileName());
        if (is_file($dicon_path)) {
            return $dicon_path;
        }

        return null;
    }

    /**
     * ��������������
     *
     * @access protected
     * @param string $actionName ���������̾
     * @param string $actionClassName $actionName�Υ��饹̾
     * @return Ethna_ActionClass Ethna_ActionClass���֥�������
     */
    protected function instantiateAction($actionName, $actionClassName) {
        $diconPath = $this->getDiconPath($actionClassName);
        if ($diconPath == null) {
            return new $actionClassName($this);
        }

        return $this->_getActionFromS2Container($actionName, $actionClassName, $diconPath);
    }

    /**
     * S2Container.PHP5�ˤ�륢������������
     *
     * @access private
     * @param $actionName
     * @param $actionClassName
     * @param $diconPath
     * @return Ethna_ActionClass
     */
    private function _getActionFromS2Container($actionName, $actionClassName, $diconPath) {
        $container = S2ContainerFactory::create($diconPath);
        if ($container->hasComponentDef($actionName)) {
            $componentKey = $actionName;
        } else if ($container->hasComponentDef($actionClassName)) {
            $componentKey = $actionClassName;
        } else {
            $componentKey = null;
        }

        if ($componentKey != null) {
            $cd = $container->getComponentDef($componentKey);
            $this->_setupArgDef($cd);
            return $cd->getComponent();
        }
        $cd = new S2Container_ComponentDefImpl($actionClassName, $actionName);
        $this->_setupArgDef($cd);
        $container->register($cd);
        return $container->getComponent($actionName);
    }

    /**
     * ����ݡ��ͥ�Ȥ˰��������ꤹ��
     *
     * @access private
     * @param S2Container_ComponentDef $cd
     * @return S2Container_ArgDefImpl
     */
    private function _setupArgDef(S2Container_ComponentDef $cd) {
        if ($cd->getArgDefSize() > 0) {
            throw new S2Ethna_NoticeException('Too many ArgDef found.', E_GENERAL);
        }

        $ad = new S2Container_ArgDefImpl($this);
        $cd->addArgDef($ad);
    }
}
?>
