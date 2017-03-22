<?php

namespace SubPageList\Lister\UI;

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
		$treeListOptions = [
			TreeListRenderer::OPT_SHOW_TOP_PAGE => $options['showpage'],
		];

		if ( $options['kidsonly'] ) {
			$treeListOptions[TreeListRenderer::OPT_MAX_DEPTH] = 1;
		}

		if ( $options['format'] === 'ol' ) {
			$treeListOptions[TreeListRenderer::OPT_FORMAT] = TreeListRenderer::FORMAT_OL;
		}
		
		$treeListOptions[TreeListRenderer::OPT_ADDLEVEL] = $options['addlevel'];

		return new TreeListRenderer(
			$this->newPageRenderer( $options ),
			$treeListOptions
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
		$styles = [
			'none' => PlainPageRenderer::PATH_NONE,
			'no' => PlainPageRenderer::PATH_NONE,

			'subpagename' => PlainPageRenderer::PATH_SUB_PAGE,
			'children' => PlainPageRenderer::PATH_SUB_PAGE,
			'notparent' => PlainPageRenderer::PATH_SUB_PAGE,

			'full' => PlainPageRenderer::PATH_FULL,
			'fullpagename' => PlainPageRenderer::PATH_FULL,

			'pagename' => PlainPageRenderer::PATH_NO_NS,
		];

		return $styles[$pathStyle];
	}
}