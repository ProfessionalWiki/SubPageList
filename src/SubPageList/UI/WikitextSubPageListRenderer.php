<?php

namespace SubPageList\UI;

use SubPageList\Page;

/**
 * @since 1.0
 *
 * @licence GNU GPL v2+
 * @author Jeroen De Dauw < jeroendedauw@gmail.com >
 */
class WikitextSubPageListRenderer implements SubPageListRenderer {

	protected $hierarchyRenderer;

	protected $options;
	protected $text;

	public function __construct( HierarchyRenderingBehaviour $hierarchyRenderer ) {
		$this->hierarchyRenderer = $hierarchyRenderer;
	}

	/**
	 * @see SubPageListRenderer::render
	 *
	 * @param Page $page
	 * @param array $options
	 *
	 * @return string
	 */
	public function render( Page $page, array $options ) {
		$this->options = $options;
		$this->text = '';

		$this->addHeader();
		$this->addPageHierarchy( $page );

		return $this->text;
	}

	protected function addHeader() {
		$this->text .= $this->options['intro'];
	}

	protected function addPageHierarchy( Page $page ) {
		$this->text .= $this->hierarchyRenderer->renderHierarchy( $page );
	}

}
