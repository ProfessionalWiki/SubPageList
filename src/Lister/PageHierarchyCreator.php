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

	/**
	 * @param TitleFactory $titleFactory
	 */
	public function __construct( TitleFactory $titleFactory ) {
		$this->titleFactory = $titleFactory;
	}

	/**
	 * @param Title $titles
	 * @param Title $rootTitle
	 *
	 * @return Page[]
	 */
	public function createHierarchy( array $titles, Title $rootTitle ) {
		$this->assertAreTitles( $titles );

		$this->pages = [];
		$this->allPages = [];

		foreach ( $titles as $title ) {
			$this->addTitle( $title, $rootTitle );
		}

		return $this->pages;
	}

	/**
	 * @param Title $title
	 * @param Title $rootTitle
	 *
	 * @return void
	 */
	private function addTitle( Title $title, Title $rootTitle ) {
		$page = new Page( $title, [] );
		$titleText = $this->getTextForTitle( $title );
		if ( $titleText === $this->getTextForTitle( $rootTitle ) ) {
			$this->addTopLevelPage( $titleText, $page );
		} else {
			$parentTitle = $this->getParentTitle( $titleText );
			$this->createParents( $titleText, $rootTitle );
			$this->addSubPage( $parentTitle, $titleText, $page );
		}
	}

	/**
	 * @param Title $title
	 *
	 * @return string|null
	 */
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

	/**
	 * @param string $pageTitle
	 * @param Title $rootTitle
	 *
	 * @return void
	 */
	private function createParents( $pageTitle, Title $rootTitle ) {
		$topLevelPage = $this->getTextForTitle( $rootTitle );
		if ( strpos( $pageTitle, $topLevelPage ) !== 0 ) {
			throw new InvalidArgumentException( 'The root title is not a parent of the page title' );
		}
		// Remove root page from page title being evaluated
		$pageTitle = substr( $pageTitle, strlen( $topLevelPage . '/' ) );
		$titleParts = $this->getTitleParts( $pageTitle );
		// Make sure top-level-page is added before trying to add subpages
		$this->addTopLevelPage( $topLevelPage, $this->newPageFromText( $topLevelPage ) );
		if ( empty( $titleParts ) ) {
			return;
		}

		$previousParts = [ $topLevelPage ];

		foreach ( $titleParts as $titlePart ) {
			$parentTitle = $this->titleTextFromParts( $previousParts );

			$previousParts[] = $titlePart;

			$pageTitle = $this->titleTextFromParts( $previousParts );

			$this->addSubPage( $parentTitle, $pageTitle, $this->newPageFromText( $pageTitle ) );
		}
	}

	/**
	 * @param string $titleText
	 *
	 * @return Page
	 */
	private function newPageFromText( $titleText ) {
		return new Page( $this->titleFactory->newFromText( $titleText ) );
	}

	/**
	 * @param string $titleText
	 *
	 * @return false|string[]
	 */
	private function getTitleParts( $titleText ) {
		return explode( '/', $titleText );
	}

	/**
	 * @param array $titleParts
	 *
	 * @return string
	 */
	private function titleTextFromParts( array $titleParts ) {
		return implode( '/', $titleParts );
	}

	/**
	 * @param string $titleText
	 *
	 * @return string
	 */
	private function getParentTitle( $titleText ) {
		$titleParts = $this->getTitleParts($titleText );
		array_pop( $titleParts );
		return $this->titleTextFromParts( $titleParts );
	}

	/**
	 * @param array $titles
	 *
	 * @return void
	 */
	private function assertAreTitles( array $titles ) {
		foreach ( $titles as $title ) {
			if ( !( $title instanceof Title ) ) {
				throw new InvalidArgumentException( 'All elements must be of instance Title' );
			}
		}
	}

}
