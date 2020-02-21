<?php

namespace Tests\Unit\SubPageList\UI\PageRenderer;

use PHPUnit\Framework\TestCase;
use SubPageList\Lister\Page;
use SubPageList\Lister\UI\PageRenderer\TemplatePageRenderer;
use Title;

/**
 * @covers \SubPageList\Lister\UI\PageRenderer\TemplatePageRenderer
 *
 * @group SubPageList
 *
 * @licence GNU GPL v2+
 * @author Jeroen De Dauw < jeroendedauw@gmail.com >
 */
class TemplatePageRendererTest extends TestCase {

	/**
	 * @dataProvider renderProvider
	 */
	public function testRenderPage( Page $page, $templateName, $expected ) {
		$GLOBALS['wgNamespacesWithSubpages'][NS_MAIN] = true;

		$basicRenderer = $this->createMock( 'SubPageList\Lister\UI\PageRenderer\PageRenderer' );

		$basicRenderer->expects( $this->once() )
			->method( 'renderPage' )
			->with( $this->equalTo( $page ) )
			->will( $this->returnValue( 'Ohi' ) );

		$renderer = new TemplatePageRenderer(
			$basicRenderer,
			$templateName
		);

		$actual = $renderer->renderPage( $page );

		$this->assertEquals( $expected, $actual );
	}

	public function renderProvider() {
		return [
			[
				new Page( Title::newFromText( 'AAA' ) ),
				'MyTemplate',
				'{{MyTemplate|Ohi}}',
			],
			[
				new Page( Title::newFromText( 'AAA/BBB' ) ),
				'MyTemplate',
				'{{MyTemplate|Ohi}}',
			],
			[
				new Page( Title::newFromText( 'Foo:Bar' ) ),
				'MyTemplate',
				'{{MyTemplate|Ohi}}',
			],
			[
				new Page( Title::newFromText( 'Foo:Bar/Baz' ) ),
				'MyTemplate',
				'{{MyTemplate|Ohi}}',
			],
		];
	}

}
