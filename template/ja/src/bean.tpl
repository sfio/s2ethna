<?php
/**
 * {$filename}
 *
 * @author {ldelim}$author{rdelim}
 * @package {ldelim}$project_id{rdelim}
 * @version $Id: bean.tpl 23 2007-09-09 04:50:46Z ookubo $
 * @category bean
 */

/**
 * {$table}BEAN�μ���
 *
 * @author {ldelim}$author{rdelim}
 * @package {ldelim}$project_id{rdelim}
 * @category bean
 */
class {$bean_classname} extends S2Ethna_BaseBean {ldelim}

    /** �ơ��֥�̾ */
    const TABLE = '{$table}';

{foreach from=$beans item=bean}
    /** @var mixed {$bean.name} */
    protected ${$bean.name};

    /**
     * {$bean.name}��getter
     *
     * @access public
     * @return mixed {$bean.name}
     */
    public function get{$bean.name_ucfirst}() {ldelim}
        return $this->{$bean.name};
    {rdelim}

    /**
     * {$bean.name}��setter
     *
     * @access public
     * @param mixed ${$bean.name} {$bean.name}
     * @return $this
     */
    public function set{$bean.name_ucfirst}(${$bean.name}) {ldelim}
        $this->{$bean.name} = ${$bean.name};
        return $this;
    {rdelim}

{/foreach}
{rdelim}
?>
