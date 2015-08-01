<?php

namespace SubPageList\Lister\UI;

use SubPageList\Lister\Page;
use SubPageList\Lister\PageSorter;
use SubPageList\Lister\UI\PageRenderer\PageRenderer;

/**
 * @since 1.2
 *
 * @licence GNU GPL v2+
 * @author Jeroen De Dauw < jeroendedauw@gmail.com >
 */
class TreeListRenderer extends HierarchyRenderer {

	const FORMAT_OL = 'ol';
	const FORMAT_UL = 'ul';

	private $pageRenderer;
	private $pageSorter;
	private $formatName;

	public function __construct( PageRenderer $pageRenderer, PageSorter $pageSorter, $format = self::FORMAT_UL ) {
		$this->pageRenderer = $pageRenderer;
		$this->pageSorter = $pageSorter;

		$this->formatName = $format;
	}

	/**
	 * @see HierarchyRenderingBehaviour::renderHierarchy
	 *
	 * @param Page[] $pages
	 *
	 * @return string
	 */
	public function renderHierarchy( array $pages ) {
		$initialIndentLevel = count( $pages ) === 1 ? 0 : 1;

		$texts = array();

		foreach ( $pages as $page ) {
			$texts[] = $this->renderPage( $page, $initialIndentLevel );
		}

		return implode( "\n", $texts );
	}

	private function renderPage( Page $page, $indentationLevel ) {
		$wikiText = array();

		$wikiText[] = $this->getTextForPage( $page, $indentationLevel );
		$wikiText[] = $this->getTextForSubPages( $page, $indentationLevel );

		return trim( implode( "\n", $wikiText ) );
	}

	private function getTextForSubPages( Page $page, $indentationLevel ) {
		$indentationLevel++;
		return $this->renderSubPages( $page, $indentationLevel );
	}

	private function getTextForPage( Page $page, $indentationLevel ) {
		$lineContent = $this->pageRenderer->renderPage( $page );
		return $this->getIndentedLine( $lineContent, $indentationLevel );
	}

	private function getIndentedLine( $lineContent, $indentationLevel ) {
		if ( $indentationLevel > 0 ) {
			$char = $this->getIndentCharacter();
			$lineContent = str_repeat( $char, $indentationLevel ) . ' ' . $lineContent;
		}

		return $lineContent;
	}

	private function getIndentCharacter() {
		$chars = array(
			self::FORMAT_OL => '#',
			self::FORMAT_UL => '*',
		);

		return $chars[$this->formatName];
	}

	private function renderSubPages( Page $page, $indentationLevel ) {
		$texts = array();

		foreach ( $this->pageSorter->getSortedPages( $page->getSubPages() ) as $subPage ) {
			$texts[] = $this->renderPage( $subPage, $indentationLevel );
		}

		return implode( "\n", $texts );
	}

}
