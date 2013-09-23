<?php

namespace Tests\Unit\SubPageList\UI\PageRenderer;

use SubPageList\Page;
use SubPageList\UI\PageRenderer\LinkingPageRenderer;
use Title;

/**
 * @covers SubPageList\UI\LinkingPageRenderer
 *
 * @group SubPageList
 *
 * @licence GNU GPL v2+
 * @author Jeroen De Dauw < jeroendedauw@gmail.com >
 */
class LinkingPageRendererTest extends \PHPUnit_Framework_TestCase {

	/**
	 * @dataProvider renderProvider
	 */
	public function testRenderPage( Page $page, $pathStyle, $expected ) {
		$renderer = new LinkingPageRenderer( $pathStyle );

		$actual = $renderer->renderPage( $page );

		$this->assertEquals( $expected, $actual );
	}

	public function renderProvider() {
		return array(
			array(
				new Page( Title::newFromText( 'AAA' ) ),
				LinkingPageRenderer::PATH_FULL,
				'[[AAA|AAA]]',
			),
			array(
				new Page( Title::newFromText( 'AAA/BBB' ) ),
				LinkingPageRenderer::PATH_FULL,
				'[[AAA/BBB|AAA/BBB]]',
			),
			array(
				new Page( Title::newFromText( 'Foo:Bar' ) ),
				LinkingPageRenderer::PATH_FULL,
				'[[Foo:Bar|Foo:Bar]]',
			),
			array(
				new Page( Title::newFromText( 'Foo:Bar/Baz' ) ),
				LinkingPageRenderer::PATH_FULL,
				'[[Foo:Bar/Baz|Foo:Bar/Baz]]',
			),


			array(
				new Page( Title::newFromText( 'AAA' ) ),
				LinkingPageRenderer::PATH_NONE,
				'[[AAA|AAA]]',
			),
			array(
				new Page( Title::newFromText( 'AAA/BBB' ) ),
				LinkingPageRenderer::PATH_NONE,
				'[[AAA/BBB|BBB]]',
			),
			array(
				new Page( Title::newFromText( 'Foo:Bar' ) ),
				LinkingPageRenderer::PATH_NONE,
				'[[Foo:Bar|Bar]]',
			),
			array(
				new Page( Title::newFromText( 'Foo:Bar/Baz' ) ),
				LinkingPageRenderer::PATH_NONE,
				'[[Foo:Bar/Baz|Baz]]',
			),


			array(
				new Page( Title::newFromText( 'AAA' ) ),
				LinkingPageRenderer::PATH_NO_NS,
				'[[AAA|AAA]]',
			),
			array(
				new Page( Title::newFromText( 'AAA/BBB' ) ),
				LinkingPageRenderer::PATH_FULL,
				'[[AAA/BBB|AAA/BBB]]',
			),
			array(
				new Page( Title::newFromText( 'Foo:Bar' ) ),
				LinkingPageRenderer::PATH_NO_NS,
				'[[Foo:Bar|Bar]]',
			),
			array(
				new Page( Title::newFromText( 'Foo:Bar/Baz' ) ),
				LinkingPageRenderer::PATH_NO_NS,
				'[[Foo:Bar/Baz|Bar/Baz]]',
			),


			array(
				new Page( Title::newFromText( 'AAA' ) ),
				LinkingPageRenderer::PATH_SUB_PAGE,
				'[[AAA|AAA]]',
			),
			array(
				new Page( Title::newFromText( 'AAA/BBB' ) ),
				LinkingPageRenderer::PATH_SUB_PAGE,
				'[[AAA/BBB|BBB]]',
			),
			array(
				new Page( Title::newFromText( 'Foo:Bar' ) ),
				LinkingPageRenderer::PATH_SUB_PAGE,
				'[[Foo:Bar|Foo:Bar]]',
			),
			array(
				new Page( Title::newFromText( 'Foo:Bar/Baz' ) ),
				LinkingPageRenderer::PATH_SUB_PAGE,
				'[[Foo:Bar/Baz|Baz]]',
			),
		);
	}

}
