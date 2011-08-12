<?php
/**
 * ShelfDao.class.php
 *
 * @author Takuya Ookubo <sfio@sakura.ai.to>
 * @package S2ethna
 * @version $Id: ShelfDao.class.php 70 2007-10-14 13:40:09Z ookubo $
 * @category dao
 */

/**
 * shelfDAO�Υ��󥿡��ե�����
 *
 * @author Takuya Ookubo <sfio@sakura.ai.to>
 * @package S2ethna
 * @category dao
 */
interface ShelfDao {

    /** BEAN̾ */
    const BEAN = 'ShelfBean';

    /**
     * INSERT
     *
     * @access public
     * @param ShelfBean $shelf BEAN
     * @return int �����Կ�
     * @exception S2Container_S2RuntimeException ��������
     */
    public function createShelf(ShelfBean $shelf);

    /**
     * SELECT
     *
     * @access public
     * @param ShelfBean $shelf BEAN
     * @return ShelfBean BEAN
     */
    public function readShelf(ShelfBean $shelf);

    /**
     * SELECT
     *
     * @access public
     * @param S2Dao_PagerCondition $pager �ڡ�����
     * @return S2Dao_ArrayList BEAN�Υꥹ��
     */
    public function readShelfList(S2Dao_PagerCondition $pager = null);

    /**
     * UPDATE
     *
     * @access public
     * @param ShelfBean $shelf BEAN
     * @return int �����Կ�
     * @exception S2Container_S2RuntimeException ��������
     */
    public function updateShelf(ShelfBean $shelf);

    /**
     * DELETE
     *
     * @access public
     * @param ShelfBean $shelf BEAN
     * @return int �����Կ�
     * @exception S2Container_S2RuntimeException ��������
     */
    public function deleteShelf(ShelfBean $shelf);

}
?>