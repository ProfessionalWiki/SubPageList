<?php

namespace SubPageList\Test;
use SubPageList\Extension;
use SubPageList\Settings;

/**
 * Tests for the SubPageList\Extension class.
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
class ExtensionTest extends \MediaWikiTestCase {

	public function constructorProvider() {
		$settingArrays = array(
			Settings::newFromGlobals( $GLOBALS )
		);

		return $this->arrayWrap( $settingArrays );
	}

	/**
	 * @dataProvider constructorProvider
	 *
	 * @param Settings $settings
	 */
	public function testConstructor( Settings $settings ) {
		$extension = new Extension( $settings );

		$this->assertEquals( $settings, $extension->getSettings() );
	}

	public function instanceProvider() {
		$instances = array();

		$instances[] = new Extension( Settings::newFromGlobals( $GLOBALS ) );

		return $this->arrayWrap( $instances );
	}

	/**
	 * @dataProvider instanceProvider
	 *
	 * @param Extension $extension
	 */
	public function testGetSlaveConnectionProvider( Extension $extension ) {
		$this->assertInstanceOf( 'SubPageList\DBConnectionProvider', $extension->getSlaveConnectionProvider() );
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
