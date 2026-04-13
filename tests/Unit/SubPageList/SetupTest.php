<?php

namespace Tests\Unit\SubPageList;

use MediaWiki\HookContainer\HookContainer;
use MediaWiki\MediaWikiServices;
use MediaWiki\Page\ProperPageIdentity;
use MediaWiki\Title\Title;
use PHPUnit\Framework\TestCase;
use SubPageList\CacheInvalidator;
use SubPageList\Extension;
use SubPageList\Settings;
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

	public function testDeletedPageInvalidatesCache() {
		$registeredCallbacks = [];

		$hookContainer = $this->createMock( HookContainer::class );
		$hookContainer->method( 'register' )
			->willReturnCallback( function ( $name, $callback ) use ( &$registeredCallbacks ) {
				$registeredCallbacks[$name] = $callback;
			} );

		$cacheInvalidator = new class implements CacheInvalidator {
			public ?Title $invalidatedTitle = null;

			public function invalidateCaches( Title $title ): void {
				$this->invalidatedTitle = $title;
			}
		};

		$extension = $this->createMock( Extension::class );
		$extension->method( 'getSettings' )
			->willReturn( new Settings( [ Settings::AUTO_REFRESH => true ] ) );
		$extension->method( 'getCacheInvalidator' )
			->willReturn( $cacheInvalidator );

		$setup = new Setup( $extension, $hookContainer, __DIR__ . '/..' );
		$setup->run();

		$page = $this->createMock( ProperPageIdentity::class );
		$page->method( 'getNamespace' )->willReturn( NS_MAIN );
		$page->method( 'getDBkey' )->willReturn( 'TestPage' );

		$this->assertArrayHasKey( 'PageDeleteComplete', $registeredCallbacks );
		$registeredCallbacks['PageDeleteComplete']( $page );

		$this->assertSame( 'TestPage', $cacheInvalidator->invalidatedTitle->getDBkey() );
		$this->assertSame( NS_MAIN, $cacheInvalidator->invalidatedTitle->getNamespace() );
	}

	private function newExtension() {
		return new \SubPageList\Extension( \SubPageList\Settings::newFromGlobals( $GLOBALS ) );
	}

}
