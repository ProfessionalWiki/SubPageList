<?php

namespace SubPageList\Tests;

use SubPageList\SimpleSubPageFinder;
use SubPageList\SubPageFinder;
use Title;

/**
 * @covers SubPageList\SimpleSubPageFinder
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
 * @group Database
 *
 * @licence GNU GPL v2+
 * @author Jeroen De Dauw < jeroendedauw@gmail.com >
 */
class SimpleSubPageFinderTest extends \PHPUnit_Framework_TestCase {

	/**
	 * @return SubPageFinder
	 */
	public function newInstance() {
		return new SimpleSubPageFinder( new \SubPageList\LazyDBConnectionProvider( DB_SLAVE ) );
	}

	public function titleProvider() {
		$argLists = array();

		$argLists[] = array( Title::newMainPage() );
		$argLists[] = array( Title::newFromText( 'ohi there i do not exist nyan nyan nyan' ) );

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
		$this->assertContainsOnlyInstancesOf( 'Title', $pages );
	}

}
