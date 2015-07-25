<?php

namespace SubPageList\Lister\UI\PageRenderer;

use SubPageList\Lister\Page;

/**
 * @since 1.2
 *
 * @licence GNU GPL v2+
 * @author Jeroen De Dauw < jeroendedauw@gmail.com >
 */
class LinkingPageRenderer extends PageRenderer {

	private $textRenderer;

	public function __construct( PageRenderer $textRenderer ) {
		$this->textRenderer = $textRenderer;
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

	private function getLinkText( Page $page ) {
		return $this->textRenderer->renderPage( $page );
	}

}
