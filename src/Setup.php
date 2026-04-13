<?php

namespace SubPageList;

use MediaWiki\HookContainer\HookContainer;
use MediaWiki\MediaWikiServices;
use MediaWiki\Parser\Parser;
use MediaWiki\Title\Title;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use SplFileInfo;

/**
 * Object containing the logic to set up the SupPageList extension.
 *
 * @since 1.0
 *
 * @licence GNU GPL v2+
 * @author Jeroen De Dauw < jeroendedauw@gmail.com >
 */
class Setup {

	/**
	 * @var Extension
	 */
	private $extension;

	/**
	 * @var HookContainer
	 */
	private $hookContainer;

	/**
	 * @var string
	 */
	private $rootDirectory;

	/**
	 * @param Extension $extension
	 * @param HookContainer $hookContainer
	 * @param string $rootDirectory
	 */
	public function __construct( Extension $extension, HookContainer &$hookContainer, $rootDirectory ) {
		$this->hookContainer =& $hookContainer;
		$this->extension = $extension;
		$this->rootDirectory = $rootDirectory;
	}

	/**
	 * Initializes the extension during MediaWiki boot up
	 */
	public static function onExtensionFunctions() {
		$extension = new Extension( Settings::newFromGlobals( $GLOBALS ) );
		$hookContainer = MediaWikiServices::getInstance()->getHookContainer();
		$extensionSetup = new Setup( $extension, $hookContainer, dirname( __DIR__ ) );

		$extensionSetup->run();
	}

	/**
	 * Called when the parser initialises for the first time.
	 * Registered declaratively via extension.json so it works in parser tests.
	 */
	public static function onParserFirstCallInit( Parser &$parser ) {
		$extension = new Extension( Settings::newFromGlobals( $GLOBALS ) );
		$hookRegistrant = $extension->getHookRegistrant( $parser );

		$hookRegistrant->registerFunctionHandler(
			$extension->getCountHookDefinition(),
			$extension->getCountHookHandler()
		);

		$hookRegistrant->registerFunctionHandler(
			$extension->getListHookDefinition(),
			$extension->getListHookHandler()
		);

		$hookRegistrant->registerHookHandler(
			$extension->getCountHookDefinition(),
			$extension->getCountHookHandler()
		);

		$hookRegistrant->registerHookHandler(
			$extension->getListHookDefinition(),
			$extension->getListHookHandler()
		);
	}

	/**
	 * Sets up the SubPageList extension.
	 *
	 * @since 1.0
	 */
	public function run() {
		$this->registerCacheInvalidator();
		$this->registerUnitTests();
	}

	private function registerCacheInvalidator() {
		$extension = $this->extension;

		/**
		 * Occurs after a page has been saved.
		 * https://www.mediawiki.org/wiki/Manual:Hooks/PageSaveComplete
		 */
		$this->hookContainer->register( 'PageSaveComplete', function( $wikiPage ) use ( $extension ) {
			if ( $extension->getSettings()->get( Settings::AUTO_REFRESH ) ) {
				$extension->getCacheInvalidator()->invalidateCaches( $wikiPage->getTitle() );
			}
		} );

		/**
		 * Occurs after a page has been deleted.
		 * https://www.mediawiki.org/wiki/Manual:Hooks/PageDeleteComplete
		 */
		$this->hookContainer->register( 'PageDeleteComplete', function( $page ) use ( $extension ) {
			if ( $extension->getSettings()->get( Settings::AUTO_REFRESH ) ) {
				$extension->getCacheInvalidator()->invalidateCaches( Title::newFromPageIdentity( $page ) );
			}
		} );

		/**
		 * Occurs whenever a request to move an article is completed.
		 * https://www.mediawiki.org/wiki/Manual:Hooks/PageMoveComplete
		 */
		$this->hookContainer->register( 'PageMoveComplete', function( Title $title, Title $newTitle ) use ( $extension ) {
			if ( $extension->getSettings()->get( Settings::AUTO_REFRESH ) ) {
				$invalidator = $extension->getCacheInvalidator();

				$invalidator->invalidateCaches( $title );
				$invalidator->invalidateCaches( $newTitle );
			}
		} );
	}

	private function registerUnitTests() {
		$rootDirectory = $this->rootDirectory;

		/**
		 * Hook to add PHPUnit test cases.
		 * @see https://www.mediawiki.org/wiki/Manual:Hooks/UnitTestsList
		 *
		 * @since 1.0
		 *
		 * @param array $files
		 *
		 * @return boolean
		 */
		$this->hookContainer->register( 'UnitTestsList', function( array &$files ) use ( $rootDirectory ) {
			$directoryIterator = new RecursiveDirectoryIterator( $rootDirectory . '/tests/' );

			/**
			 * @var SplFileInfo $fileInfo
			 */
			foreach ( new RecursiveIteratorIterator( $directoryIterator ) as $fileInfo ) {
				if ( substr( $fileInfo->getFilename(), -8 ) === 'Test.php' ) {
					$files[] = $fileInfo->getPathname();
				}
			}

			return true;
		} );
	}

}
