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
	 * The $options parameter is an array containing string
	 * keys that are option names. The values are mixed.
	 * The interface does not define which options can be,
	 * or should be, supported by the implementing class.
	 * 
	 * @param Page $page
	 *
	 * @return string
	 */
	public abstract function renderHierarchy( Page $page, array $options );

}