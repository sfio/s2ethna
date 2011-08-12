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
 * S2Ethna_PagerConditionクラス
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

	/** 現在の位置 */
	protected $offset = 0;

	/** 取得件数の最大値 */
	protected $limit = self::NONE_LIMIT;

	/** 取得した総件数 */
	protected $count = 0;

	/** 取得ページ */
	protected $currentPage = null;

	/** 最大ページ */
	protected $maxPage = null;

	/** 前ページ */
	protected $prevPage = null;

	/** 次ページ */
	protected $nextPage = null;

	/** 開始件数 */
	protected $begin = null;

	/** 終了件数 */
	protected $end = null;

	/**
	 * コンストラクタ
	 *
	 * @access private
	 */
	private function __construct() {
		// new禁止
	}

	/**
	 * デストラクタ
	 *
	 * @access public
	 */
	public function __destruct() {
	}

	/**
	 * ページャオブジェクトを作成する
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
     * 配列化
     */
    public function toArray() {
        $buf = array();
        foreach ($this as $property => $value) {
            $buf[$property] = $value;
        }
        return $buf;
    }

	/**
	 * 取得した総数を取得する
	 *
	 * @return 総数
	 */
	public function getCount() {
		return $this->count;
	}

	/**
	 * 取得した総数を設定する
	 *
	 * @param $count 総数
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
			// TODO: 異常値なのでログに記録
		}

        return $this;
	}

	/**
	 * 最大取得数を取得する
	 *
	 * @return 最大取得数
	 */
	public function getLimit() {
		return $this->limit;
	}

	/**
	 * 最大取得数を設定する
	 *
	 * @param $limit 最大取得数
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
	 * 現在の位置を取得する
	 *
	 * @return 現在の位置
	 */
	public function getOffset() {
		return $this->offset;
	}

	/**
	 * 現在の位置を設定する
	 *
	 * @param $offset 現在の位置
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
	 * 現在の位置をページ番号から設定する
	 *
	 * @param $page ページ番号
     * @return $this
	 */
	public function setOffsetByPage($page) {
		if (!is_numeric($page)) {
            $this->setOffset($page);
		} else {
            if ($page < 1) {
    			$page = 1;
            }

            // TODO: 負の数は例外投げたほうがよいか？
            $this->setOffset($this->limit * ($page -1));
		}

        return $this;
	}

    /**
     * 最大取得数と現在の位置を設定する
     *
     * @param $offset 現在の位置
     * @param $limit 最大取得数
     * @return $this
     */
    public function setOffsetAndLimit($offset, $limit = self::NONE_LIMIT) {
        return $this->setLimit($limit)->setOffset($offset);
    }

    /**
     * 最大取得数と現在の位置をページ番号から設定する
     *
     * @param $page ページ番号
     * @param $limit 最大取得数
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
