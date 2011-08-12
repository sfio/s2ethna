<?php
/**
 * S2Ethna_PagerCondition.class.php
 *
 * @author Takuya Ookubo <sfio@sakura.ai.to>
 * @package S2Ethna
 * @version SVN: $Id: S2Ethna_PagerCondition.class.php 20 2007-09-09 04:47:33Z ookubo $
 * @category library
 * @copyright 2007 Takuya Ookubo <sfio@sakura.ai.to>
 * @license http://www.opensource.org/licenses/bsd-license.php The BSD License
 * @link http://s2ethna.ameria.jp/
 */

/**
 * S2Ethna_PagerCondition���饹
 *
 * @author Takuya Ookubo <sfio@sakura.ai.to>
 * @package S2Ethna
 * @category class
 * @copyright 2007 Takuya Ookubo <sfio@sakura.ai.to>
 * @license http://www.opensource.org/licenses/bsd-license.php The BSD License
 * @version Release: 0.2
 * @link http://s2ethna.ameria.jp/
 */
class S2Ethna_PagerCondition implements S2Dao_PagerCondition {

	/** ���ߤΰ��� */
	protected $offset = 0;

	/** ��������κ����� */
	protected $limit = self::NONE_LIMIT;

	/** ������������ */
	protected $count = 0;

	/** �����ڡ��� */
	protected $currentPage = null;

	/** ����ڡ��� */
	protected $maxPage = null;

	/** ���ڡ��� */
	protected $prevPage = null;

	/** ���ڡ��� */
	protected $nextPage = null;

	/** ���Ϸ�� */
	protected $begin = null;

	/** ��λ��� */
	protected $end = null;

	/**
	 * ���󥹥ȥ饯��
	 *
	 * @access private
	 */
	private function __construct() {
		// new�ػ�
	}

	/**
	 * �ǥ��ȥ饯��
	 *
	 * @access public
	 */
	public function __destruct() {
	}

	/**
	 * �ڡ����㥪�֥������Ȥ��������
	 *
	 * @access public
	 */
	static public function create($page = null, $limit = self::NONE_LIMIT) {
    	if (strcasecmp($page, 'all') == 0) {
    		return null;
    	}

    	$pager = new S2Ethna_PagerCondition();
		return $pager->setOffsetByPageAndLimit($page, $limit);
	}

    /**
     * ����
     */
    public function toArray() {
        $buf = array();
        foreach ($this as $property => $value) {
            $buf[$property] = $value;
        }
        return $buf;
    }

	/**
	 * ��������������������
	 *
	 * @return ���
	 */
	public function getCount() {
		return $this->count;
	}

	/**
	 * ����������������ꤹ��
	 *
	 * @param $count ���
     * @return $this
	 */
	public function setCount($count) {
        if ($this->limit == self::NONE_LIMIT) {
			throw new S2Ethna_NoticeException('Set Limit previously.', E_GENERAL);
		}

		$this->count = (int)$count;

		if ($this->offset <= $this->count) {
		    $this->update();
		} else {
			// TODO: �۾��ͤʤΤǥ��˵�Ͽ
		}

        return $this;
	}

	/**
	 * ������������������
	 *
	 * @return ���������
	 */
	public function getLimit() {
		return $this->limit;
	}

	/**
	 * ��������������ꤹ��
	 *
	 * @param $limit ���������
     * @return $this
	 */
	public function setLimit($limit) {
        if ($limit < 1) {
			throw new S2Ethna_NoticeException('Set the positive integer to Limit.', E_GENERAL);
        }

		$this->limit = (int)$limit;

        return $this;
	}

	/**
	 * ���ߤΰ��֤��������
	 *
	 * @return ���ߤΰ���
	 */
	public function getOffset() {
		return $this->offset;
	}

	/**
	 * ���ߤΰ��֤����ꤹ��
	 *
	 * @param $offset ���ߤΰ���
     * @return $this
	 */
    public function setOffset($offset) {
        if ($this->limit == self::NONE_LIMIT) {
			throw new S2Ethna_NoticeException('Set Limit previously.', E_GENERAL);
		}
        if ($offset < 0) {
            throw new S2Ethna_NoticeException('Set the unsigned integer to Offset.', E_GENERAL);
        }

        $this->offset = (int)$offset;

        return $this;
    }

	/**
	 * ���ߤΰ��֤�ڡ����ֹ椫�����ꤹ��
	 *
	 * @param $page �ڡ����ֹ�
     * @return $this
	 */
	public function setOffsetByPage($page) {
		if (!is_numeric($page)) {
            $this->setOffset($page);
		} else {
            if ($page < 1) {
    			$page = 1;
            }

            // TODO: ��ο����㳰�ꤲ���ۤ����褤����
            $this->setOffset($this->limit * ($page -1));
		}

        return $this;
	}

    /**
     * ����������ȸ��ߤΰ��֤����ꤹ��
     *
     * @param $offset ���ߤΰ���
     * @param $limit ���������
     * @return $this
     */
    public function setOffsetAndLimit($offset, $limit = self::NONE_LIMIT) {
        return $this->setLimit($limit)->setOffset($offset);
    }

    /**
     * ����������ȸ��ߤΰ��֤�ڡ����ֹ椫�����ꤹ��
     *
     * @param $page �ڡ����ֹ�
     * @param $limit ���������
     * @return $this
     */
    public function setOffsetByPageAndLimit($page, $limit = self::NONE_LIMIT) {
        return $this->setLimit($limit)->setOffsetByPage($page);
    }

    /**
     *
     */
    public function getMaxPage() {
        return $this->maxPage;
    }

    /**
     *
     */
    public function setMaxPage($maxPage) {
        $this->maxPage = (int)$maxPage;
        return $this;
    }

    /**
     *
     */
    public function getCurrentPage() {
        return $this->currentPage;
    }

    /**
     *
     */
    public function setCurrentPage($currentPage) {
        $this->currentPage = (int)$currentPage;
        return $this;
    }

    /**
     *
     */
    public function getPrevPage() {
        return $this->prevPage;
    }

    /**
     *
     */
    public function setPrevPage($prevPage) {
    	if (!is_null($prevPage)) {
	        $this->prevPage = (int)$prevPage;
    	} else {
    	    $this->prevPage = null;
    	}
        return $this;
    }

    /**
     *
     */
    public function getNextPage() {
        return $this->nextPage;
    }

    /**
     *
     */
    public function setNextPage($nextPage) {
    	if (!is_null($nextPage)) {
	        $this->nextPage = (int)$nextPage;
    	} else {
    	    $this->nextPage = null;
    	}
        return $this;
    }

    /**
     *
     */
    public function getBegin() {
		return $this->begin;
    }

    /**
     *
     */
    public function setBegin($begin) {
        $this->begin = (int)$begin;
        return $this;
    }

    /**
     *
     */
    public function getEnd() {
		return $this->end;
    }

    /**
     *
     */
    public function setEnd($end) {
		$this->end = (int)$end;
        return $this;
    }

    /**
     *
     */
    public function update() {
    	$maxPage = ceil($this->count / $this->limit);
        if ($maxPage < 1) {
            $maxPage = 1;
        }
        $this->setMaxPage($maxPage);
        $this->setCurrentPage(ceil($this->offset / $this->limit) + 1);

        if ($this->currentPage > 1) {
        	$this->setPrevPage($this->currentPage - 1);
        } else {
        	$this->setPrevPage(null);
        }
        if ($this->currentPage < $this->maxPage) {
        	$this->setNextPage($this->currentPage + 1);
		} else {
        	$this->setNextPage(null);
        }

    	$begin = $this->offset + 1;
        if ($begin > $this->count) {
            $begin = $this->count;
        }
    	$end = $this->currentPage * $this->limit;
        if ($end > $this->count) {
            $end = $this->count;
        }
        $this->setBegin($begin)->setEnd($end);

		return $this;
    }

}
?>
