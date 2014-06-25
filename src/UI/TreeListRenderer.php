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

	const OPT_SHOW_TOP_PAGE = 'topPage';
	const OPT_FORMAT = 'format';
	const OPT_MAX_DEPTH = 'maxIndent';

	const FORMAT_OL = 'ol';
	const FORMAT_UL = 'ul';

	const NO_LIMIT = 'noLimit';

	private $pageRenderer;
	private $pageSorter;

	public function __construct( PageRenderer $pageRenderer, PageSorter $pageSorter, array $options = array() ) {
		$this->pageRenderer = $pageRenderer;
		$this->pageSorter = $pageSorter;

		$this->options = array_merge(
			array(
				self::OPT_SHOW_TOP_PAGE => true,
				self::OPT_FORMAT => self::FORMAT_UL,
				self::OPT_MAX_DEPTH => self::NO_LIMIT,
			),
			$options
		);
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

	private function renderPage( Page $page, $indentationLevel ) {
		$wikiText = array();

		$wikiText[] = $this->getTextForPageItself( $page, $indentationLevel );
		$wikiText[] = $this->getTextForSubPages( $page, $indentationLevel );

		return trim( implode( "\n", $wikiText ) );
	}

	private function getTextForPageItself( Page $page, $indentationLevel ) {
		$wikiText = '';

		if ( $this->shouldShowPage( $indentationLevel ) ) {
			$wikiText .= $this->getTextForPage( $page, $indentationLevel );
		}

		return $wikiText;
	}

	private function shouldShowPage( $indentationLevel ) {
		return $indentationLevel !== 0 || $this->options[self::OPT_SHOW_TOP_PAGE];
	}

	private function getTextForSubPages( Page $page, $indentationLevel ) {
		$indentationLevel++;

		if ( $this->shouldShowSubPages( $indentationLevel ) ) {
			return $this->renderSubPages( $page, $indentationLevel );
		}

		return '';
	}

	private function shouldShowSubPages( $indentationLevel ) {
		$maxDepth = $this->options[self::OPT_MAX_DEPTH];
		return $maxDepth === self::NO_LIMIT || $indentationLevel <= $maxDepth;
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

		return $chars[$this->options[self::OPT_FORMAT]];
	}

	private function renderSubPages( Page $page, $indentationLevel ) {
		$texts = array();

		foreach ( $this->pageSorter->getSortedPages( $page->getSubPages() ) as $subPage ) {
			$texts[] = $this->renderPage( $subPage, $indentationLevel );
		}

		return implode( "\n", $texts );
	}

}
