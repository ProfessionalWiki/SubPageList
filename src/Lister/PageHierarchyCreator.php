<?php

namespace SubPageList\Lister;

use InvalidArgumentException;
use SubPageList\TitleFactory;
use Title;

/**
 * Turns a flat list of Title objects into a sub page hierarchy of Page objects.
 *
 * @since 1.2
 *
 * @licence GNU GPL v2+
 * @author Jeroen De Dauw < jeroendedauw@gmail.com >
 */
class PageHierarchyCreator {

	/**
	 * Top level pages.
	 *
	 * @var Page[]
	 */
	private $pages;

	/**
	 * All pages, indexed by title text.
	 *
	 * @var Page[]
	 */
	private $allPages;

	/**
	 * @var TitleFactory
	 */
	private $titleFactory;

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

		$this->pages = [];
		$this->allPages = [];

		foreach ( $titles as $title ) {
			$this->addTitle( $title );
		}

		return $this->pages;
	}

	private function addTitle( Title $title ) {
		$page = new Page( $title, [] );
		$titleText = $this->getTextForTitle( $title );

		$parentTitle = $this->getParentTitle( $titleText );

		if ( $parentTitle === '' ) {
			$this->addTopLevelPage( $titleText, $page );
		}
		else {
			$this->createParents( $titleText );
			$this->addSubPage( $parentTitle, $titleText, $page );
		}
	}

	private function getTextForTitle( Title $title ) {
		return $title->getFullText();
	}

	/**
	 * @param string $titleText
	 * @param Page $page Page is expected to not have any subpages
	 */
	private function addTopLevelPage( $titleText, Page $page ) {
		if ( !array_key_exists( $titleText, $this->allPages ) ) {
			$this->pages[] = $page;
			$this->allPages[$titleText] = $page;
		}
	}

	/**
	 * @param string $parentTitle
	 * @param string $pageTitle
	 * @param Page $page Page is expected to not have any subpages
	 */
	private function addSubPage( $parentTitle, $pageTitle, Page $page ) {
		if ( !array_key_exists( $pageTitle, $this->allPages ) ) {
			$this->allPages[$parentTitle]->addSubPage( $page );
			$this->allPages[$pageTitle] = $page;
		}
	}

	private function createParents( $pageTitle ) {
		$titleParts = $this->getTitleParts( $pageTitle );
		array_pop( $titleParts );

		if ( empty( $titleParts ) ) {
			return;
		}

		$topLevelPage =  array_shift( $titleParts );

		$this->addTopLevelPage( $topLevelPage, $this->newPageFromText( $topLevelPage ) );

		$previousParts = [ $topLevelPage ];

		foreach ( $titleParts as $titlePart ) {
			$parentTitle = $this->titleTextFromParts( $previousParts );

			$previousParts[] = $titlePart;

			$pageTitle = $this->titleTextFromParts( $previousParts );

			$this->addSubPage( $parentTitle, $pageTitle, $this->newPageFromText( $pageTitle ) );
		}
	}

	private function newPageFromText( $titleText ) {
		return new Page( $this->titleFactory->newFromText( $titleText ) );
	}

	private function getTitleParts( $titleText ) {
		return explode( '/', $titleText );
	}

	private function titleTextFromParts( array $titleParts ) {
		return implode( '/', $titleParts );
	}

	private function getParentTitle( $titleText ) {
		$titleParts = $this->getTitleParts($titleText );
		array_pop( $titleParts );
		return $this->titleTextFromParts( $titleParts );
	}

	private function assertAreTitles( array $titles ) {
		foreach ( $titles as $title ) {
			if ( !( $title instanceof Title ) ) {
				throw new InvalidArgumentException( 'All elements must be of instance Title' );
			}
		}
	}

}