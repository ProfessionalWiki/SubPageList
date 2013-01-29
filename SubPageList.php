<?php

/**
 * Initialization file for the SubPageList extension.
 * 
 * Documentation:	 		https://www.mediawiki.org/wiki/Extension:SubPageList
 * Support					https://www.mediawiki.org/wiki/Extension_talk:SubPageList
 * Source code:             https://gerrit.wikimedia.org/r/gitweb?p=mediawiki/extensions/SubPageList.git
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
 * @ingroup SubPageList
 *
 * @licence GNU GPL v2+
 * @author Jeroen De Dauw < jeroendedauw@gmail.com >
 */

/**
 * This documentation group collects source code files belonging to SubPageList.
 *
 * @defgroup SPL SubPageList
 */

use SubPageList\Settings;

if ( !defined( 'MEDIAWIKI' ) ) {
	die( 'Not an entry point.' );
}

// Include the Validator extension if that hasn't been done yet, since it's required for SubPageList to work.
if ( !defined( 'Validator_VERSION' ) ) {
	@include_once( dirname( __FILE__ ) . '/../Validator/Validator.php' );
}

// Only initialize the extension when all dependencies are present.
if ( !defined( 'ParamProcessor_VERSION' ) ) {
	die( '<b>Error:</b> You need to have <a href="http://www.mediawiki.org/wiki/Extension:Validator">Validator (ParamProcessor)</a> 1.0 or later installed in order to use <a href="http://www.mediawiki.org/wiki/Extension:SubPageList">SubPageList</a>.<br />' );
}


define( 'SPL_VERSION', '1.0 alpha' );


call_user_func( function() {
	global $wgExtensionCredits, $wgExtensionMessagesFiles, $wgAutoloadClasses, $wgExtensionFunctions;

	$wgExtensionCredits['parserhook'][] = array(
		'path' => __FILE__,
		'name' => 'SubPageList',
		'version' => SPL_VERSION,
		'author' => array(
			'[https://www.mediawiki.org/wiki/User:Jeroen_De_Dauw Jeroen De Dauw]',
			'Van de Bugger. Based on [https://www.mediawiki.org/wiki/Extension:SubPageList3 SubPageList3].',
		),
		'url' => 'https://www.mediawiki.org/wiki/Extension:SubPageList',
		'descriptionmsg' => 'spl-desc'
	);


	$wgExtensionMessagesFiles['SubPageList'] = __DIR__ . '/SubPageList.i18n.php';
	$wgExtensionMessagesFiles['SubPageListMagic'] = __DIR__ . '/SubPageList.i18n.magic.php';


	$wgAutoloadClasses['SubPageBase'] = __DIR__ . '/todo/SubPageBase.php';
	$wgAutoloadClasses['SubPageList'] = __DIR__ . '/todo/SubPageList.php';
	$wgAutoloadClasses['SubPageCount'] = __DIR__ . '/todo/SubPageCount.php';

	$wgAutoloadClasses['SubPageList\CacheInvalidator'] = __DIR__ . '/includes/CacheInvalidator.php';
	$wgAutoloadClasses['SubPageList\DBConnectionProvider'] = __DIR__ . '/includes/DBConnectionProvider.php';
	$wgAutoloadClasses['SubPageList\Extension'] = __DIR__ . '/includes/Extension.php';
	$wgAutoloadClasses['SubPageList\LazyDBConnectionProvider'] = __DIR__ . '/includes/LazyDBConnectionProvider.php';
	$wgAutoloadClasses['SubPageList\Settings'] = __DIR__ . '/includes/Settings.php';
	$wgAutoloadClasses['SubPageList\SimpleCacheInvalidator'] = __DIR__ . '/includes/SimpleCacheInvalidator.php';
	$wgAutoloadClasses['SubPageList\SimpleSubPageFinder'] = __DIR__ . '/includes/SimpleSubPageFinder.php';
	$wgAutoloadClasses['SubPageList\SubPageFinder'] = __DIR__ . '/includes/SubPageFinder.php';


	$wgExtensionFunctions[] = function() {
		global $wgHooks;

		$wgHooks['ParserFirstCallInit'][] = 'SubPageList::staticInit';
		$wgHooks['ParserFirstCallInit'][] = 'SubPageCount::staticInit';

		$extension = new \SubPageList\Extension( Settings::newFromGlobals( $GLOBALS ) );

		/**
		 * Occurs after a new article has been created.
		 * https://www.mediawiki.org/wiki/Manual:Hooks/ArticleInsertComplete
		 */
		$wgHooks['ArticleInsertComplete'][]
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
		$wgHooks['ArticleDeleteComplete'][] = function( &$article, User &$user, $reason, $id ) use ( $extension ) {
			if ( $extension->getSettings()->get( Settings::AUTO_REFRESH ) ) {
				$extension->getCacheInvalidator()->invalidateCaches( $article->getTitle() );
			}

			return true;
		};

		/**
		 * Occurs whenever a request to move an article is completed.
		 * https://www.mediawiki.org/wiki/Manual:Hooks/TitleMoveComplete
		 */
		$wgHooks['TitleMoveComplete'][] = function( Title &$title, Title &$newTitle, User &$user, $oldId, $newId ) use ( $extension ) {
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
		$wgHooks['UnitTestsList'][]	= function( array &$files ) {
			// @codeCoverageIgnoreStart
			$testFiles = array(
				'Extension',
				'LazyDBConnectionProvider',
				'Settings',
				'SimpleSubPageFinder',
			);

			foreach ( $testFiles as $file ) {
				$files[] = __DIR__ . '/tests/' . $file . 'Test.php';
			}

			return true;
			// @codeCoverageIgnoreEnd
		};

	};

} );

require_once 'SubPageList.settings.php';