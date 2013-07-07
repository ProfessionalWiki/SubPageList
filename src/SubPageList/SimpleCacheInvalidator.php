<?php

namespace SubPageList;

use Title;

/**
 * Naive cache invalidator that invalidates subpages and the top parent page.
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License along
 * with this program; if not, write to the Free Software Foundation, Inc.,
 * 51 Franklin Street, Fifth Floor, Boston, MA 02110-1301, USA.
 * http://www.gnu.org/copyleft/gpl.html
 *
 * @since 1.0
 *
 * @file
 * @ingroup SPL
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
