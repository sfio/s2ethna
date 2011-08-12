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
 * cdDAO�Υ��󥿡��ե�����
 *
 * @author Takuya Ookubo <sfio@sakura.ai.to>
 * @package S2ethna
 * @category dao
 */
interface CdDao {

    /** BEAN̾ */
    const BEAN = 'CdBean';

    /**
     * INSERT
     *
     * @access public
     * @param CdBean $cd BEAN
     * @return int �����Կ�
     * @exception S2Container_S2RuntimeException ��������
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
     * @param S2Dao_PagerCondition $pager �ڡ�����
     * @return S2Dao_ArrayList BEAN�Υꥹ��
     */
    public function readCdList(S2Dao_PagerCondition $pager = null);

    /**
     * UPDATE
     *
     * @access public
     * @param CdBean $cd BEAN
     * @return int �����Կ�
     * @exception S2Container_S2RuntimeException ��������
     */
    public function updateCd(CdBean $cd);

    /**
     * DELETE
     *
     * @access public
     * @param CdBean $cd BEAN
     * @return int �����Կ�
     * @exception S2Container_S2RuntimeException ��������
     */
    public function deleteCd(CdBean $cd);

}
?>