<?php

namespace Tests\System\SubPageList\UI;

use SubPageList\Page;
use SubPageList\UI\WikitextSubPageListRenderer;
use Title;

/**
 * @group SubPageList
 * @licence GNU GPL v2+
 * @author Jeroen De Dauw < jeroendedauw@gmail.com >
 */
class SubPageListRendererTest extends \PHPUnit_Framework_TestCase {

	protected static $pages = array(
		'TempSPLTest:FirstRoot'
	);

	/**
	 * @var Title[]
	 */
	protected static $titles;

	public static function setUpBeforeClass() {
		foreach ( self::$pages as $pageName ) {
			$title = Title::newFromText( $pageName );

			$page = new \WikiPage( $title );
			$page->doEditContent(
				new \WikitextContent( 'Content of ' . $pageName ),
				'SPL integration test: create page'
			);

			self::$titles[] = $title;
		}
	}

	public static function tearDownAfterClass() {
		foreach ( self::$titles as $title ) {
			$page = new \WikiPage( $title );
			$page->doDeleteArticle( 'SPL integration test: delete page' );
		}
	}

	public function testCanRenderMainPage() {
//		$page = new Page( Title::newMainPage() );
//		$hierarchyRendering = 'foo bar baz';
//
//		$hierarchyRenderer = $this->getMock( 'SubPageList\UI\HierarchyRenderingBehaviour' );
//
//		$hierarchyRenderer->expects( $this->once() )
//			->method( 'renderHierarchy' )
//			->with( $this->equalTo( $page ) )
//			->will( $this->returnValue( $hierarchyRendering ) );
//
//		$renderer = new WikitextSubPageListRenderer( $hierarchyRenderer );
//
//		$text = $renderer->render( $page );
//
//		$this->assertInternalType( 'string', $text );
//		$this->assertEquals( $hierarchyRendering, $text );

		foreach ( self::$titles as $title ) {
			$this->assertTrue( $title->exists() );
		}
	}

}
