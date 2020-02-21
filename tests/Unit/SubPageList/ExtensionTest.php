<?php

namespace Tests\Unit\SubPageList;

use PHPUnit\Framework\TestCase;
use SubPageList\Extension;
use SubPageList\Settings;

/**
 * @covers \SubPageList\Extension
 *
 * @group SubPageList
 *
 * @licence GNU GPL v2+
 * @author Jeroen De Dauw < jeroendedauw@gmail.com >
 */
class ExtensionTest extends TestCase {

	/**
	 * @dataProvider constructorProvider
	 *
	 * @param Settings $settings
	 */
	public function testConstructor( Settings $settings ) {
		$extension = new Extension( $settings );

		$this->assertEquals( $settings, $extension->getSettings() );
	}

	public function constructorProvider() {
		$argLists = [
			[ Settings::newFromGlobals( $GLOBALS ) ]
		];

		return $argLists;
	}

	/**
	 * @dataProvider instanceProvider
	 *
	 * @param Extension $extension
	 */
	public function testGetSlaveConnectionProvider( Extension $extension ) {
		$this->assertInstanceOf( 'SubPageList\DBConnectionProvider', $extension->getSlaveConnectionProvider() );
	}

	public function instanceProvider() {
		$argLists = [];

		$argLists[] = [ new Extension( Settings::newFromGlobals( $GLOBALS ) ) ];

		return $argLists;
	}

	/**
	 * @dataProvider instanceProvider
	 *
	 * @param Extension $extension
	 */
	public function testGetCacheInvalidator( Extension $extension ) {
		$this->assertInstanceOf( 'SubPageList\CacheInvalidator', $extension->getCacheInvalidator() );
	}

}
