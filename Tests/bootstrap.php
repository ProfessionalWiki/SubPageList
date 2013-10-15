<?php

/**
 * PHPUnit bootstrap file for the SubPageList extension.
 *
 * @since 1.0
 *
 * @licence GNU GPL v2+
 * @author Jeroen De Dauw < jeroendedauw@gmail.com >
 */

require_once( __DIR__ . '/evilMediaWikiBootstrap.php' );

$wgNamespacesWithSubpages[NS_MAIN] = true;

require_once( __DIR__ . '/../SubPageList.php' );

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

	if ( $namespaceSegments[0] === 'Tests' ) {
		if ( count( $namespaceSegments ) > 2 && $namespaceSegments[2] === 'SubPageList' ) {
			require_once __DIR__ . '/../' . $fileName;
		}
	}
} );