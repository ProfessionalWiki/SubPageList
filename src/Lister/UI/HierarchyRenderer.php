<?php

namespace SubPageList\Lister\UI;

use SubPageList\Lister\Page;

/**
 * @since 1.2
 *
 * @licence GNU GPL v2+
 * @author Jeroen De Dauw < jeroendedauw@gmail.com >
 */
abstract class HierarchyRenderer {

	/**
	 * Render a page and its sub pages.
	 *
	 * @param Page $page
	 *
	 * @return string
	 */
	public abstract function renderHierarchy( Page $page );

}