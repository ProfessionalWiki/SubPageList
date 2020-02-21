<?php

namespace Tests\Unit\SubPageList\Lister;

use PHPUnit\Framework\TestCase;
use SubPageList\LazyDBConnectionProvider;
use SubPageList\Lister\SimpleSubPageFinder;
use SubPageList\Lister\SubPageFinder;
use Title;

/**
 * @covers \SubPageList\Lister\SimpleSubPageFinder
 *
 * @group SubPageList
 * @group Database
 *
 * @licence GNU GPL v2+
 * @author Jeroen De Dauw < jeroendedauw@gmail.com >
 */
class SimpleSubPageFinderTest extends TestCase {

	/**
	 * @return SubPageFinder
	 */
	public function newInstance() {
		return new SimpleSubPageFinder( new LazyDBConnectionProvider( DB_REPLICA ) );
	}

	public function titleProvider() {
		$argLists = [];

		$argLists[] = [ Title::newMainPage() ];
		$argLists[] = [ Title::newFromText( 'ohi there i do not exist nyan nyan nyan' ) ];

		return $argLists;
	}

	public function redirectProvider() {
		$argLists = [];

		Title::newFromText( 'hello world' );

		$argLists[] = [ Title::newFromText( 'Redirect Test' ) ];
		$rc = new RedirectCreator();
		$rc->createRedirect(
			Title::newFromText( 'Redirect Test/Sub' ),
			'hello world'
		);

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
		$this->assertContainsOnlyInstancesOf( Title::class, $pages );
	}

	/**
	 * @dataProvider redirectProvider
	 *
	 * @param Title $title
	 */
	public function testGetSubPagesForRedirect( Title $title ) {
		$finder = $this->newInstance();

		$pages = $finder->getSubPagesFor( $title );

		$this->assertInternalType( 'array', $pages );
		$this->assertContainsOnlyInstancesOf( Title::class, $pages );

		foreach ( $pages as $subPage ) {
			$this->assertSame(
				$subPage->getFullText(),
				'Redirect Test/Sub'
			);
		}
	}

}
