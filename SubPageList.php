<?php

/**
 * Initialization file for the SubPageList extension.
 * 
 * Documentation:	 		http://www.mediawiki.org/wiki/Extension:SubPageList
 * Support					http://www.mediawiki.org/wiki/Extension_talk:SubPageList
 * Source code:             http://svn.wikimedia.org/viewvc/mediawiki/trunk/extensions/SubPageList
 *
 * @file SubPageList.php
 * @ingroup SubPageList
 *
 * @licence GNU GPL v3 or later
 *
 * @author Jeroen De Dauw < jeroendedauw@gmail.com >
 */

/**
 * This documenation group collects source code files belonging to SubPageList.
 *
 * @defgroup SPL SubPageList
 */

if ( !defined( 'MEDIAWIKI' ) ) {
	die( 'Not an entry point.' );
}

define( 'SPL_VERSION', '0.1 alpha' );

$wgExtensionCredits['other'][] = array(
	'path' => __FILE__,
	'name' => 'SubPageList',
	'version' => SPL_VERSION,
	'author' => array(
		'[http://www.mediawiki.org/wiki/User:Jeroen_De_Dauw Jeroen De Dauw]',
		'James McCormack',
		'Martin Schallnahs',
		'Rob Church. Based on [http://www.mediawiki.org/wiki/Extension:SubPageList3 SubPageList3].',
	),
	'url' => 'http://www.mediawiki.org/wiki/Extension:SubPageList',
	'descriptionmsg' => 'spl-desc'
);

$egSPLIP = dirname( __FILE__ );

$wgExtensionMessagesFiles['SubPageList'] 			= $egSPLIP . '/SubPageList.i18n.php';

$wgAutoloadClasses['SubPageList']	 				= $egSPLIP . '/SubPageList.class.php';

if ( version_compare( $wgVersion, '1.16alpha', '>=' ) ) {
	$wgExtensionMessagesFiles['SubPageListMagic'] 	= $egSPLIP . '/SubPageList.i18n.magic.php';
}

$wgHooks['ParserFirstCallInit'][] = 'SubPageList::staticInit';
$wgHooks['LanguageGetMagic'][] = 'SubPageList::staticMagic';

$wgExtensionFunctions[] = 'efSPLSetup';

/**
 * Initialization function.
 * 
 * @since 0.1
 */
function efSPLSetup() {
	global $wgVersion;
	
	// This function has been deprecated in 1.16, but needed for earlier versions.
	// It's present in 1.16 as a stub, but lets check if it exists in case it gets removed at some point.
	if ( version_compare( $wgVersion, '1.15', '<=' ) ) {
		wfLoadExtensionMessages( 'SubPageList' );
	}	
}

require_once 'SubPageList.settings.php';
