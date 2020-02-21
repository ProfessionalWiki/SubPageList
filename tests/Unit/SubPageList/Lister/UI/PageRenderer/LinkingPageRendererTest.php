<?php

namespace Tests\Unit\SubPageList\Lister\UI\PageRenderer;

use PHPUnit\Framework\TestCase;
use SubPageList\Lister\Page;
use SubPageList\Lister\UI\PageRenderer\LinkingPageRenderer;
use Title;

/**
 * @covers \SubPageList\Lister\UI\PageRenderer\LinkingPageRenderer
 *
 * @group SubPageList
 *
 * @licence GNU GPL v2+
 * @author Jeroen De Dauw < jeroendedauw@gmail.com >
 */
class LinkingPageRendererTest extends TestCase {

	/**
	 * @dataProvider renderProvider
	 */
	public function testRenderPage( Page $page, $expected ) {
		$GLOBALS['wgNamespacesWithSubpages'][NS_MAIN] = true;

		$basicRenderer = $this->createMock( 'SubPageList\Lister\UI\PageRenderer\PageRenderer' );

		$basicRenderer->expects( $this->once() )
			->method( 'renderPage' )
			->with( $this->equalTo( $page ) )
			->will( $this->returnValue( 'Ohi' ) );

		$renderer = new LinkingPageRenderer( $basicRenderer );

		$actual = $renderer->renderPage( $page );

		$this->assertEquals( $expected, $actual );
	}

	public function renderProvider() {
		return [
			[
				new Page( Title::newFromText( 'AAA' ) ),
				'[[AAA|Ohi]]',
			],
			[
				new Page( Title::newFromText( 'AAA/BBB' ) ),
				'[[AAA/BBB|Ohi]]',
			],
			[
				new Page( Title::newFromText( 'Foo:Bar' ) ),
				'[[Foo:Bar|Ohi]]',
			],
			[
				new Page( Title::newFromText( 'Foo:Bar/Baz' ) ),
				'[[Foo:Bar/Baz|Ohi]]',
			],
		];
	}

}
