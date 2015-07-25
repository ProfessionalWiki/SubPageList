<?php

namespace SubPageList\Lister\UI\PageRenderer;

use SubPageList\Lister\Page;

/**
 * @since 1.2
 *
 * @licence GNU GPL v2+
 * @author Jeroen De Dauw < jeroendedauw@gmail.com >
 */
class TemplatePageRenderer extends PageRenderer {

	private $textRenderer;
	private $templateName;

	public function __construct( PageRenderer $textRenderer, $templateName ) {
		$this->textRenderer = $textRenderer;
		$this->templateName = $templateName;
	}

	/**
	 * @see PageRenderer::renderPage
	 *
	 * @param Page $page
	 *
	 * @return string
	 */
	public function renderPage( Page $page ) {
		return '{{' . $this-> templateName . '|' . $this->getTitleText( $page ) . '}}';
	}

	private function getTitleText( Page $page ) {
		return $this->textRenderer->renderPage( $page );
	}

}
