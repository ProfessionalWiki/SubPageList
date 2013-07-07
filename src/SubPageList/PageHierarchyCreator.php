<?php

namespace SubPageList;

use InvalidArgumentException;
use Title;

/**
 * Turns a flat list of Title objects into a sub page hierarchy of Page objects.
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
class PageHierarchyCreator {

	/**
	 * @var Page[]
	 */
	protected $pages;

	/**
	 * @var TitleFactory
	 */
	protected $titleFactory;

	public function __construct( TitleFactory $titleFactory ) {
		$this->titleFactory = $titleFactory;
	}

	/**
	 * @param Title[] $titles
	 *
	 * @return Page[]
	 */
	public function createHierarchy( array $titles ) {
		$this->assertAreTitles( $titles );

		$this->pages = array();

		foreach ( $titles as $title ) {
			$this->addTitle( $title );
		}

		return $this->pages;
	}

	protected function addTitle( Title $title ) {
		$page = new Page( $title, array() );
		$titleText = $this->getTextForTitle( $title );

		$parentTitle = $this->getParentTitle( $titleText );

		if ( $parentTitle === '' ) {
			$this->addTopLevelPage( $titleText, $page );
		}
		else {
			$this->createParents( $titleText );
			$this->addSubPage( $parentTitle, $page );
		}
	}

	protected function getTextForTitle( Title $title ) {
		return $title->getFullText();
	}

	protected function addTopLevelPage( $titleText, Page $page ) {
		if ( !array_key_exists( $titleText, $this->pages ) ) {
			$this->pages[$titleText] = $page;
		}
	}

	/**
	 * @param string $parentTitle
	 * @param Page $page
	 */
	protected function addSubPage( $parentTitle, Page $page ) {
		$this->pages[$parentTitle]->addSubPage( $page );
	}

	protected function createParents( $pageTitle ) {
		$titleParts = $this->getTitleParts( $pageTitle );
		array_pop( $titleParts );

		if ( empty( $titleParts ) ) {
			return;
		}

		$topLevelPage =  array_shift( $titleParts );

		$this->addTopLevelPage( $topLevelPage, $this->newPageFromText( $topLevelPage ) );

		$previousParts = array( $topLevelPage );

		foreach ( $titleParts as $titlePart ) {
			$parentTitle = $this->titleTextFromParts( $previousParts );

			$previousParts[] = $titlePart;

			$pageTitle = $this->titleTextFromParts( $previousParts );

			$this->addSubPage( $parentTitle, $this->newPageFromText( $pageTitle ) );
		}
	}

	protected function newPageFromText( $titleText ) {
		return new Page( $this->titleFactory->newFromText( $titleText ) );
	}

	protected function getTitleParts( $titleText ) {
		return explode( '/', $titleText );
	}

	protected function titleTextFromParts( array $titleParts ) {
		return implode( '/', $titleParts );
	}

	protected function getParentTitle( $titleText ) {
		$titleParts = $this->getTitleParts($titleText );
		array_pop( $titleParts );
		return $this->titleTextFromParts( $titleParts );
	}

	protected function assertAreTitles( array $titles ) {
		foreach ( $titles as $title ) {
			if ( !( $title instanceof Title ) ) {
				throw new InvalidArgumentException( 'All elements must be of instance Title' );
			}
		}
	}

}