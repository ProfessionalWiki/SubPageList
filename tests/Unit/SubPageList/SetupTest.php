<?php

namespace Tests\Unit\SubPageList;

use PHPUnit\Framework\TestCase;
use SubPageList\Setup;

/**
 * @covers \SubPageList\Setup
 *
 * @group SubPageList
 *
 * @licence GNU GPL v2+
 * @author Jeroen De Dauw < jeroendedauw@gmail.com >
 */
class SetupTest extends TestCase {

	public function testRun() {
		$extension = $this->newExtension();

		$hookLists = [
			'ParserFirstCallInit' => [],
			'ArticleInsertComplete' => [],
			'ArticleDeleteComplete' => [],
			'TitleMoveComplete' => [],
			'UnitTestsList' => [],
		];

		$setup = new Setup(
			$extension,
			$hookLists,
			__DIR__ . '/..'
		);

		$setup->run();

		foreach ( $hookLists as $hookName => $hookList ) {
			$this->assertEquals( 1, count( $hookList ), "one hook handler need to be added to '$hookName'" );

			$hook = reset( $hookList );

			$this->assertInternalType( 'callable', $hook );
		}
	}

	private function newExtension() {
		return new \SubPageList\Extension( \SubPageList\Settings::newFromGlobals( $GLOBALS ) );
	}

}
