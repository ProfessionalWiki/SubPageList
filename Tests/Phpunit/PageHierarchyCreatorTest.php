<?php

namespace SubPageList\Tests\Phpunit;

use Title;
use SubPageList\Page;
use SubPageList\PageHierarchyCreator;

/**
 * @covers SubPageList\PageHierarchyCreator
 *
 * @file
 * @since 0.1
 *
 * @ingroup SubPageList
 * @group SubPageList
 *
 * @licence GNU GPL v2+
 * @author Jeroen De Dauw < jeroendedauw@gmail.com >
 */
class PageHierarchyCreatorTest extends \PHPUnit_Framework_TestCase {

	public function testCanConstruct() {
		new PageHierarchyCreator();
		$this->assertTrue( true );
	}

	public function testEmptyListResultsInEmptyList() {
		$hierarchyCreator = new PageHierarchyCreator();
		$hierarchy = $hierarchyCreator->createHierarchy( array() );

		$this->assertInternalType( 'array', $hierarchy );
		$this->assertEmpty( $hierarchy );
	}

	public function testCanOnlyPassInTitleObjects() {
		$hierarchyCreator = new PageHierarchyCreator();

		$this->setExpectedException( 'InvalidArgumentException' );

		$hierarchyCreator->createHierarchy( array(
			$this->newMockTitle( 'SomePage' ),
			42,
			$this->newMockTitle( 'OtherPage' )
		) );
	}

	protected function newMockTitle( $pageName ) {
		$title = $this->getMock( 'Title' );

		$title->expects( $this->any() )
			->method( 'getFullText' )
			->will( $this->returnValue( $pageName ) );

		return $title;
	}

	public function testListWithOneTitleResultsInOnePage() {
		$title = $this->newMockTitle( 'SomePage' );

		$hierarchyCreator = new PageHierarchyCreator();
		$hierarchy = $hierarchyCreator->createHierarchy( array( $title ) );

		$this->assertPageCount( 1, $hierarchy );

		/**
		 * @var Page $page
		 */
		$page = reset( $hierarchy );

		$this->assertEquals( $title, $page->getTitle() );
		$this->assertEquals( array(), $page->getSubPages() );
	}

	protected function assertPageCount( $expectedCount, $hierarchy ) {
		$this->assertInternalType( 'array', $hierarchy );
		$this->assertCount( $expectedCount, $hierarchy );
		$this->assertContainsOnlyInstancesOf( 'SubPageList\Page', $hierarchy );
	}

	public function testMultipleTopLevelTitlesStayOnTopLevel() {
		$titles = array(
			$this->newMockTitle( 'SomePage' ),
			$this->newMockTitle( 'OtherPage' ),
			$this->newMockTitle( 'OhiThere' ),
		);

		$hierarchyCreator = new PageHierarchyCreator();
		$hierarchy = $hierarchyCreator->createHierarchy( $titles );

		$this->assertTopLevelTitlesEqual( $titles, $hierarchy );
	}

	/**
	 * @param Title[] $expectedTitles
	 * @param Page[] $actualPages
	 */
	protected function assertTopLevelTitlesEqual( array $expectedTitles, array $actualPages ) {
		$actualTitles = array();

		foreach ( $actualPages as $actualPage ) {
			$actualTitles[] = $actualPage->getTitle();
		}

		$this->assertEquals( $expectedTitles, $actualTitles );
	}

	public function testPageAndSubPageResultInPageWithChild() {
		$topLevelPage = $this->newMockTitle( 'SomePage' );
		$childPage = $this->newMockTitle( 'SomePage/ChildPage' );

		$hierarchyCreator = new PageHierarchyCreator();
		$hierarchy = $hierarchyCreator->createHierarchy( array( $topLevelPage, $childPage ) );

		$this->assertPageCount( 1, $hierarchy );

		/**
		 * @var Page $page
		 */
		$page = reset( $hierarchy );

		$this->assertEquals( $topLevelPage, $page->getTitle() );
		$this->assertEquals( array( new Page( $childPage ) ), $page->getSubPages() );
	}

}
