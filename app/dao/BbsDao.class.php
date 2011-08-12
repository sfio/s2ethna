<?php
/**
 * BbsDao.class.php
 *
 * @author Takuya Ookubo <sfio@sakura.ai.to>
 * @package S2ethna
 * @version $Id: BbsDao.class.php 70 2007-10-14 13:40:09Z ookubo $
 * @category dao
 */

/**
 * bbsDAO�Υ��󥿡��ե�����
 *
 * @author Takuya Ookubo <sfio@sakura.ai.to>
 * @package S2ethna
 * @category dao
 */
interface BbsDao {

    /** BEAN̾ */
    const BEAN = 'BbsBean';

    /**
     * INSERT
     *
     * @access public
     * @param BbsBean $bbs BEAN
     * @return int �����Կ�
     * @exception S2Container_S2RuntimeException ��������
     */
    public function createBbs(BbsBean $bbs);

    /**
     * SELECT
     *
     * @access public
     * @param BbsBean $bbs BEAN
     * @return BbsBean BEAN
     */
    public function readBbs(BbsBean $bbs);

    /**
     * SELECT
     *
     * @access public
     * @param S2Dao_PagerCondition $pager �ڡ�����
     * @return S2Dao_ArrayList BEAN�Υꥹ��
     */
    public function readBbsList(S2Dao_PagerCondition $pager = null);
    /** readBbsList��SQL */
    const readBbsList_QUERY = 'ORDER BY date DESC';

    /**
     * UPDATE
     *
     * @access public
     * @param BbsBean $bbs BEAN
     * @return int �����Կ�
     * @exception S2Container_S2RuntimeException ��������
     */
    public function updateBbs(BbsBean $bbs);

    /**
     * DELETE
     *
     * @access public
     * @param BbsBean $bbs BEAN
     * @return int �����Կ�
     * @exception S2Container_S2RuntimeException ��������
     */
    public function deleteBbs(BbsBean $bbs);

}
?>