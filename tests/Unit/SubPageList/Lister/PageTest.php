<?php

namespace Tests\Unit\SubPageList\Lister;

use SubPageList\Lister\Page;

/**
 * @covers SubPageList\Lister\Page
 *
 * @group SubPageList
 *
 * @licence GNU GPL v2+
 * @author Jeroen De Dauw < jeroendedauw@gmail.com >
 */
class PageTest extends \PHPUnit_Framework_TestCase {

	public function testConstructorSetsFields() {
		$title = $this->getMock( 'Title' );
		$children = array(
			new Page( $this->getMock( 'Title' ) ),
		);

		$page = new Page( $title, $children );

		$this->assertEquals( $title, $page->getTitle() );
		$this->assertEquals( $children, $page->getSubPages() );
	}

	public function testDuplicatesAreOmitted() {
		$sub0 = new Page( \Title::newFromText( 'sub0' ), array() );
		$sub1 = new Page( \Title::newFromText( 'sub1' ), array() );

		$page = new Page( $this->getMock( 'Title' ), array() );
		$page->addSubPage( $sub0 );
		$page->addSubPage( $sub1 );

		$this->assertSame(
			array(
				$sub0,
				$sub1
			),
			$page->getSubPages()
		);
	}

}
