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
class LinkingPageRenderer extends PageRenderingBehaviour {

	/**
	 * @see PageRenderingBehaviour::renderPage
	 *
	 * @param Page $page
	 *
	 * @return string
	 */
	public function renderPage( Page $page ) {
		return '[[' . $page->getTitle()->getFullText() . '|' . $page->getTitle()->getFullText() . ']]';
	}

}
