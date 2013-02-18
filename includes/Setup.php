<?php

namespace SubPageList;
use Parser, WikiPage, User, Revision, Title;

/**
 * Object containing the logic to set up the SupPageList extension.
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
 * @since 1.0
 *
 * @file
 * @ingroup SPL
 *
 * @licence GNU GPL v2+
 * @author Jeroen De Dauw < jeroendedauw@gmail.com >
 */
class Setup {

	/**
	 * @since 0.1
	 *
	 * @var Extension
	 */
	protected $extension;

	/**
	 * @since 1.0
	 *
	 * @var array
	 */
	protected $hooks;

	/**
	 * Constructor.
	 *
	 * @since 1.0
	 *
	 * @param Extension $extension
	 * @param array $hooks
	 */
	public function __construct( Extension $extension, array &$hooks ) {
		$this->hooks =& $hooks;
		$this->extension = $extension;
	}

	/**
	 * Sets up the SubPageList extension.
	 *
	 * @since 1.0
	 */
	public function run() {
		$extension = $this->extension;

		/**
		 * Called when the parser initialises for the first time.
		 * https://www.mediawiki.org/wiki/Manual:Hooks/ParserFirstCallInit
		 */
		$this->hooks['ParserFirstCallInit'][] = function( Parser &$parser ) use ( $extension ) {
			$hookRegistrant = $extension->getHookRegistrant( $parser );

			$countHandler = $extension->getCountFunctionHandler();

			$hookRegistrant->registerFunction( $countHandler );

			return true;
		};

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
		$this->hooks['UnitTestsList'][]	= function( array &$files ) {
			$testFiles = array(
				'Extension',
				'LazyDBConnectionProvider',
				'Settings',
				'Setup',
				'SimpleSubPageFinder',
			);

			foreach ( $testFiles as $file ) {
				$files[] = __DIR__ . '/../tests/' . $file . 'Test.php';
			}

			return true;
		};
	}

}
