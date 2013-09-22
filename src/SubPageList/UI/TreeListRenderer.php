<?php

namespace SubPageList\UI;

use SubPageList\Page;
use SubPageList\PageSorter;
use SubPageList\UI\PageRenderer\PageRenderer;

/**
 * @since 1.0
 *
 * @licence GNU GPL v2+
 * @author Jeroen De Dauw < jeroendedauw@gmail.com >
 */
class TreeListRenderer extends HierarchyRenderingBehaviour {

	const SHOW_TOP_PAGE = true;
	const HIDE_TOP_PAGE = false;

	protected $pageRenderer;
	protected $pageSorter;
	protected $showTopLevelPage;

	public function __construct( PageRenderer $pageRenderer, PageSorter $pageSorter, $showPage = self::SHOW_TOP_PAGE ) {
		$this->pageRenderer = $pageRenderer;
		$this->pageSorter = $pageSorter;
		$this->showTopLevelPage = $showPage;
	}

	/**
	 * @see HierarchyRenderingBehaviour::renderHierarchy
	 *
	 * @param Page $page
	 *
	 * @return string
	 */
	public function renderHierarchy( Page $page ) {
		return $this->renderPage( $page, 0 );
	}

	protected function renderPage( Page $page, $indentationLevel ) {
		$wikiText = '';

		if ( $this->shouldShowPage( $indentationLevel ) ) {
			$wikiText .= $this->getTextForPage( $page, $indentationLevel );
			$wikiText .= "\n";
		}

		$wikiText .= $this->renderSubPages( $page, $indentationLevel + 1 );

		return $wikiText;
	}

	protected function shouldShowPage( $indentationLevel ) {
		return $indentationLevel !== 0 || $this->showTopLevelPage;
	}

	protected function getTextForPage( Page $page, $indentationLevel ) {
		$lineContent = $this->pageRenderer->renderPage( $page );
		return $this->getIndentedLine( $lineContent, $indentationLevel );
	}

	protected function getIndentedLine( $lineContent, $indentationLevel ) {
		if ( $indentationLevel > 0 ) {
			$lineContent = str_repeat( '*', $indentationLevel ) . ' ' . $lineContent;
		}

		return $lineContent;
	}

	protected function renderSubPages( Page $page, $indentationLevel ) {
		$texts = array();

		foreach ( $this->pageSorter->getSortedPages( $page->getSubPages() ) as $subPage ) {
			$texts[] = $this->renderPage( $subPage, $indentationLevel );
		}

		return implode( '', $texts );
	}

}
