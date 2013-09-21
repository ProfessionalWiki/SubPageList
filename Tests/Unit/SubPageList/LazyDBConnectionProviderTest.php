<?php

namespace Tests\Unit\SubPageList;

use SubPageList\DBConnectionProvider;
use SubPageList\LazyDBConnectionProvider;

/**
 * @covers SubPageList\LazyDBConnectionProvider
 *
 * @group SubPageList
 *
 * @licence GNU GPL v2+
 * @author Jeroen De Dauw < jeroendedauw@gmail.com >
 */
class LazyDBConnectionProviderTest extends \PHPUnit_Framework_TestCase {

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
		$argLists = array(
			array( DB_MASTER ),
			array( DB_SLAVE ),
		);

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
		$argLists = array();

		$argLists[] = array( new LazyDBConnectionProvider( DB_MASTER ) );
		$argLists[] = array( new LazyDBConnectionProvider( DB_SLAVE ) );

		return $argLists;
	}

}
