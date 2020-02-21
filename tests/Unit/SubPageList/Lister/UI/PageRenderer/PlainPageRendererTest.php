<?php

namespace Tests\Unit\SubPageList\UI\PageRenderer;

use PHPUnit\Framework\TestCase;
use SubPageList\Lister\Page;
use SubPageList\Lister\UI\PageRenderer\PlainPageRenderer;
use Title;

/**
 * @covers \SubPageList\Lister\UI\PageRenderer\PlainPageRenderer
 *
 * @group SubPageList
 *
 * @licence GNU GPL v2+
 * @author Jeroen De Dauw < jeroendedauw@gmail.com >
 */
class PlainPageRendererTest extends TestCase {

	/**
	 * @dataProvider renderProvider
	 */
	public function testRenderPage( Page $page, $pathStyle, $expected ) {
		$GLOBALS['wgNamespacesWithSubpages'][NS_MAIN] = true;

		$renderer = new PlainPageRenderer( $pathStyle );

		$actual = $renderer->renderPage( $page );

		$this->assertEquals( $expected, $actual );
	}

	public function renderProvider() {
		return [
			[
				new Page( Title::newFromText( 'AAA' ) ),
				PlainPageRenderer::PATH_FULL,
				'AAA',
			],
			[
				new Page( Title::newFromText( 'AAA/BBB' ) ),
				PlainPageRenderer::PATH_FULL,
				'AAA/BBB',
			],
			[
				new Page( Title::newFromText( 'Foo:Bar' ) ),
				PlainPageRenderer::PATH_FULL,
				'Foo:Bar',
			],
			[
				new Page( Title::newFromText( 'Foo:Bar/Baz' ) ),
				PlainPageRenderer::PATH_FULL,
				'Foo:Bar/Baz',
			],


			[
				new Page( Title::newFromText( 'AAA' ) ),
				PlainPageRenderer::PATH_NONE,
				'AAA',
			],
			[
				new Page( Title::newFromText( 'AAA/BBB' ) ),
				PlainPageRenderer::PATH_NONE,
				'BBB',
			],
			[
				new Page( Title::newFromText( 'Foo:Bar' ) ),
				PlainPageRenderer::PATH_NONE,
				'Bar',
			],
			[
				new Page( Title::newFromText( 'Foo:Bar/Baz' ) ),
				PlainPageRenderer::PATH_NONE,
				'Baz',
			],


			[
				new Page( Title::newFromText( 'AAA' ) ),
				PlainPageRenderer::PATH_NO_NS,
				'AAA',
			],
			[
				new Page( Title::newFromText( 'AAA/BBB' ) ),
				PlainPageRenderer::PATH_FULL,
				'AAA/BBB',
			],
			[
				new Page( Title::newFromText( 'Foo:Bar' ) ),
				PlainPageRenderer::PATH_NO_NS,
				'Bar',
			],
			[
				new Page( Title::newFromText( 'Foo:Bar/Baz' ) ),
				PlainPageRenderer::PATH_NO_NS,
				'Bar/Baz',
			],


			[
				new Page( Title::newFromText( 'AAA' ) ),
				PlainPageRenderer::PATH_SUB_PAGE,
				'AAA',
			],
			[
				new Page( Title::newFromText( 'AAA/BBB' ) ),
				PlainPageRenderer::PATH_SUB_PAGE,
				'BBB',
			],
			[
				new Page( Title::newFromText( 'Foo:Bar' ) ),
				PlainPageRenderer::PATH_SUB_PAGE,
				'Foo:Bar',
			],
			[
				new Page( Title::newFromText( 'Foo:Bar/Baz' ) ),
				PlainPageRenderer::PATH_SUB_PAGE,
				'Baz',
			],
		];
	}

}
