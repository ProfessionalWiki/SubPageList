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

$GLOBALS['wgNamespacesWithSubpages'][NS_MAIN] = true;

$mwVendorPath = __DIR__ . '/../../../vendor/autoload.php';
$localVendorPath = __DIR__ . '/../vendor/autoload.php';

if ( is_readable( $localVendorPath ) ) {
	$autoLoader = registerAutoloader( 'local', $localVendorPath );
} elseif ( is_readable( $mwVendorPath ) ) {
	$autoLoader = registerAutoloader( 'MediaWiki', $mwVendorPath );
}
else {
	die( 'You need to install this package with Composer before you can run the tests' );
}

function registerAutoloader( $identifier, $path ) {
	print( "\nUsing the {$identifier} vendor autoloader ...\n\n" );
	return require $path;
}

$autoLoader->addPsr4( 'Tests\\System\\SubPageList\\', __DIR__ . '/System/SubPageList/' );
