<?php

namespace SubPageList;

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
	 * @var array[]
	 */
	private $hooks;

	/**
	 * @var string
	 */
	private $rootDirectory;

	/**
	 * @param Extension $extension
	 * @param array $hooks
	 * @param string $rootDirectory
	 */
	public function __construct( Extension $extension, array &$hooks, $rootDirectory ) {
		$this->hooks =& $hooks;
		$this->extension = $extension;
		$this->rootDirectory = $rootDirectory;
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
		$this->hooks['ParserFirstCallInit'][] = function( Parser &$parser ) use ( $extension ) {
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
		};
	}

	private function registerCacheInvalidator() {
		$extension = $this->extension;

		/**
		 * Occurs after a new article has been created.
		 * https://www.mediawiki.org/wiki/Manual:Hooks/ArticleInsertComplete
		 */
		$this->hooks['ArticleInsertComplete'][]
			= function( WikiPage $article, User &$user, $text, $summary, $minorEdit,
			$watchThis, $sectionAnchor, &$flags, Revision $revision ) use ( $extension ) {

			if ( $extension->getSettings()->get( Settings::AUTO_REFRESH ) ) {
				$extension->getCacheInvalidator()->invalidateCaches( $article->getTitle() );
			}

			return true;
		};

		/**
		 * Occurs after the delete article request has been processed.
		 * https://www.mediawiki.org/wiki/Manual:Hooks/ArticleDeleteComplete
		 */
		$this->hooks['ArticleDeleteComplete'][] = function( &$article, User &$user, $reason, $id ) use ( $extension ) {
			if ( $extension->getSettings()->get( Settings::AUTO_REFRESH ) ) {
				$extension->getCacheInvalidator()->invalidateCaches( $article->getTitle() );
			}

			return true;
		};

		/**
		 * Occurs whenever a request to move an article is completed.
		 * https://www.mediawiki.org/wiki/Manual:Hooks/TitleMoveComplete
		 */
		$this->hooks['TitleMoveComplete'][] = function( Title &$title, Title &$newTitle, User &$user, $oldId, $newId ) use ( $extension ) {
			if ( $extension->getSettings()->get( Settings::AUTO_REFRESH ) ) {
				$invalidator = $extension->getCacheInvalidator();

				$invalidator->invalidateCaches( $title );
				$invalidator->invalidateCaches( $newTitle );
			}

			return true;
		};
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
		$this->hooks['UnitTestsList'][]	= function( array &$files ) use ( $rootDirectory ) {
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
		};
	}

}
