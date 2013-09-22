<?php

namespace SubPageList\UI\PageRenderer;

use SubPageList\Page;

/**
 * @since 1.0
 *
 * @licence GNU GPL v2+
 * @author Jeroen De Dauw < jeroendedauw@gmail.com >
 */
class LinkingPageRenderer extends PageRenderer {

	/**
	 * @see PageRenderer::renderPage
	 *
	 * @param Page $page
	 *
	 * @return string
	 */
	public function renderPage( Page $page ) {
		return '[[' . $page->getTitle()->getFullText() . '|' . $page->getTitle()->getFullText() . ']]';
	}

}
