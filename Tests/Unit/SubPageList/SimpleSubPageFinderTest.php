<?php

namespace Tests\Unit\SubPageList;

use SubPageList\LazyDBConnectionProvider;
use SubPageList\SimpleSubPageFinder;
use SubPageList\SubPageFinder;
use Title;

/**
 * @covers SubPageList\SimpleSubPageFinder
 *
 * @group SubPageList
 * @group Database
 *
 * @licence GNU GPL v2+
 * @author Jeroen De Dauw < jeroendedauw@gmail.com >
 */
class SimpleSubPageFinderTest extends \PHPUnit_Framework_TestCase {

	/**
	 * @return SubPageFinder
	 */
	public function newInstance() {
		return new SimpleSubPageFinder( new LazyDBConnectionProvider( DB_SLAVE ) );
	}

	public function titleProvider() {
		$argLists = array();

		$argLists[] = array( Title::newMainPage() );
		$argLists[] = array( Title::newFromText( 'ohi there i do not exist nyan nyan nyan' ) );

		return $argLists;
	}

	/**
	 * @dataProvider titleProvider
	 *
	 * @param Title $title
	 */
	public function testGetSubPagesFor( Title $title ) {
		$finder = $this->newInstance();

		$pages = $finder->getSubPagesFor( $title );

		$this->assertInternalType( 'array', $pages );
		$this->assertContainsOnlyInstancesOf( 'Title', $pages );
	}

}
