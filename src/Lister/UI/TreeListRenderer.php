<?php

namespace SubPageList\Lister\UI;

use SubPageList\Lister\Page;
use SubPageList\Lister\UI\PageRenderer\PageRenderer;

/**
 * @since 1.2
 *
 * @licence GNU GPL v2+
 * @author Jeroen De Dauw < jeroendedauw@gmail.com >
 */
class TreeListRenderer extends HierarchyRenderer {

	const OPT_SHOW_TOP_PAGE = 'topPage';
	const OPT_FORMAT = 'format';
	const OPT_MAX_DEPTH = 'maxIndent';
	const OPT_ADDLEVEL = 'addlevel';

	const FORMAT_OL = 'ol';
	const FORMAT_UL = 'ul';

	const NO_LIMIT = 'noLimit';

	private $pageRenderer;

	public function __construct( PageRenderer $pageRenderer, array $options = [] ) {
		$this->pageRenderer = $pageRenderer;

		$this->options = array_merge(
			[
				self::OPT_SHOW_TOP_PAGE => true,
				self::OPT_FORMAT => self::FORMAT_UL,
				self::OPT_MAX_DEPTH => self::NO_LIMIT,
				self::OPT_ADDLEVEL => 0,
			],
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
		$wikiText = [];

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
		$totalIndentLevel = $indentationLevel + $this->options[self::OPT_ADDLEVEL];

		if ( $totalIndentLevel > 0 ) {
			$char = $this->getIndentCharacter();
			$lineContent = str_repeat( $char, $totalIndentLevel ) . ' ' . $lineContent;
		}

		return $lineContent;
	}

	private function getIndentCharacter() {
		$chars = [
			self::FORMAT_OL => '#',
			self::FORMAT_UL => '*',
		];

		return $chars[$this->options[self::OPT_FORMAT]];
	}

	private function renderSubPages( Page $page, $indentationLevel ) {
		$texts = [];

		foreach ( $page->getSubPages() as $subPage ) {
			$texts[] = $this->renderPage( $subPage, $indentationLevel );
		}

		return implode( "\n", $texts );
	}

}
