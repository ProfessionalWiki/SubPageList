<?php

namespace Tests\Unit\SubPageList\Lister;

use MediaWiki\Title\Title;

class RedirectCreator {

	/**
	 *
	 * @param Title $title
	 * @param string $destination
	 *
	 */
	public function createRedirect( Title $title, $destination ) {
		$page = \MediaWiki\MediaWikiServices::getInstance()->getWikiPageFactory()->newFromTitle( $title );

		$pageContent = '#redirect [[' . $destination . ']]';
		$editMessage = 'SPL system test: create redirect';

		$page->newPageUpdater( \MediaWiki\User\User::newSystemUser( 'SPLTestUser' ) )
			->setContent( \MediaWiki\Revision\SlotRecord::MAIN, new \WikitextContent( $pageContent ) )
			->saveRevision( \MediaWiki\CommentStore\CommentStoreComment::newUnsavedComment( $editMessage ) );
	}

}