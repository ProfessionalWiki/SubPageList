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

if ( !defined( 'MEDIAWIKI' ) ) {
	die( 'Not an entry point.' );
}

if ( defined( 'SPL_VERSION' ) ) {
	// Do not initialize more then once.
	return;
}

define( 'SPL_VERSION', '1.0 alpha' );

// Include the composer autoloader if it is present.
if ( is_readable( __DIR__ . '/vendor/autoload.php' ) ) {
	include_once( __DIR__ . '/vendor/autoload.php' );
}

// Attempt to include the ParamProcessor lib if that has not been loaded yet.
if ( !defined( 'ParamProcessor_VERSION' ) && file_exists( __DIR__ . '/../Validator/Validator.php' ) ) {
	include_once( __DIR__ . '/../Validator/Validator.php' );
}

// Attempt to include the ParserHooks lib if that has not been loaded yet.
if ( !defined( 'ParserHooks_VERSION' ) && file_exists( __DIR__ . '/../ParserHooks/ParserHooks.php' ) ) {
	include_once( __DIR__ . '/../ParserHooks/ParserHooks.php' );
}

// Only initialize the extension when all dependencies are present.
if ( !defined( 'ParamProcessor_VERSION' ) ) {
	throw new Exception( 'You need to have ParamProcessor (Validator) 1.0 or later installed in order to use SubPageList' );
}

// Only initialize the extension when all dependencies are present.
if ( !defined( 'ParserHooks_VERSION' ) ) {
	throw new Exception( 'You need to have ParserHooks 0.1 or later installed in order to use SubPageList' );
}

// @codeCoverageIgnoreStart
spl_autoload_register( function ( $className ) {
	$className = ltrim( $className, '\\' );
	$fileName = '';
	$namespace = '';

	if ( $lastNsPos = strripos( $className, '\\') ) {
		$namespace = substr( $className, 0, $lastNsPos );
		$className = substr( $className, $lastNsPos + 1 );
		$fileName  = str_replace( '\\', '/', $namespace ) . '/';
	}

	$fileName .= str_replace( '_', '/', $className ) . '.php';

	$namespaceSegments = explode( '\\', $namespace );

	if ( $namespaceSegments[0] === 'SubPageList' ) {
		if ( count( $namespaceSegments ) === 1 || $namespaceSegments[1] !== 'Tests' ) {
			require_once __DIR__ . '/src/' . $fileName;
		}
	}
} );
// @codeCoverageIgnoreEnd

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

	foreach ( include( __DIR__ . '/SubPageList.classes.php' ) as $class => $file ) {
		$wgAutoloadClasses[$class] = __DIR__ . '/' . $file;
	}

	if ( defined( 'MW_PHPUNIT_TEST' ) ) {
		$wgAutoloadClasses['SubPageList\Test\SubPageListTestCase'] = __DIR__ . '/tests/SubPageListTestCase.php';
	}


	$wgExtensionFunctions[] = function() {
		global $wgHooks;

		$extension = new \SubPageList\Extension( \SubPageList\Settings::newFromGlobals( $GLOBALS ) );
		$extensionSetup = new \SubPageList\Setup( $extension, $wgHooks, __DIR__ );

		$extensionSetup->run();
	};

} );


require_once 'SubPageList.settings.php';
