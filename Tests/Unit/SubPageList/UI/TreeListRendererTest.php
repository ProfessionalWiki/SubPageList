<?php

namespace Tests\Unit\SubPageList\UI;

use SubPageList\AlphabeticPageSorter;
use SubPageList\Page;
use SubPageList\UI\TreeListRenderer;
use Title;

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
			'',
			array(
				TreeListRenderer::OPT_SHOW_TOP_PAGE => false
			)
		);
	}

	public function titleTextProvider() {
		return array(
			array( 'A' ),
			array( 'AAAAAAAA' ),
			array( 'AA BB CC' ),
		);
	}

	/**
	 * @dataProvider titleTextProvider
	 */
	public function testRenderHierarchyWithNoSubPagesShowingPageItself( $titleText ) {
		$this->assertRendersHierarchy(
			new Page( Title::newFromText( $titleText ) ),
			$titleText . "\n"
		);
	}

	protected function assertRendersHierarchy( Page $page, $expected, array $options = array() ) {
		$listRender = $this->newListRenderer( $options );

		$actual = $listRender->renderHierarchy( $page );

		$this->assertEquals( $expected, $actual );
	}

	protected function newListRenderer( array $options ) {
		$pageRenderer = $this->getMock( 'SubPageList\UI\PageRenderer\PageRenderer' );

		$pageRenderer->expects( $this->any() )
			->method( 'renderPage' )
			->will( $this->returnCallback( function( Page $page ) {
				return $page->getTitle()->getFullText();
			} ) );

		$sort = array_key_exists( 'sort', $options ) ? $options['sort'] : 'asc';

		 return new TreeListRenderer(
			 $pageRenderer,
			 new AlphabeticPageSorter( $sort ),
			 $options
		 );
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

	public function testRenderHierarchyWithDescSort() {
		$this->assertRendersHierarchy(
			new Page(
				Title::newFromText( 'AAA' ),
				array(
					new Page( Title::newFromText( 'CCC' ) ),
					new Page( Title::newFromText( 'BBB' ) ),
					new Page( Title::newFromText( 'DDD' ) ),
				)
			),
			'AAA
* DDD
* CCC
* BBB
',
			array( 'sort' => 'desc' )
		);
	}

	public function testRenderAsOrderedList() {
		$this->assertRendersHierarchy(
			new Page(
				Title::newFromText( 'AAA' ),
				array(
					new Page( Title::newFromText( 'CCC' ) ),
					new Page( Title::newFromText( 'BBB' ) ),
				)
			),
			'AAA
# BBB
# CCC
',
			array(
				TreeListRenderer::OPT_FORMAT => TreeListRenderer::FORMAT_OL
			)
		);
	}

}
