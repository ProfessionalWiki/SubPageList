<?php

namespace Tests\Unit\SubPageList\UI\PageRenderer;

use SubPageList\Page;
use SubPageList\UI\PageRenderer\LinkingPageRenderer;
use SubPageList\UI\PageRenderer\PlainPageRenderer;
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
	public function testRenderPage( Page $page, $expected ) {
		$renderer = new LinkingPageRenderer( new PlainPageRenderer( PlainPageRenderer::PATH_NONE ) );

		$actual = $renderer->renderPage( $page );

		$this->assertEquals( $expected, $actual );
	}

	public function renderProvider() {
		return array(
			array(
				new Page( Title::newFromText( 'AAA' ) ),
				'[[AAA|AAA]]',
			),
			array(
				new Page( Title::newFromText( 'AAA/BBB' ) ),
				'[[AAA/BBB|BBB]]',
			),
			array(
				new Page( Title::newFromText( 'Foo:Bar' ) ),
				'[[Foo:Bar|Bar]]',
			),
			array(
				new Page( Title::newFromText( 'Foo:Bar/Baz' ) ),
				'[[Foo:Bar/Baz|Baz]]',
			),
		);
	}

}
