<?php

namespace Tests\Unit\SubPageList\UI;

use Title;
use SubPageList\Page;
use SubPageList\UI\TreeListRenderer;

/**
 * @covers SubPageList\UI\TreeListRenderer
 *
 * @group SubPageList
 *
 * @licence GNU GPL v2+
 * @author Jeroen De Dauw < jeroendedauw@gmail.com >
 */
class TreeListRendererTest extends \PHPUnit_Framework_TestCase {

	/**
	 * @dataProvider titleTextProvider
	 */
	public function testRenderHierarchyWithNoSubPages( $titleText ) {
		$this->assertRendersHierarchy(
			new Page( Title::newFromText( $titleText ) ),
			$titleText . "\n"
		);
	}

	public function titleTextProvider() {
		return array(
			array( 'A' ),
			array( 'AAAAAAAA' ),
			array( 'AA BB CC' ),
		);
	}

	protected function assertRendersHierarchy( Page $page, $expected, $message = '' ) {
		$listRender = $this->newListRenderer();

		$actual = $listRender->renderHierarchy( $page );

		$this->assertEquals( $expected, $actual, $message );
	}

	protected function newListRenderer() {
		$pageRenderer = $this->getMock( 'SubPageList\UI\PageRenderingBehaviour' );

		$pageRenderer->expects( $this->any() )
			->method( 'renderPage' )
			->will( $this->returnCallback( function( Page $page ) {
				return $page->getTitle()->getFullText();
			} ) );

		 return new TreeListRenderer( $pageRenderer );
	}

	public function testRenderHierarchyWithSubPages() {
		$this->assertRendersHierarchy(
			new Page(
				Title::newFromText( 'AAA' ),
				array(
					new Page( Title::newFromText( 'CCC' ) ),
					new Page( Title::newFromText( 'BBB' ) ),
				)
			),
			'AAA
* BBB
* CCC
'
		);
	}

}
