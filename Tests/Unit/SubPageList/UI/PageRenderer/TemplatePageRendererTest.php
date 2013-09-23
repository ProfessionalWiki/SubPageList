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
		$basicRenderer = $this->getMock( 'SubPageList\UI\PageRenderer\PageRenderer' );

		$basicRenderer->expects( $this->once() )
			->method( 'renderPage' )
			->with( $this->equalTo( $page ) )
			->will( $this->returnCallback( function( Page $page ) {
				return $page->getTitle()->getFullText();
			} ) );

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
				'{{MyTemplate|AAA}}',
			),
			array(
				new Page( Title::newFromText( 'AAA/BBB' ) ),
				'MyTemplate',
				'{{MyTemplate|AAA/BBB}}',
			),
			array(
				new Page( Title::newFromText( 'Foo:Bar' ) ),
				'MyTemplate',
				'{{MyTemplate|Foo:Bar}}',
			),
			array(
				new Page( Title::newFromText( 'Foo:Bar/Baz' ) ),
				'MyTemplate',
				'{{MyTemplate|Foo:Bar/Baz}}',
			),
		);
	}

}
