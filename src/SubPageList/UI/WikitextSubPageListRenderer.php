<?php

namespace SubPageList\UI;

use SubPageList\Page;

/**
 * @since 1.0
 *
 * @file
 * @ingroup SubPageList
 *
 * @licence GNU GPL v2+
 * @author Jeroen De Dauw < jeroendedauw@gmail.com >
 */
class WikitextSubPageListRenderer implements SubPageListRenderer {

	/**
	 * @see SubPageListRenderer::render
	 *
	 * @param Page $page
	 *
	 * @return string
	 */
	public function render( Page $page ) {
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
		$lineContent = $this->buildLineContent( $page );
		return $this->getIndentedLine( $lineContent, $indentationLevel );
	}

	protected function buildLineContent( Page $page ) {
		return '[[' . $page->getTitle()->getFullText() . '|' . $page->getTitle()->getFullText() . ']]';
	}

	protected function getIndentedLine( $lineContent, $indentationLevel ) {
		if ( $indentationLevel > 0 ) {
			$lineContent = str_repeat( '*', $indentationLevel ) . ' ' . $lineContent;
		}

		return $lineContent;
	}

	protected function renderSubPages( Page $page, $indentationLevel ) {
		$texts = array();

		foreach ( $page->getSubPages() as $subPage ) {
			$texts[] = $this->renderPage( $subPage, $indentationLevel );
		}

		return implode( '', $texts );
	}

}