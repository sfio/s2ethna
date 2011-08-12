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
 * bbsDAOのインターフェース
 *
 * @author Takuya Ookubo <sfio@sakura.ai.to>
 * @package S2ethna
 * @category dao
 */
interface BbsDao {

    /** BEAN名 */
    const BEAN = 'BbsBean';

    /**
     * INSERT
     *
     * @access public
     * @param BbsBean $bbs BEAN
     * @return int 更新行数
     * @exception S2Container_S2RuntimeException 更新失敗
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
     * @param S2Dao_PagerCondition $pager ページャ
     * @return S2Dao_ArrayList BEANのリスト
     */
    public function readBbsList(S2Dao_PagerCondition $pager = null);
    /** readBbsListのSQL */
    const readBbsList_QUERY = 'ORDER BY date DESC';

    /**
     * UPDATE
     *
     * @access public
     * @param BbsBean $bbs BEAN
     * @return int 更新行数
     * @exception S2Container_S2RuntimeException 更新失敗
     */
    public function updateBbs(BbsBean $bbs);

    /**
     * DELETE
     *
     * @access public
     * @param BbsBean $bbs BEAN
     * @return int 更新行数
     * @exception S2Container_S2RuntimeException 更新失敗
     */
    public function deleteBbs(BbsBean $bbs);

}
?>