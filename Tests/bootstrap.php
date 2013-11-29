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

$GLOBALS['wgNamespacesWithSubpages'][NS_MAIN] = true;

echo exec( 'composer update' ) . "\n";

require_once( __DIR__ . '/../vendor/autoload.php' );