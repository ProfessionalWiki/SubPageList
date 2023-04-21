<?php

namespace SubPageList\Lister\UI\PageRenderer;

use PageProps;
use SubPageList\Lister\Page;
use Title;

/**
 * @since 1.2
 *
 * @licence GNU GPL v2+
 * @author Jeroen De Dauw < jeroendedauw@gmail.com >
 */
class PlainPageRenderer extends PageRenderer {

	const PATH_FULL = 'full'; // Namespace:Foo/Bar/Baz
	const PATH_NO_NS = 'noNs'; // Foo/Bar/Baz
	const PATH_NONE = 'none'; // Baz
	const PATH_SUB_PAGE = 'subPage'; // Baz (for full page Foo:Bar it is Foo:Bar)
	const PATH_DISPLAYTITLE = 'displayTitle';

	/** @var PageProps */
	private $pageProps;

	private $pathStyle;

	public function __construct( PageProps $pageProps, $pathStyle = self::PATH_FULL ) {
		$this->pathStyle = $pathStyle;
		$this->pageProps = $pageProps;
	}

	/**
	 * @see PageRenderer::renderPage
	 *
	 * @param Page $page
	 *
	 * @return string
	 */
	public function renderPage( Page $page ) {
		$title = $page->getTitle();

		if ( $this->pathStyle === self::PATH_DISPLAYTITLE ) {
			return $this->getPageDisplayTitle( $title );
		}

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

	private function getBaseText( Title $title ) {
		return $this->stripNs( $title->getSubpageText() );
	}

	private function stripNs( $text ) {
		$namespacePosition = strpos( $text, ':' );

		if ( $namespacePosition !== false ) {
			$text = substr( $text, $namespacePosition + 1 );
		}

		return $text;
	}

	/**
	 * @param Title $title
	 *
	 * @return string
	 */
	private function getPageDisplayTitle( Title $title ) {
		$props = $this->pageProps->getProperties( $title, [ 'displaytitle' ] );
		if ( isset( $props[$title->getArticleID()] ) && isset( $props[$title->getArticleID()]['displaytitle'] ) ) {
			return (string) $props[$title->getArticleID()]['displaytitle'];
		}

		return $title->getSubpageText();
	}

}
