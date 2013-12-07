<?php

namespace Tests\Unit\SubPageList\UI\PageRenderer;

use SubPageList\Page;
use SubPageList\UI\PageRenderer\TemplatePageRenderer;
use SubPageList\UI\PageRenderer\PlainPageRenderer;
use Title;

/**
 * @covers SubPageList\UI\PageRenderer\TemplatePageRenderer
 *
 * @group SubPageList
 *
 * @licence GNU GPL v2+
 * @author Jeroen De Dauw < jeroendedauw@gmail.com >
 */
class TemplatePageRendererTest extends \PHPUnit_Framework_TestCase {

	/**
	 * @dataProvider renderProvider
	 */
	public function testRenderPage( Page $page, $templateName, $expected ) {
		$GLOBALS['wgNamespacesWithSubpages'][NS_MAIN] = true;

		$basicRenderer = $this->getMock( 'SubPageList\UI\PageRenderer\PageRenderer' );

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
		return array(
			array(
				new Page( Title::newFromText( 'AAA' ) ),
				'MyTemplate',
				'{{MyTemplate|Ohi}}',
			),
			array(
				new Page( Title::newFromText( 'AAA/BBB' ) ),
				'MyTemplate',
				'{{MyTemplate|Ohi}}',
			),
			array(
				new Page( Title::newFromText( 'Foo:Bar' ) ),
				'MyTemplate',
				'{{MyTemplate|Ohi}}',
			),
			array(
				new Page( Title::newFromText( 'Foo:Bar/Baz' ) ),
				'MyTemplate',
				'{{MyTemplate|Ohi}}',
			),
		);
	}

}
