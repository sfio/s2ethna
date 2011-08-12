<?php
/**
 * {$filename}
 *
 * @author {ldelim}$author{rdelim}
 * @package {ldelim}$project_id{rdelim}
 * @version $Id: dao.tpl 70 2007-10-14 13:40:09Z ookubo $
 * @category dao
 */

/**
 * {$table}DAOのインターフェース
 *
 * @author {ldelim}$author{rdelim}
 * @package {ldelim}$project_id{rdelim}
 * @category dao
 */
interface {$dao_classname} {ldelim}

    /** BEAN名 */
    const BEAN = '{$bean_classname}';

    /**
     * INSERT
     *
     * @access public
     * @param {$bean_classname} ${$table} BEAN
     * @return int 更新行数
     * @exception S2Container_S2RuntimeException 更新失敗
     */
    public function create{$table_ucfirst}({$bean_classname} ${$table});

    /**
     * SELECT
     *
     * @access public
     * @param {$bean_classname} ${$table} BEAN
     * @return {$bean_classname} BEAN
     */
    public function read{$table_ucfirst}({$bean_classname} ${$table});

    /**
     * SELECT
     *
     * @access public
     * @param S2Dao_PagerCondition $pager ページャ
     * @return S2Dao_ArrayList BEANのリスト
     */
    public function read{$table_ucfirst}List(S2Dao_PagerCondition $pager = null);

    /**
     * UPDATE
     *
     * @access public
     * @param {$bean_classname} ${$table} BEAN
     * @return int 更新行数
     * @exception S2Container_S2RuntimeException 更新失敗
     */
    public function update{$table_ucfirst}({$bean_classname} ${$table});

    /**
     * DELETE
     *
     * @access public
     * @param {$bean_classname} ${$table} BEAN
     * @return int 更新行数
     * @exception S2Container_S2RuntimeException 更新失敗
     */
    public function delete{$table_ucfirst}({$bean_classname} ${$table});

{rdelim}
?>
