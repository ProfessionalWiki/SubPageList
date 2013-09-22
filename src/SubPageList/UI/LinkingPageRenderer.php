<?php

namespace SubPageList\UI;

use SubPageList\Page;

/**
 * @since 1.0
 *
 * @licence GNU GPL v2+
 * @author Jeroen De Dauw < jeroendedauw@gmail.com >
 */
class LinkingPageRenderer extends PageRenderingBehaviour {

	/**
	 * @see PageRenderingBehaviour::renderPage
	 *
	 * @param Page $page
	 * @param array $options
	 *
	 * @return string
	 */
	public function renderPage( Page $page, array $options ) {
		return '[[' . $page->getTitle()->getFullText() . '|' . $page->getTitle()->getFullText() . ']]';
	}

}
