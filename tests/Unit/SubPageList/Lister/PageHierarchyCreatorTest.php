<?php

namespace Tests\Unit\SubPageList\Lister;

use SubPageList\Lister\Page;
use SubPageList\Lister\PageHierarchyCreator;
use Title;

/**
 * @covers SubPageList\Lister\PageHierarchyCreator
 *
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

	private function newPageHierarchyCreator() {
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

	public function newMockTitle( $pageName ) {
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

	private function assertPageCount( $expectedCount, $hierarchy ) {
		$this->assertInternalType( 'array', $hierarchy );
		$this->assertCount( $expectedCount, $hierarchy );
		$this->assertContainsOnlyInstancesOf( 'SubPageList\Lister\Page', $hierarchy );
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
	private function assertTopLevelTitlesEqual( array $expectedTitles, array $actualPages ) {
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

	private function assertHasParentAndChild( $topLevelPage, $childPage, array $hierarchy ) {
		$this->assertPageCount( 1, $hierarchy );

		/**
		 * @var Page $page
		 */
		$page = reset( $hierarchy );

		$this->assertEquals( $topLevelPage, $page->getTitle() );
		$this->assertEquals( array( new Page( $childPage ) ), $page->getSubPages() );
	}

	public function testInBetweenPagesAreCreated() {
		$topLevelPage = $this->newMockTitle( 'SomePage' );
		$grandGrandChildPage = $this->newMockTitle( 'SomePage/ChildPage/GrandChildPage/HipsterPage' );

		$hierarchyCreator = $this->newPageHierarchyCreator();
		$hierarchy = $hierarchyCreator->createHierarchy( array( $topLevelPage, $grandGrandChildPage ) );

		$this->assertEquals(
			array(
				new Page(
					$this->newMockTitle( 'SomePage' ),
					array(
						new Page(
							$this->newMockTitle( 'SomePage/ChildPage' ),
							array(
								new Page(
									$this->newMockTitle( 'SomePage/ChildPage/GrandChildPage' ),
									array(
										new Page(
											$this->newMockTitle( 'SomePage/ChildPage/GrandChildPage/HipsterPage' )
										)
									)
								)
							)
						)
					)
				)
			),
			$hierarchy
		);
	}

	public function testTopLevelPageGetsCreatedForSubPage() {
		$grandChildPage = $this->newMockTitle( 'SomePage/ChildPage/GrandChildPage' );

		$hierarchyCreator = $this->newPageHierarchyCreator();
		$hierarchy = $hierarchyCreator->createHierarchy( array( $grandChildPage ) );

		$this->assertEquals(
			array(
				new Page(
					$this->newMockTitle( 'SomePage' ),
					array(
						new Page(
							$this->newMockTitle( 'SomePage/ChildPage' ),
							array(
								new Page(
									$this->newMockTitle( 'SomePage/ChildPage/GrandChildPage' )
								)
							)
						)
					)
				)
			),
			$hierarchy
		);
	}

	public function testMultipleChildrenForSameTopLevelPage() {
		$titles[] = $this->newMockTitle( 'SomePage/Child0/GrandChild00' );

		$grandChild10 = $this->newMockTitle( 'SomePage/Child1/GrandChild10' );
		$grandChild11 = $this->newMockTitle( 'SomePage/Child1/GrandChild11' );
		$grandChild20 = $this->newMockTitle( 'SomePage/Child2/GrandChild20' );
		$grandChild21 = $this->newMockTitle( 'SomePage/Child2/GrandChild21' );

		$titles[] = $grandChild10;
		$titles[] = $grandChild11;

		$titles[] = $grandChild20;
		$titles[] = $this->newMockTitle( 'SomePage/Child2' );
		$titles[] = $grandChild21;

		$hierarchyCreator = $this->newPageHierarchyCreator();
		$hierarchy = $hierarchyCreator->createHierarchy( $titles );

		$this->assertEquals(
			array(
				new Page(
					$this->newMockTitle( 'SomePage' ),
					array(
						new Page(
							$this->newMockTitle( 'SomePage/Child0' ),
							array(
								new Page(
									$this->newMockTitle( 'SomePage/Child0/GrandChild00' )
								)
							)
						),
						new Page(
							$this->newMockTitle( 'SomePage/Child1' ),
							array(
								new Page(
									$grandChild10
								),
								new Page(
									$grandChild11
								)
							)
						),
						new Page(
							$this->newMockTitle( 'SomePage/Child2' ),
							array(
								new Page(
									$grandChild20
								),
								new Page(
									$grandChild21
								)
							)
						)
					)
				)
			),
			$hierarchy
		);
	}

}
