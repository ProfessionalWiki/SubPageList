<?php

namespace SubPageList\Tests\Phpunit;

use SubPageList\Settings;

/**
 * @covers SubPageList\Settings
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
 * @ingroup SubPageListTest
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
