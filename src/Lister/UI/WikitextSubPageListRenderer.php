<?php

namespace SubPageList\Lister\UI;

use Html;
use RuntimeException;
use SubPageList\Lister\Page;

/**
 * @since 1.2
 *
 * @licence GNU GPL v2+
 * @author Jeroen De Dauw < jeroendedauw@gmail.com >
 */
class WikitextSubPageListRenderer implements SubPageListRenderer {

	private $options;
	private $text;

	/**
	 * @var HierarchyRendererFactory
	 */
	private $hierarchyRendererFactory;

	public function __construct() {
		$this->hierarchyRendererFactory = new HierarchyRendererFactory();
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
		$this->addFooter();

		return $this->wrapInElement( $this->text );
	}

	private function addHeader() {
		if ( $this->options['intro'] !== '' ) {
			$this->text .= $this->options['intro'] . "\n";
		}
	}

	private function addFooter() {
		if ( $this->options['outro'] !== '' ) {
			$this->text .= "\n". $this->options['outro'];
		}
	}

	private function addPageHierarchy( Page $page ) {
		$this->text .= $this->hierarchyRendererFactory->newTreeListRenderer( $this->options )->renderHierarchy( $page );
	}

	private function wrapInElement( $text ) {
		$this->assertElementIsAllowed();

		if ($this->options['element']!='none')
		{
			return Html::element(
				$this->options['element'],
				array(
					'class' => $this->options['class']
				),
				"\n" . $text . "\n"
			);
		} else return $text;
	}

	private function assertElementIsAllowed() {
		$allowedElements = array(
			'p',
			'div',
			'span',
			'none'
		);

		if ( !in_array( $this->options['element'], $allowedElements ) ) {
			throw new RuntimeException(
				'Got an unsupported value for the element option: ' . $this->options['element']
			);
		}
	}

}
