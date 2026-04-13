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
		$callbacks = [];
		$spy = $this->newSpyCacheInvalidator();

		$this->runSetupWithAutoRefresh( $spy, $callbacks );

		$page = $this->createMock( ProperPageIdentity::class );
		$page->method( 'getNamespace' )->willReturn( NS_MAIN );
		$page->method( 'getDBkey' )->willReturn( 'DeletedPage' );

		$callbacks['PageDeleteComplete']( $page );

		$this->assertCount( 1, $spy->invalidatedTitles );
		$this->assertSame( 'DeletedPage', $spy->invalidatedTitles[0]->getDBkey() );
		$this->assertSame( NS_MAIN, $spy->invalidatedTitles[0]->getNamespace() );
	}

	public function testSavedPageInvalidatesCache() {
		$callbacks = [];
		$spy = $this->newSpyCacheInvalidator();

		$this->runSetupWithAutoRefresh( $spy, $callbacks );

		$wikiPage = $this->createMock( \WikiPage::class );
		$wikiPage->method( 'getTitle' )->willReturn( Title::makeTitle( NS_TALK, 'SavedPage' ) );

		$callbacks['PageSaveComplete']( $wikiPage );

		$this->assertCount( 1, $spy->invalidatedTitles );
		$this->assertSame( 'SavedPage', $spy->invalidatedTitles[0]->getDBkey() );
		$this->assertSame( NS_TALK, $spy->invalidatedTitles[0]->getNamespace() );
	}

	public function testMovedPageInvalidatesCacheForBothTitles() {
		$callbacks = [];
		$spy = $this->newSpyCacheInvalidator();

		$this->runSetupWithAutoRefresh( $spy, $callbacks );

		$callbacks['PageMoveComplete'](
			Title::makeTitle( NS_MAIN, 'OldPage' ),
			Title::makeTitle( NS_MAIN, 'NewPage' )
		);

		$this->assertCount( 2, $spy->invalidatedTitles );
		$this->assertSame( 'OldPage', $spy->invalidatedTitles[0]->getDBkey() );
		$this->assertSame( 'NewPage', $spy->invalidatedTitles[1]->getDBkey() );
	}

	public function testAutoRefreshDisabledDoesNotInvalidateCache() {
		$callbacks = [];
		$hookContainer = $this->newCapturingHookContainer( $callbacks );
		$spy = $this->newSpyCacheInvalidator();

		$extension = $this->createMock( Extension::class );
		$extension->method( 'getSettings' )
			->willReturn( new Settings( [ Settings::AUTO_REFRESH => false ] ) );
		$extension->method( 'getCacheInvalidator' )
			->willReturn( $spy );

		$setup = new Setup( $extension, $hookContainer, __DIR__ . '/..' );
		$setup->run();

		$page = $this->createMock( ProperPageIdentity::class );
		$page->method( 'getNamespace' )->willReturn( NS_MAIN );
		$page->method( 'getDBkey' )->willReturn( 'SomePage' );

		$callbacks['PageDeleteComplete']( $page );

		$this->assertEmpty( $spy->invalidatedTitles );
	}

	private function runSetupWithAutoRefresh( CacheInvalidator $cacheInvalidator, array &$callbacks ): void {
		$hookContainer = $this->newCapturingHookContainer( $callbacks );

		$extension = $this->createMock( Extension::class );
		$extension->method( 'getSettings' )
			->willReturn( new Settings( [ Settings::AUTO_REFRESH => true ] ) );
		$extension->method( 'getCacheInvalidator' )
			->willReturn( $cacheInvalidator );

		$setup = new Setup( $extension, $hookContainer, __DIR__ . '/..' );
		$setup->run();
	}

	private function newCapturingHookContainer( array &$callbacks ): HookContainer {
		$hookContainer = $this->createMock( HookContainer::class );
		$hookContainer->method( 'register' )
			->willReturnCallback( function ( $name, $callback ) use ( &$callbacks ) {
				$callbacks[$name] = $callback;
			} );
		return $hookContainer;
	}

	private function newSpyCacheInvalidator() {
		return new class implements CacheInvalidator {
			/** @var Title[] */
			public array $invalidatedTitles = [];

			public function invalidateCaches( Title $title ): void {
				$this->invalidatedTitles[] = $title;
			}
		};
	}

	private function newExtension() {
		return new \SubPageList\Extension( \SubPageList\Settings::newFromGlobals( $GLOBALS ) );
	}

}
