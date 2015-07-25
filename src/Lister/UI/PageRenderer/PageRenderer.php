<?php

namespace SubPageList\Lister\UI\PageRenderer;

use SubPageList\Lister\Page;

/**
 * @since 1.2
 *
 * @licence GNU GPL v2+
 * @author Jeroen De Dauw < jeroendedauw@gmail.com >
 */
abstract class PageRenderer {

	/**
	 * Render the representation for a page.
	 * This does not include doing the same for all its sub pages.
	 *
	 * @param Page $page
	 *
	 * @return string
	 */
	public abstract function renderPage( Page $page );

}