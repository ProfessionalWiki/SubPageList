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
	 * Render a list of top level pages and their sub pages.
	 *
	 * @param Page[] $pages
	 *
	 * @return string
	 */
	public abstract function renderHierarchy( array $pages );

}