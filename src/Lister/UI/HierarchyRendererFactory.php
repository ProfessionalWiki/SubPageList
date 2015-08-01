<?php

namespace SubPageList\Lister\UI;

use SubPageList\Lister\AlphabeticPageSorter;
use SubPageList\Lister\UI\PageRenderer\LinkingPageRenderer;
use SubPageList\Lister\UI\PageRenderer\PlainPageRenderer;
use SubPageList\Lister\UI\PageRenderer\TemplatePageRenderer;

/**
 * @since 1.2
 *
 * @licence GNU GPL v2+
 * @author Jeroen De Dauw < jeroendedauw@gmail.com >
 */
class HierarchyRendererFactory {

	/**
	 * @param array $options
	 *
	 * @return HierarchyRenderer
	 */
	public function newTreeListRenderer( array $options ) {
		return new TreeListRenderer(
			$this->newPageRenderer( $options ),
			$this->newPageSorter( $options['sort'] ),
			$options['format'] === 'ol' ? TreeListRenderer::FORMAT_OL : TreeListRenderer::FORMAT_UL
		);
	}

	private function newPageRenderer( array $options ) {
		$renderer = new PlainPageRenderer( $this->getPathStyle( $options['pathstyle'] ) );

		if ( $options['template'] !== '' ) {
			$renderer = new TemplatePageRenderer( $renderer, $options['template'] );
		}
		else if ( $options['links'] ) {
			$renderer = new LinkingPageRenderer( $renderer );
		}

		return $renderer;
	}

	private function getPathStyle( $pathStyle ) {
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

		return $styles[$pathStyle];
	}

	private function newPageSorter( $sortOrder ) {
		return new AlphabeticPageSorter( $sortOrder );
	}

}
