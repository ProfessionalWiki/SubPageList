<?php

namespace Tests\Unit\SubPageList;

use PHPUnit\Framework\TestCase;
use SubPageList\DBConnectionProvider;
use SubPageList\LazyDBConnectionProvider;

/**
 * @covers \SubPageList\LazyDBConnectionProvider
 *
 * @group SubPageList
 *
 * @licence GNU GPL v2+
 * @author Jeroen De Dauw < jeroendedauw@gmail.com >
 */
class LazyDBConnectionProviderTest extends TestCase {

	/**
	 * @dataProvider constructorProvider
	 *
	 * @param int $dbId
	 */
	public function testConstructor( $dbId ) {
		new LazyDBConnectionProvider( $dbId );

		$this->assertTrue( true );
	}

	public function constructorProvider() {
		$argLists = [
			[ DB_MASTER ],
			[ DB_REPLICA ],
		];

		return $argLists;
	}

	/**
	 * @dataProvider instanceProvider
	 *
	 * @param DBConnectionProvider $connProvider
	 */
	public function testGetConnection( DBConnectionProvider $connProvider ) {
		$connection = $connProvider->getConnection();

		$this->assertInstanceOf( 'DatabaseBase', $connection );

		$this->assertTrue( $connection === $connProvider->getConnection() );

		$connProvider->releaseConnection();

		$this->assertInstanceOf( 'DatabaseBase', $connProvider->getConnection() );
	}

	public function instanceProvider() {
		$argLists = [];

		$argLists[] = [ new LazyDBConnectionProvider( DB_MASTER ) ];
		$argLists[] = [ new LazyDBConnectionProvider( DB_REPLICA ) ];

		return $argLists;
	}

}
