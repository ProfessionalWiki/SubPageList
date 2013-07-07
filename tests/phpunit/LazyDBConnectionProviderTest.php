<?php

namespace SubPageList\Test;

use SubPageList\LazyDBConnectionProvider;
use SubPageList\DBConnectionProvider;

/**
 * @covers SubPageList\LazyDBConnectionProvider
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License along
 * with this program; if not, write to the Free Software Foundation, Inc.,
 * 51 Franklin Street, Fifth Floor, Boston, MA 02110-1301, USA.
 * http://www.gnu.org/copyleft/gpl.html
 *
 * @file
 * @since 1.0
 *
 * @ingroup SPLTest
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
