<?php

/**
 * PHPUnit bootstrap file for the SubPageList extension.
 *
 * @since 0.1
 *
 * @licence GNU GPL v2+
 * @author Jeroen De Dauw < jeroendedauw@gmail.com >
 */

require_once( __DIR__ . '/evilMediaWikiBootstrap.php' );

$wgNamespacesWithSubpages[NS_MAIN] = true;

require_once( __DIR__ . '/../SubPageList.php' );
