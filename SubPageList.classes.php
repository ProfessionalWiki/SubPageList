<?php

/**
 * Class registration file for the SubPageList extension.
 *
 * DEPRECATED CLASSES ONLY
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

	$paths = array();

	$paths['SubPageBase'] = __DIR__ . '/todo/SubPageBase.php';
	$paths['SubPageList'] = __DIR__ . '/todo/SubPageList.php';
	$paths['SubPageCount'] = __DIR__ . '/todo/SubPageCount.php';

	return $paths;

} );
