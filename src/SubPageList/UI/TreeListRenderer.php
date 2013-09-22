<?php

namespace SubPageList\UI;

use SubPageList\Page;

/**
 * @since 1.0
 *
 * @licence GNU GPL v2+
 * @author Jeroen De Dauw < jeroendedauw@gmail.com >
 */
class TreeListRenderer extends HierarchyRenderingBehaviour {

	protected $pageRenderer;

	protected $options;

	public function __construct( PageRenderingBehaviour $pageRenderer ) {
		$this->pageRenderer = $pageRenderer;
	}

	/**
	 * @see HierarchyRenderingBehaviour::renderHierarchy
	 *
	 * @param Page $page
	 * @param array $options
	 *
	 * @return string
	 */
	public function renderHierarchy( Page $page, array $options ) {
		$this->options = $options;
		return $this->renderPage( $page, 0 );
	}

	protected function renderPage( Page $page, $indentationLevel ) {
		$wikiText = '';

		$wikiText .= $this->getTextForPage( $page, $indentationLevel );
		$wikiText .= "\n";
		$wikiText .= $this->renderSubPages( $page, $indentationLevel + 1 );

		return $wikiText;
	}

	protected function getTextForPage( Page $page, $indentationLevel ) {
		$lineContent = $this->pageRenderer->renderPage( $page, $this->options );
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

		foreach ( $this->getSortedSubPages( $page->getSubPages() ) as $subPage ) {
			$texts[] = $this->renderPage( $subPage, $indentationLevel );
		}

		return implode( '', $texts );
	}

	/**
	 * @param Page[] $subPages
	 *
	 * @return Page[]
	 */
	protected function getSortedSubPages( array $subPages ) {
		$sortAscending = $this->options['sort'] === 'asc';

		usort(
			$subPages,
			function( Page $a, Page $b ) use ( $sortAscending ) {
				return $sortAscending xor $a->getTitle()->getFullText() < $b->getTitle()->getFullText();
			}
		);

		return $subPages;
	}

}