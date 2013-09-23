<?php

namespace SubPageList\UI;

use Html;
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

	protected $options;
	protected $text;

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

	protected function addHeader() {
		$this->text .= $this->options['intro'];
	}

	protected function addFooter() {
		$this->text .= $this->options['outro'];
	}

	protected function addPageHierarchy( Page $page ) {
		$this->text .= $this->newTreeListRenderer()->renderHierarchy( $page, $this->options );
	}

	// TODO: this construction logic does not really fit into this class, split off
	protected function newTreeListRenderer() {
		$options = array(
			TreeListRenderer::OPT_SHOW_TOP_PAGE => $this->options['showpage'],
		);

		if ( $this->options['kidsonly'] ) {
			$options[TreeListRenderer::OPT_MAX_DEPTH] = 1;
		}

		return new TreeListRenderer(
			$this->newPageRenderer(),
			$this->newPageSorter(),
			$options
		);
	}

	protected function newPageRenderer() {
		$renderer = new PlainPageRenderer( $this->getPathStyle() );

		if ( $this->options['template'] !== '' ) {
			$renderer = new TemplatePageRenderer( $renderer, $this->options['template'] );
		}
		else if ( $this->options['links'] ) {
			$renderer = new LinkingPageRenderer( $renderer );
		}

		return $renderer;
	}

	protected function getPathStyle() {
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

	protected function newPageSorter() {
		return new AlphabeticPageSorter( $this->options['sort'] );
	}

	protected function wrapInElement( $text ) {
		return Html::element(
			$this->options['element'],
			array(
				'class' => $this->options['class']
			),
			$text
		);
	}

}
