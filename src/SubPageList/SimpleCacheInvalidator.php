<?php

namespace SubPageList;

use Title;

/**
 * Naive cache invalidator that invalidates subpages and the top parent page.
 *
 * @since 1.0
 *
 * @file
 * @ingroup SubPageList
 *
 * @licence GNU GPL v2+
 * @author Jeroen De Dauw < jeroendedauw@gmail.com >
 */
class SimpleCacheInvalidator implements CacheInvalidator {

	/**
	 * @since 1.0
	 *
	 * @var SubPageFinder
	 */
	protected $subPageFinder;

	/**
	 * Constructor.
	 *
	 * @since 1.0
	 *
	 * @param SubPageFinder $subPageFinder
	 */
	public function __construct( SubPageFinder $subPageFinder ) {
		$this->subPageFinder = $subPageFinder;
	}

	/**
	 * @see CacheInvalidator::invalidateCaches
	 *
	 * @since 1.0
	 *
	 * @param Title $title
	 */
	public function invalidateCaches( Title $title ) {
		$pageSegments = explode( '/', $title->getDBkey() );

		$rootTitle = Title::newFromText( $pageSegments[0] );

		if ( $rootTitle === null ) {
			return;
		}

		$subPages = $this->subPageFinder->getSubPagesFor( $rootTitle );

		foreach ( $subPages as $subPage ) {
			$subPage->invalidateCache();
		}
	}

}
