<?php

namespace Tests\Unit\SubPageList\Lister;

use PHPUnit\Framework\TestCase;
use SubPageList\Lister\Page;

/**
 * @covers \SubPageList\Lister\Page
 *
 * @group SubPageList
 *
 * @licence GNU GPL v2+
 * @author Jeroen De Dauw < jeroendedauw@gmail.com >
 */
class PageTest extends TestCase {

	public function testConstructSetsFields() {
		$title = $this->createMock( 'Title' );
		$children = [
			new Page( $this->createMock( 'Title' ) ),
			new Page( $this->createMock( 'Title' ) )
		];

		$page = new Page( $title, $children );

		$this->assertEquals( $title, $page->getTitle() );
		$this->assertEquals( $children, $page->getSubPages() );
	}

}
