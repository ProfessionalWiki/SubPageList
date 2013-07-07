<?php

namespace SubPageList\Tests\Phpunit;

use SubPageList\Page;

/**
 * @covers SubPageList\Page
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
class PageTest extends \PHPUnit_Framework_TestCase {

	public function testConstructSetsFields() {
		$title = $this->getMock( 'Title' );
		$children = array(
			$this->getMock( 'Title' ),
			$this->getMock( 'Title' )
		);

		$page = new Page( $title, $children );

		$this->assertEquals( $title, $page->getTitle() );
		$this->assertEquals( $children, $page->getSubPages() );
	}

}
