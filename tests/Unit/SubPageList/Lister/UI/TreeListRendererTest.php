<?php

namespace Tests\Unit\SubPageList\Lister\UI;

use SubPageList\Lister\AlphabeticPageSorter;
use SubPageList\Lister\Page;
use SubPageList\Lister\UI\TreeListRenderer;
use Title;

/**
 * @covers SubPageList\Lister\UI\TreeListRenderer
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
			[
				TreeListRenderer::OPT_SHOW_TOP_PAGE => false
			]
		);
	}

	public function titleTextProvider() {
		return [
			[ 'A' ],
			[ 'AAAAAAAA' ],
			[ 'AA BB CC' ],
		];
	}

	/**
	 * @dataProvider titleTextProvider
	 */
	public function testRenderHierarchyWithNoSubPagesShowingPageItself( $titleText ) {
		$this->assertRendersHierarchy(
			new Page( Title::newFromText( $titleText ) ),
			$titleText
		);
	}

	private function assertRendersHierarchy( Page $page, $expected, array $options = [] ) {
		$listRender = $this->newListRenderer( $options );

		$actual = $listRender->renderHierarchy( $page );

		$this->assertEquals( $expected, $actual );
	}

	private function newListRenderer( array $options ) {
		$pageRenderer = $this->getMock( 'SubPageList\Lister\UI\PageRenderer\PageRenderer' );

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
				[
					new Page( Title::newFromText( 'CCC' ) ),
					new Page( Title::newFromText( 'BBB' ) ),
				]
			),
			'AAA
* BBB
* CCC'
		);
	}

	public function testRenderHierarchyWithDescSort() {
		$this->assertRendersHierarchy(
			new Page(
				Title::newFromText( 'AAA' ),
				[
					new Page( Title::newFromText( 'CCC' ) ),
					new Page( Title::newFromText( 'BBB' ) ),
					new Page( Title::newFromText( 'DDD' ) ),
				]
			),
			'AAA
* DDD
* CCC
* BBB',
			[ 'sort' => 'desc' ]
		);
	}

	public function testRenderAsOrderedList() {
		$this->assertRendersHierarchy(
			new Page(
				Title::newFromText( 'AAA' ),
				[
					new Page( Title::newFromText( 'CCC' ) ),
					new Page( Title::newFromText( 'BBB' ) ),
				]
			),
			'AAA
# BBB
# CCC',
			[
				TreeListRenderer::OPT_FORMAT => TreeListRenderer::FORMAT_OL
			]
		);
	}

	public function testRenderHierarchyWithManySubPages() {
		$this->assertRendersHierarchy(
			new Page(
				Title::newFromText( 'AAA' ),
				[
					new Page(
						Title::newFromText( 'BBB' ),
						[
							new Page( Title::newFromText( '111' ) ),
							new Page( Title::newFromText( '222' ) ),
						]
					),
					new Page(
						Title::newFromText( 'CCC' ),
						[]
					),
					new Page(
						Title::newFromText( 'DDD' ),
						[
							new Page( Title::newFromText( '333' ) ),
						]
					),
				]
			),
			'AAA
* BBB
** 111
** 222
* CCC
* DDD
** 333'
		);
	}

	public function testRenderHierarchyWithDepthLimit() {
		$this->assertRendersHierarchy(
			new Page(
				Title::newFromText( 'AAA' ),
				[
					new Page(
						Title::newFromText( 'BBB' ),
						[
							new Page( Title::newFromText( '111' ) ),
							new Page( Title::newFromText( '222' ) ),
						]
					),
					new Page(
						Title::newFromText( 'CCC' ),
						[]
					),
					new Page(
						Title::newFromText( 'DDD' ),
						[
							new Page( Title::newFromText( '333' ) ),
						]
					),
				]
			),
			'AAA
* BBB
* CCC
* DDD',
			[
				TreeListRenderer::OPT_MAX_DEPTH => 1
			]
		);
	}

}
