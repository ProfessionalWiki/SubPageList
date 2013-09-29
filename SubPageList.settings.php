<?php

/**
 * File defining the settings for the SubPageList extension.
 * More info can be found at
 * https://github.com/wikimedia/mediawiki-extensions-SubPageList/blob/master/doc/CONFIGURATION.md
 *
 *                          NOTICE:
 * Changing one of these settings can be done by copying or cutting it,
 * and placing it in LocalSettings.php, AFTER the inclusion of SubPageList.
 *
 * @licence GNU GPL v2+
 * @author Jeroen De Dauw < jeroendedauw@gmail.com >
 */

if ( !defined( 'MEDIAWIKI' ) ) {
	die( 'Not an entry point.' );
}

call_user_func( function() {

	global $egSPLAutorefresh;

	// Automatically invalidate the cache of "base pages" when creating, moving or deleting a subpage?
	// This covers most cases where people expect automatic refresh of the sub page list.
	// However note that this will not update lists displaying subpages from pages different then themselves.
	$egSPLAutorefresh = false;

} );
