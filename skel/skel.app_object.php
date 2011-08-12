<?php
/**
 *  {$app_path}
 *
 *  @author     {$author}
 *  @package    S2ethna
 *  @version    $Id: skel.app_object.php,v 1.3 2006/11/06 14:31:24 cocoitiban Exp $
 */

/**
 *  {$app_object}Manager
 *
 *  @author     {$author}
 *  @access     public
 *  @package    S2ethna
 */
class {$app_object}Manager extends Ethna_AppManager
{
}

/**
 *  {$app_object}
 *
 *  @author     {$author}
 *  @access     public
 *  @package    S2ethna
 */
class {$app_object} extends Ethna_AppObject
{
    /**
     *  プロパティの表示名を取得する
     *
     *  @access public
     */
    function getName($key)
    {
        return $this->get($key);
    }
}
?>
