<?php

namespace SubPageList;

use Title;
use TitleArray;

/**
 * Simple subpage finder and counter that uses a like query
 * on the page table to find subpages.
 *
 * @since 1.0
 *
 * @licence GNU GPL v2+
 * @author Jeroen De Dauw < jeroendedauw@gmail.com >
 */
class SimpleSubPageFinder implements SubPageFinder, SubPageCounter {

	const OPT_INCLUDE_REDIRECTS = 'redirects';
	const OPT_LIMIT = 'limit';
	const OPT_OFFSET = 'offset';

	/**
	 * @since 1.0
	 *
	 * @var null|DBConnectionProvider
	 */
	protected $connectionProvider;

	/**
	 * @since 1.0
	 *
	 * @var array
	 */
	protected $options;

	/**
	 * @since 1.0
	 *
	 * @param DBConnectionProvider|null $connectionProvider
	 */
	public function __construct( DBConnectionProvider $connectionProvider = null ) {
		$this->connectionProvider = $connectionProvider;

		$this->options = array(
			self::OPT_INCLUDE_REDIRECTS => false,
			self::OPT_LIMIT => 500,
			self::OPT_OFFSET => 0,
		);
	}

	/**
	 * @since 1.0
	 *
	 * @param string $option
	 * @param mixed $value
	 */
	public function setOption( $option, $value ) {
		$this->options[$option] = $value;
	}

	/**
	 * @see SubPageFinder::getSubPagesFor
	 *
	 * @since 1.0
	 *
	 * @param Title $title
	 *
	 * @return Title[]
	 */
	public function getSubPagesFor( Title $title ) {
		/**
		 * @var \DatabaseBase $dbr
		 */
		$dbr = $this->connectionProvider->getConnection();

		$titleArray = TitleArray::newFromResult(
			$dbr->select( 'page',
				array( 'page_id', 'page_namespace', 'page_title', 'page_is_redirect' ),
				$this->getConditions( $title ),
				__METHOD__,
				$this->getOptions()
			)
		);

		$this->connectionProvider->releaseConnection();

		return iterator_to_array( $titleArray );
	}

	/**
	 * @see SubPageCounter::countSubPages
	 *
	 * @since 1.0
	 *
	 * @param Title $title
	 *
	 * @return integer
	 */
	public function countSubPages( Title $title ) {
		/**
		 * @var \DatabaseBase $dbr
		 */
		$dbr = $this->connectionProvider->getConnection();

		$res = $dbr->selectRow(
			'page',
			'COUNT(*) AS rowcount',
			$this->getConditions( $title ),
			__METHOD__,
			$this->getOptions()
		);

		if ( is_object( $res ) ) {
			return (int)$res->rowcount;
		}

		return 0;
	}

	/**
	 * @since 1.0
	 *
	 * @param Title $title
	 *
	 * @return array
	 */
	protected function getConditions( Title $title ) {
		/**
		 * @var \DatabaseBase $dbr
		 */
		$dbr = $this->connectionProvider->getConnection();

		$conditions = array(
			'page_namespace' => $title->getNamespace(),
			'page_title'  . $dbr->buildLike( $title->getDBkey() . '/', $dbr->anyString() )
		);

		if ( !$this->options[self::OPT_INCLUDE_REDIRECTS] ) {
			$conditions['page_is_redirect'] = 0;
		}

		return $conditions;
	}

	/**
	 * @since 1.0
	 *
	 * @return array
	 */
	protected function getOptions() {
		$options = array();

		$options['LIMIT'] = (int)$this->options[self::OPT_LIMIT];

		if ( $this->options[self::OPT_OFFSET] > 0 ) {
			$options['OFFSET'] = (int)$this->options[self::OPT_OFFSET];
		}

		return $options;
	}

}
