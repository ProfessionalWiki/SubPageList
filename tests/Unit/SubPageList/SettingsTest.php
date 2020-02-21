<?php

namespace Tests\Unit\SubPageList;

use PHPUnit\Framework\TestCase;
use SubPageList\Settings;

/**
 * @covers \SubPageList\Settings
 *
 * @group SubPageList
 *
 * @licence GNU GPL v2+
 * @author Jeroen De Dauw < jeroendedauw@gmail.com >
 */
class SettingsTest extends TestCase {

	/**
	 * @dataProvider constructorProvider
	 *
	 * @param array $settings
	 */
	public function testConstructor( array $settings ) {
		$settingsObject = new Settings( $settings );

		foreach ( $settings as $name => $value ) {
			$this->assertEquals( $value, $settingsObject->get( $name ) );
		}

		$this->assertTrue( true );
	}

	public function constructorProvider() {
		$settingArrays = [
			[],
			[ 'foo' => 'bar' ],
			[ 'foo' => 'bar', 'baz' => 'BAH' ],
			[ '~[,,_,,]:3' => [ 9001, 4.2 ] ],
		];

		$argLists = [];

		foreach ( $settingArrays as $settingArray ) {
			$argLists[] = [ $settingArray ];
		}

		return $argLists;
	}

}
