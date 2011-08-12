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
 * {$table}DAO�Υ��󥿡��ե�����
 *
 * @author {ldelim}$author{rdelim}
 * @package {ldelim}$project_id{rdelim}
 * @category dao
 */
interface {$dao_classname} {ldelim}

    /** BEAN̾ */
    const BEAN = '{$bean_classname}';

    /**
     * INSERT
     *
     * @access public
     * @param {$bean_classname} ${$table} BEAN
     * @return int �����Կ�
     * @exception S2Container_S2RuntimeException ��������
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
     * @param S2Dao_PagerCondition $pager �ڡ�����
     * @return S2Dao_ArrayList BEAN�Υꥹ��
     */
    public function read{$table_ucfirst}List(S2Dao_PagerCondition $pager = null);

    /**
     * UPDATE
     *
     * @access public
     * @param {$bean_classname} ${$table} BEAN
     * @return int �����Կ�
     * @exception S2Container_S2RuntimeException ��������
     */
    public function update{$table_ucfirst}({$bean_classname} ${$table});

    /**
     * DELETE
     *
     * @access public
     * @param {$bean_classname} ${$table} BEAN
     * @return int �����Կ�
     * @exception S2Container_S2RuntimeException ��������
     */
    public function delete{$table_ucfirst}({$bean_classname} ${$table});

{rdelim}
?>
