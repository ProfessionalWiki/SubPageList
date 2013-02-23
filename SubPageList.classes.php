<?php

/**
 * Class registration file for the SubPageList extension.
 *
 * @since 1.0
 *
 * @file
 * @ingroup SPL
 *
 * @licence GNU GPL v2+
 * @author Jeroen De Dauw < jeroendedauw@gmail.com >
 */
return call_user_func( function() {

	// PSR-0 compliant :)

	$classes = array(
		'SubPageList\CacheInvalidator',
		'SubPageList\DBConnectionProvider',
		'SubPageList\Extension',
		'SubPageList\LazyDBConnectionProvider',
		'SubPageList\Settings',
		'SubPageList\Setup',
		'SubPageList\SimpleCacheInvalidator',
		'SubPageList\SimpleSubPageFinder',
		'SubPageList\SubPageFinder',
		'SubPageList\SubPageCount',
		'SubPageList\SubPageCounter',
		'SubPageList\SubPageFinder',
		'SubPageList\TitleFactory',
	);

	$paths = array();

	$paths['SubPageBase'] = __DIR__ . '/todo/SubPageBase.php';
	$paths['SubPageList'] = __DIR__ . '/todo/SubPageList.php';
	$paths['SubPageCount'] = __DIR__ . '/todo/SubPageCount.php';

	foreach ( $classes as $class ) {
		$path = 'includes/' . str_replace( '\\', '/', $class ) . '.php';

		$paths[$class] = $path;
	}

	return $paths;

} );
