<?php
/**
 * S2ethna_UrlHandler.php
 *
 * @author Takuya Ookubo <sfio@sakura.ai.to>
 * @package S2ethna
 * @version SVN: $Id: S2ethna_UrlHandler.php 19 2007-09-09 04:46:23Z ookubo $
 */

/**
 * URL�ϥ�ɥ饯�饹
 *
 * @author Takuya Ookubo <sfio@sakura.ai.to>
 * @access public
 * @package S2ethna
 */
class S2ethna_UrlHandler extends Ethna_UrlHandler
{
    /** @var array ���������ޥåԥ� */
    var $action_map = array(
        /*
        'user'  => array(
            'user_login' => array(
                'path'          => 'login',
                'path_regexp'   => false,
                'path_ext'      => false,
                'option'        => array(),
            ),
        ),
         */
    );

    /**
     * S2ethna_UrlHandler���饹�Υ��󥹥��󥹤��������
     *
     * @access public
     */
    function &getInstance($class_name = null)
    {
        $instance =& parent::getInstance(__CLASS__);
        return $instance;
    }

    // {{{ �����ȥ������ꥯ������������
    /**
     * �ꥯ������������(user�����ȥ�����)
     *
     * @access private
     */
    /*
    function _normalizeRequest_User($http_vars)
    {
        return $http_vars;
    }
     */
    // }}}

    // {{{ �����ȥ������ѥ�����
    /**
     * �ѥ�����(user�����ȥ�����)
     *
     * @access private
     */
    /*
    function _getPath_User($action, $param)
    {
        return array("/user", array());
    }
     */
    // }}}

    // {{{ �ե��륿
    // }}}
}

// vim: foldmethod=marker tabstop=4 shiftwidth=4 autoindent
?>
