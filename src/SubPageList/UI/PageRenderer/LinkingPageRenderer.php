<?php

namespace SubPageList\UI\PageRenderer;

use SubPageList\Page;
use Title;

/**
 * @since 1.0
 *
 * @licence GNU GPL v2+
 * @author Jeroen De Dauw < jeroendedauw@gmail.com >
 */
class LinkingPageRenderer extends PageRenderer {

	const PATH_FULL = 'full'; // Namespace:Foo/Bar/Baz
	const PATH_NO_NS = 'noNs'; // Foo/Bar/Baz
	const PATH_NONE = 'none'; // Baz
	const PATH_SUB_PAGE = 'subPage'; //

	private $pathStyle;

	public function __construct( $pathStyle = self::PATH_FULL ) {
		$this->pathStyle = $pathStyle;
	}

	/**
	 * @see PageRenderer::renderPage
	 *
	 * @param Page $page
	 *
	 * @return string
	 */
	public function renderPage( Page $page ) {
		return '[[' . $page->getTitle()->getFullText() . '|' . $this->getLinkText( $page ) . ']]';
	}

	protected function getLinkText( Page $page ) {
		$title = $page->getTitle();

		if ( $this->pathStyle === self::PATH_NONE ) {
			return $this->getBaseText( $title );
		}

		if ( $this->pathStyle === self::PATH_NO_NS ) {
			return $this->stripNs( $title->getFullText() );
		}

		if ( $this->pathStyle === self::PATH_SUB_PAGE ) {
			return $title->getSubpageText();
		}

		return $title->getFullText();
	}

	protected function getBaseText( Title $title ) {
		return $this->stripNs( $title->getSubpageText() );
	}

	protected function stripNs( $text ) {
		$namespacePosition = strpos( $text, ':' );

		if ( $namespacePosition !== false ) {
			$text = substr( $text, $namespacePosition + 1 );
		}

		return $text;
	}

}
