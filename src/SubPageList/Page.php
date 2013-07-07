<?php

namespace SubPageList;

use Title;

/**
 * Represents a node in a sub page hierarchy.
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
 * @ingroup SubPageList
 *
 * @licence GNU GPL v2+
 * @author Jeroen De Dauw < jeroendedauw@gmail.com >
 */
class Page {

	/**
	 * @since 1.0
	 *
	 * @var Title
	 */
	protected $title;

	/**
	 * @since 1.0
	 *
	 * @var Page[]
	 */
	protected $subPages = array();

	/**
	 * @since 1.0
	 *
	 * @param Title $title
	 * @param Page[] $subPages
	 */
	public function __construct( Title $title, array $subPages = array() ) {
		$this->title = $title;

		foreach ( $subPages as $subPage ) {
			$this->addSubPage( $subPage );
		}
	}

	/**
	 * @since 1.0
	 *
	 * @return Title
	 */
	public function getTitle() {
		return $this->title;
	}

	/**
	 * @since 1.0
	 *
	 * @return Page[]
	 */
	public function getSubPages() {
		return $this->subPages;
	}

	/**
	 * @since 0.1
	 *
	 * @param Page $page
	 */
	public function addSubPage( Page $page ) {
		$this->subPages[] = $page;
	}

}
