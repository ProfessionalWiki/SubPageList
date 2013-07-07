<?php

namespace SubPageList\Tests\Phpunit;

use SubPageList\TitleFactory;
use SubPageList\Page;
use SubPageList\PageHierarchyCreator;
use Title;

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
		$this->newPageHierarchyCreator();
		$this->assertTrue( true );
	}

	protected function newPageHierarchyCreator() {
		$factory = $this->getMock( 'SubPageList\TitleFactory' );

		$titleBuilder = array( $this, 'newMockTitle' );

		$factory->expects( $this->any() )
			->method( 'newFromText' )
			->will( $this->returnCallback( function( $titleText ) use ( $titleBuilder ) {
				return call_user_func( $titleBuilder, $titleText );
			} ) );

		return new PageHierarchyCreator( $factory );
	}

	public function testEmptyListResultsInEmptyList() {
		$hierarchyCreator = $this->newPageHierarchyCreator();
		$hierarchy = $hierarchyCreator->createHierarchy( array() );

		$this->assertInternalType( 'array', $hierarchy );
		$this->assertEmpty( $hierarchy );
	}

	public function testCanOnlyPassInTitleObjects() {
		$hierarchyCreator = $this->newPageHierarchyCreator();

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

		$hierarchyCreator = $this->newPageHierarchyCreator();
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

		$hierarchyCreator = $this->newPageHierarchyCreator();
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

		$hierarchyCreator = $this->newPageHierarchyCreator();

		$hierarchy = $hierarchyCreator->createHierarchy( array( $topLevelPage, $childPage ) );

		$this->assertHasParentAndChild( $topLevelPage, $childPage, $hierarchy );

		$hierarchy = $hierarchyCreator->createHierarchy( array( $childPage, $topLevelPage ) );

		$this->assertHasParentAndChild( $topLevelPage, $childPage, $hierarchy );
	}

	protected function assertHasParentAndChild( $topLevelPage, $childPage, array $hierarchy ) {
		$this->assertPageCount( 1, $hierarchy );

		/**
		 * @var Page $page
		 */
		$page = reset( $hierarchy );

		$this->assertEquals( $topLevelPage, $page->getTitle() );
		$this->assertEquals( array( new Page( $childPage ) ), $page->getSubPages() );
	}

}
