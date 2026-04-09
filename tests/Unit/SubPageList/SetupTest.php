<?php

namespace Tests\Unit\SubPageList;

use MediaWiki\MediaWikiServices;
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

		$hookContainer = MediaWikiServices::getInstance()->getHookContainer();

		$setup = new Setup(
			$extension,
			$hookContainer,
			__DIR__ . '/..'
		);

		$setup->run();

		$this->assertTrue( $hookContainer->isRegistered( 'ParserFirstCallInit' ) );
	}

	private function newExtension() {
		return new \SubPageList\Extension( \SubPageList\Settings::newFromGlobals( $GLOBALS ) );
	}

}
