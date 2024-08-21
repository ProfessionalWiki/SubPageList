<?php

namespace SubPageList;

use MediaWiki\HookContainer\HookContainer;
use MediaWiki\MediaWikiServices;
use Parser;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use Revision;
use SplFileInfo;
use Title;
use User;
use WikiPage;

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
	 * @global array $wgHooks
	 * @return void
	 */
	public static function onExtensionFunctions() {
		$extension = new \SubPageList\Extension( \SubPageList\Settings::newFromGlobals( $GLOBALS ) );
		$hookContainer = MediaWikiServices::getInstance()->getHookContainer();
		$extensionSetup = new \SubPageList\Setup( $extension, $hookContainer, dirname( __DIR__ ) );

		$extensionSetup->run();
	}

	/**
	 * Sets up the SubPageList extension.
	 *
	 * @since 1.0
	 */
	public function run() {
		$this->registerParserHooks();
		$this->registerCacheInvalidator();
		$this->registerUnitTests();
	}

	private function registerParserHooks() {
		$extension = $this->extension;

		/**
		 * Called when the parser initialises for the first time.
		 * https://www.mediawiki.org/wiki/Manual:Hooks/ParserFirstCallInit
		 */
		$this->hookContainer->register( 'ParserFirstCallInit', function( Parser &$parser ) use ( $extension ) {
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

			return true;
		} );
	}

	private function registerCacheInvalidator() {
		$extension = $this->extension;

		/**
		 * Occurs after a new article has been created.
		 * https://www.mediawiki.org/wiki/Manual:Hooks/ArticleInsertComplete
		 */
		$this->hookContainer->register( 'ArticleInsertComplete', function( WikiPage $article, User &$user, $text, $summary, $minorEdit,
			$watchThis, $sectionAnchor, &$flags, Revision $revision ) use ( $extension ) {

			if ( $extension->getSettings()->get( Settings::AUTO_REFRESH ) ) {
				$extension->getCacheInvalidator()->invalidateCaches( $article->getTitle() );
			}

			return true;
		} );

		/**
		 * Occurs after the delete article request has been processed.
		 * https://www.mediawiki.org/wiki/Manual:Hooks/ArticleDeleteComplete
		 */
		$this->hookContainer->register( 'ArticleDeleteComplete', function( &$article, User &$user, $reason, $id ) use ( $extension ) {
			if ( $extension->getSettings()->get( Settings::AUTO_REFRESH ) ) {
				$extension->getCacheInvalidator()->invalidateCaches( $article->getTitle() );
			}

			return true;
		} );

		/**
		 * Occurs whenever a request to move an article is completed.
		 * https://www.mediawiki.org/wiki/Manual:Hooks/TitleMoveComplete
		 */
		$this->hookContainer->register( 'TitleMoveComplete', function( Title &$title, Title &$newTitle, User &$user, $oldId, $newId ) use ( $extension ) {
			if ( $extension->getSettings()->get( Settings::AUTO_REFRESH ) ) {
				$invalidator = $extension->getCacheInvalidator();

				$invalidator->invalidateCaches( $title );
				$invalidator->invalidateCaches( $newTitle );
			}

			return true;
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
