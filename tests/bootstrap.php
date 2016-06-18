<?php

/**
 * PHPUnit bootstrap file for the SubPageList extension.
 *
 * @since 1.0
 *
 * @licence GNU GPL v2+
 * @author Jeroen De Dauw < jeroendedauw@gmail.com >
 */

if ( PHP_SAPI !== 'cli' ) {
	die( 'Not an entry point' );
}

error_reporting( -1 );
ini_set( 'display_errors', 1 );

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
$autoLoader->addPsr4( 'Tests\\Unit\\SubPageList\\Lister\\', __DIR__ . '/Unit/SubPageList/Lister/' );

unset( $autoLoader );
