<?php
/**
 * CdDao.class.php
 *
 * @author Takuya Ookubo <sfio@sakura.ai.to>
 * @package S2ethna
 * @version $Id: CdDao.class.php 70 2007-10-14 13:40:09Z ookubo $
 * @category dao
 */

/**
 * cdDAOのインターフェース
 *
 * @author Takuya Ookubo <sfio@sakura.ai.to>
 * @package S2ethna
 * @category dao
 */
interface CdDao {

    /** BEAN名 */
    const BEAN = 'CdBean';

    /**
     * INSERT
     *
     * @access public
     * @param CdBean $cd BEAN
     * @return int 更新行数
     * @exception S2Container_S2RuntimeException 更新失敗
     */
    public function createCd(CdBean $cd);

    /**
     * SELECT
     *
     * @access public
     * @param CdBean $cd BEAN
     * @return CdBean BEAN
     */
    public function readCd(CdBean $cd);

    /**
     * SELECT
     *
     * @access public
     * @param S2Dao_PagerCondition $pager ページャ
     * @return S2Dao_ArrayList BEANのリスト
     */
    public function readCdList(S2Dao_PagerCondition $pager = null);

    /**
     * UPDATE
     *
     * @access public
     * @param CdBean $cd BEAN
     * @return int 更新行数
     * @exception S2Container_S2RuntimeException 更新失敗
     */
    public function updateCd(CdBean $cd);

    /**
     * DELETE
     *
     * @access public
     * @param CdBean $cd BEAN
     * @return int 更新行数
     * @exception S2Container_S2RuntimeException 更新失敗
     */
    public function deleteCd(CdBean $cd);

}
?>