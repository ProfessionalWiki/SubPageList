<?php

namespace SubPageList\UI;

use Html;
use RuntimeException;
use SubPageList\AlphabeticPageSorter;
use SubPageList\Page;
use SubPageList\UI\PageRenderer\LinkingPageRenderer;
use SubPageList\UI\PageRenderer\PlainPageRenderer;
use SubPageList\UI\PageRenderer\TemplatePageRenderer;

/**
 * @since 1.0
 *
 * @licence GNU GPL v2+
 * @author Jeroen De Dauw < jeroendedauw@gmail.com >
 */
class WikitextSubPageListRenderer implements SubPageListRenderer {

	private $options;
	private $text;

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
		$this->text .= $this->newTreeListRenderer()->renderHierarchy( $page, $this->options );
	}

	// TODO: this construction logic does not really fit into this class, split off
	private function newTreeListRenderer() {
		$options = array(
			TreeListRenderer::OPT_SHOW_TOP_PAGE => $this->options['showpage'],
		);

		if ( $this->options['kidsonly'] ) {
			$options[TreeListRenderer::OPT_MAX_DEPTH] = 1;
		}

		if ( $this->options['format'] === 'ol' ) {
			$options[TreeListRenderer::OPT_FORMAT] = TreeListRenderer::FORMAT_OL;
		}

		return new TreeListRenderer(
			$this->newPageRenderer(),
			$this->newPageSorter(),
			$options
		);
	}

	private function newPageRenderer() {
		$renderer = new PlainPageRenderer( $this->getPathStyle() );

		if ( $this->options['template'] !== '' ) {
			$renderer = new TemplatePageRenderer( $renderer, $this->options['template'] );
		}
		else if ( $this->options['links'] ) {
			$renderer = new LinkingPageRenderer( $renderer );
		}

		return $renderer;
	}

	private function getPathStyle() {
		$styles = array(
			'none' => PlainPageRenderer::PATH_NONE,
			'no' => PlainPageRenderer::PATH_NONE,

			'subpagename' => PlainPageRenderer::PATH_SUB_PAGE,
			'children' => PlainPageRenderer::PATH_SUB_PAGE,
			'notparent' => PlainPageRenderer::PATH_SUB_PAGE,

			'full' => PlainPageRenderer::PATH_FULL,
			'fullpagename' => PlainPageRenderer::PATH_FULL,

			'pagename' => PlainPageRenderer::PATH_NO_NS,
		);

		return $styles[$this->options['pathstyle']];
	}

	private function newPageSorter() {
		return new AlphabeticPageSorter( $this->options['sort'] );
	}

	private function wrapInElement( $text ) {
		$this->assertElementIsAllowed();

		return Html::element(
			$this->options['element'],
			array(
				'class' => $this->options['class']
			),
			"\n" . $text . "\n"
		);
	}

	private function assertElementIsAllowed() {
		$allowedElements = array(
			'p',
			'div',
			'span'
		);

		if ( !in_array( $this->options['element'], $allowedElements ) ) {
			throw new RuntimeException(
				'Got an unsupported value for the element option: ' . $this->options['element']
			);
		}
	}

}
