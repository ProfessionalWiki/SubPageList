<?php

/**
 * Initialization file for the SubPageList extension.
 * 
 * Documentation: https://github.com/wikimedia/mediawiki-extensions-SubPageList/blob/master/README.md
 * Support https://www.mediawiki.org/wiki/Extension_talk:SubPageList
 *
 * @licence GNU GPL v2+
 * @author Jeroen De Dauw < jeroendedauw@gmail.com >
 */

if ( !defined( 'MEDIAWIKI' ) ) {
	die( 'Not an entry point.' );
}

if ( defined( 'SPL_VERSION' ) ) {
	// Do not initialize more then once.
	return;
}

define( 'SPL_VERSION', '1.0 RC' );

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
	throw new Exception( 'You need to have ParserHooks 1.1 or later installed in order to use SubPageList' );
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
	global $wgExtensionCredits, $wgExtensionMessagesFiles, $wgExtensionFunctions;

	$wgExtensionCredits['parserhook'][] = array(
		'path' => __FILE__,
		'name' => 'SubPageList',
		'version' => SPL_VERSION,
		'author' => array(
			'[https://www.mediawiki.org/wiki/User:Jeroen_De_Dauw Jeroen De Dauw]',
		),
		'url' => 'https://www.mediawiki.org/wiki/Extension:SubPageList',
		'descriptionmsg' => 'spl-desc'
	);

	$wgExtensionMessagesFiles['SubPageList'] = __DIR__ . '/SubPageList.i18n.php';
	$wgExtensionMessagesFiles['SubPageListMagic'] = __DIR__ . '/SubPageList.i18n.magic.php';

	$wgExtensionFunctions[] = function() {
		global $wgHooks;

		$extension = new \SubPageList\Extension( \SubPageList\Settings::newFromGlobals( $GLOBALS ) );
		$extensionSetup = new \SubPageList\Setup( $extension, $wgHooks, __DIR__ );

		$extensionSetup->run();
	};

} );


require_once 'SubPageList.settings.php';
