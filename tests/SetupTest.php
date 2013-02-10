<?php

namespace SubPageList\Test;
use SubPageList\Setup;
use SubPageList\Extension;

/**
 * Tests for the SubPageList\Setup class.
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
class SetupTest extends SubPageListTestCase {

	public function testRun() {
		$extension = $this->newExtension();

		$hookLists = array(
			'ParserFirstCallInit' => array(),
			'ArticleInsertComplete' => array(),
			'ArticleDeleteComplete' => array(),
			'TitleMoveComplete' => array(),
			'UnitTestsList' => array(),
		);

		$setup = new Setup(
			$extension,
			$hookLists
		);

		$setup->run();

		foreach ( $hookLists as $hookName => $hookList ) {
			$this->assertEquals( 1, count( $hookList ), "one hook handler need to be added to '$hookName'" );

			$hook = reset( $hookList );

			$this->assertInternalType( 'callable', $hook );
		}
	}

}
