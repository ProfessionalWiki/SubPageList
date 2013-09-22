<?php

namespace SubPageList\UI;

use SubPageList\Page;

/**
 * @since 1.0
 *
 * @licence GNU GPL v2+
 * @author Jeroen De Dauw < jeroendedauw@gmail.com >
 */
abstract class HierarchyRenderingBehaviour {

	/**
	 * Render a page and its sub pages.
	 *
	 * @param Page $page
	 *
	 * @return string
	 */
	public abstract function renderHierarchy( Page $page );

}