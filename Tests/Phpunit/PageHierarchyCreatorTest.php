<?php

namespace SubPageList\Tests\Phpunit;

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
			$this->getMock( 'Ttitle' ),
			42,
			$this->getMock( 'Ttitle' )
		) );
	}

}
