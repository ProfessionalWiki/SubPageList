<?php

/**
 * File defining the settings for the SubPageList extension.
 * More info can be found at https://www.mediawiki.org/wiki/Extension:SubPageList#Settings
 *
 *                          NOTICE:
 * Changing one of these settings can be done by copying or cutting it,
 * and placing it in LocalSettings.php, AFTER the inclusion of SubPageList.
 *
 * @file
 * @ingroup SubPageList
 *
 * @licence GNU GPL v2+
 *
 * @author Jeroen De Dauw < jeroendedauw@gmail.com >
 */

if ( !defined( 'MEDIAWIKI' ) ) {
	die( 'Not an entry point.' );
}

# Automatically invalidate the cache of "base pages" when creating, moving or deleting a subpage?
# This covers most cases where people expect automatic refresh of the sub page list.
# However note that this will not update lists displaying subpages from pages different then themselves.
$egSPLAutorefresh = false;
