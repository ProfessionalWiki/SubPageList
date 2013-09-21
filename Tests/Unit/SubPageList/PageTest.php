<?php

namespace Tests\Unit\SubPageList;

use SubPageList\Page;

/**
 * @covers SubPageList\Page
 *
 * @group SubPageList
 *
 * @licence GNU GPL v2+
 * @author Jeroen De Dauw < jeroendedauw@gmail.com >
 */
class PageTest extends \PHPUnit_Framework_TestCase {

	public function testConstructSetsFields() {
		$title = $this->getMock( 'Title' );
		$children = array(
			new Page( $this->getMock( 'Title' ) ),
			new Page( $this->getMock( 'Title' ) )
		);

		$page = new Page( $title, $children );

		$this->assertEquals( $title, $page->getTitle() );
		$this->assertEquals( $children, $page->getSubPages() );
	}

}
