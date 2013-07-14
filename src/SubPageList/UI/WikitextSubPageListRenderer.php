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
class WikitextSubPageListRenderer implements SubPageListRenderer {

	protected $hierarchyRenderer;

	public function __construct( HierarchyRenderingBehaviour $hierarchyRenderer ) {
		$this->hierarchyRenderer = $hierarchyRenderer;
	}

	/**
	 * @see SubPageListRenderer::render
	 *
	 * @param Page $page
	 *
	 * @return string
	 */
	public function render( Page $page ) {
		return $this->hierarchyRenderer->renderHierarchy( $page );
	}

}
