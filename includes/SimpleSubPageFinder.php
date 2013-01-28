<?php

namespace SubPageList;
use Title, TitleArray;

/**
 * Simple subpage finder that uses the page table to find subpages.
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
class SimpleSubPageFinder implements SubPageFinder {

	/**
	 * @since 1.0
	 *
	 * @var null|DBConnectionProvider
	 */
	protected $connectionProvider;

	/**
	 * @since 1.0
	 *
	 * @param DBConnectionProvider|null $connectionProvider
	 */
	public function __construct( DBConnectionProvider $connectionProvider = null ) {
		$this->connectionProvider = $connectionProvider;
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
		$dbr = $this->connectionProvider->getConnection();

		$titleArray = TitleArray::newFromResult(
			$dbr->select( 'page',
				array( 'page_id', 'page_namespace', 'page_title', 'page_is_redirect' ),
				array(
					'page_namespace' => $title->getNamespace(),
					'page_title' => $dbr->buildLike( $title->getDBkey() . '/', $dbr->anyString() )
				),
				__METHOD__,
				array( 'LIMIT' => 500 )
			)
		);

		return iterator_to_array( $titleArray );
	}

}
