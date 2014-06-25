<?php

/**
 * PHPUnit bootstrap file for the SubPageList extension.
 *
 * @since 1.0
 *
 * @licence GNU GPL v2+
 * @author Jeroen De Dauw < jeroendedauw@gmail.com >
 */

if ( php_sapi_name() !== 'cli' ) {
	die( 'Not an entry point' );
}

error_reporting(E_ALL| E_STRICT);
ini_set("display_errors", 1);

require_once( __DIR__ . '/evilMediaWikiBootstrap.php' );

$GLOBALS['wgNamespacesWithSubpages'][NS_MAIN] = true;

if ( !is_readable( __DIR__ . '/../vendor/autoload.php' ) ) {
	die( 'You need to install this package with Composer before you can run the tests' );
}

$autoLoader = require_once( __DIR__ . '/../vendor/autoload.php' );

$autoLoader->addPsr4( 'Tests\\System\\SubPageList\\', __DIR__ . '/System/SubPageList/' );
