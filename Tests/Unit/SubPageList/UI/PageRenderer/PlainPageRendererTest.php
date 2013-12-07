<?php

namespace Tests\Unit\SubPageList\UI\PageRenderer;

use SubPageList\Page;
use SubPageList\UI\PageRenderer\PlainPageRenderer;
use Title;

/**
 * @covers SubPageList\UI\PageRenderer\PlainPageRenderer
 *
 * @group SubPageList
 *
 * @licence GNU GPL v2+
 * @author Jeroen De Dauw < jeroendedauw@gmail.com >
 */
class PlainPageRendererTest extends \PHPUnit_Framework_TestCase {

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
		return array(
			array(
				new Page( Title::newFromText( 'AAA' ) ),
				PlainPageRenderer::PATH_FULL,
				'AAA',
			),
			array(
				new Page( Title::newFromText( 'AAA/BBB' ) ),
				PlainPageRenderer::PATH_FULL,
				'AAA/BBB',
			),
			array(
				new Page( Title::newFromText( 'Foo:Bar' ) ),
				PlainPageRenderer::PATH_FULL,
				'Foo:Bar',
			),
			array(
				new Page( Title::newFromText( 'Foo:Bar/Baz' ) ),
				PlainPageRenderer::PATH_FULL,
				'Foo:Bar/Baz',
			),


			array(
				new Page( Title::newFromText( 'AAA' ) ),
				PlainPageRenderer::PATH_NONE,
				'AAA',
			),
			array(
				new Page( Title::newFromText( 'AAA/BBB' ) ),
				PlainPageRenderer::PATH_NONE,
				'BBB',
			),
			array(
				new Page( Title::newFromText( 'Foo:Bar' ) ),
				PlainPageRenderer::PATH_NONE,
				'Bar',
			),
			array(
				new Page( Title::newFromText( 'Foo:Bar/Baz' ) ),
				PlainPageRenderer::PATH_NONE,
				'Baz',
			),


			array(
				new Page( Title::newFromText( 'AAA' ) ),
				PlainPageRenderer::PATH_NO_NS,
				'AAA',
			),
			array(
				new Page( Title::newFromText( 'AAA/BBB' ) ),
				PlainPageRenderer::PATH_FULL,
				'AAA/BBB',
			),
			array(
				new Page( Title::newFromText( 'Foo:Bar' ) ),
				PlainPageRenderer::PATH_NO_NS,
				'Bar',
			),
			array(
				new Page( Title::newFromText( 'Foo:Bar/Baz' ) ),
				PlainPageRenderer::PATH_NO_NS,
				'Bar/Baz',
			),


			array(
				new Page( Title::newFromText( 'AAA' ) ),
				PlainPageRenderer::PATH_SUB_PAGE,
				'AAA',
			),
			array(
				new Page( Title::newFromText( 'AAA/BBB' ) ),
				PlainPageRenderer::PATH_SUB_PAGE,
				'BBB',
			),
			array(
				new Page( Title::newFromText( 'Foo:Bar' ) ),
				PlainPageRenderer::PATH_SUB_PAGE,
				'Foo:Bar',
			),
			array(
				new Page( Title::newFromText( 'Foo:Bar/Baz' ) ),
				PlainPageRenderer::PATH_SUB_PAGE,
				'Baz',
			),
		);
	}

}
