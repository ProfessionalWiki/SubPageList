<?php

namespace Tests\Unit\SubPageList;

use SubPageList\Settings;

/**
 * @covers SubPageList\Settings
 *
 * @group SubPageList
 *
 * @licence GNU GPL v2+
 * @author Jeroen De Dauw < jeroendedauw@gmail.com >
 */
class SettingsTest extends \PHPUnit_Framework_TestCase {

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
		$settingArrays = array(
			array(),
			array( 'foo' => 'bar' ),
			array( 'foo' => 'bar', 'baz' => 'BAH' ),
			array( '~[,,_,,]:3' => array( 9001, 4.2 ) ),
		);

		$argLists = array();

		foreach ( $settingArrays as $settingArray ) {
			$argLists[] = array( $settingArray );
		}

		return $argLists;
	}

}
