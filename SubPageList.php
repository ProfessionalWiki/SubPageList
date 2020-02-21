<?php
/**
 * Initialization file for the SubPageList extension.
 *
 * @codeCoverageIgnore
 * @licence GNU GPL v2+
 * @author Jeroen De Dauw < jeroendedauw@gmail.com >
 */

if ( !defined( 'MEDIAWIKI' ) ) {
	die( 'Not an entry point.' );
}

if ( defined( 'SPL_VERSION' ) ) {
	// Do not initialize more than once.
	return 1;
}

define( 'SPL_VERSION', '1.6.1' );

// Include the composer autoloader if it is present.
if ( is_readable( __DIR__ . '/vendor/autoload.php' ) ) {
	include_once( __DIR__ . '/vendor/autoload.php' );
}

// Only initialize the extension when all dependencies are present.
if ( !defined( 'ParserHooks_VERSION' ) ) {
	throw new Exception( 'You need to have ParserHooks installed in order to use SubPageList' );
}

call_user_func( function() {
	$GLOBALS['wgExtensionCredits']['parserhook'][] = array(
		'path' => __FILE__,
		'name' => 'SubPageList',
		'version' => SPL_VERSION,
		'author' => array(
			'[https://www.entropywins.wtf/mediawiki Jeroen De Dauw]',
			'[https://professional.wiki/ Professional.Wiki]'
		),
		'url' => 'https://github.com/JeroenDeDauw/SubPageList/blob/master/README.md',
		'descriptionmsg' => 'spl-desc',
		'license-name' => 'GPL-2.0-or-later'
	);

	$GLOBALS['wgMessagesDirs']['SubPageList'] = __DIR__ . '/i18n';
	$GLOBALS['wgExtensionMessagesFiles']['SubPageListMagic'] = __DIR__ . '/SubPageList.i18n.magic.php';

	$GLOBALS['wgExtensionFunctions'][] = function() {
		global $wgHooks;

		$extension = new \SubPageList\Extension( \SubPageList\Settings::newFromGlobals( $GLOBALS ) );
		$extensionSetup = new \SubPageList\Setup( $extension, $wgHooks, __DIR__ );

		$extensionSetup->run();
	};
} );

require_once 'SubPageList.settings.php';
